<?php

namespace Modules\Updates\Jobs;

use App\Entities\AcceptPayment;
use App\Entities\Category;
use App\Entities\Department;
use App\Entities\Status;
use App\Entities\TaxRate;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Clients\Entities\Client;
use Modules\Estimates\Entities\Estimate;
use Modules\Expenses\Entities\Expense;
use Modules\Invoices\Entities\Invoice;
use Modules\Projects\Entities\Project;
use Modules\Settings\Entities\Options;
use Modules\Tickets\Entities\Ticket;
use Modules\Updates\Events\ImportSuccessful;
use Modules\Users\Entities\User;
use Spatie\Permission\Models\Role;
use Storage;

class ImportDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 300;

    protected $filename;
    protected $user;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename, $user)
    {
        $this->filename = $filename;
        $this->user     = $user;
        $this->data     = [];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contents   = Storage::get('tmp/' . $this->filename);
        $this->data = json_decode($contents);
        $this->import();
        Storage::delete(Storage::files('tmp'));
        Storage::disk('local')->put('tmp/index.html', 'It works!');
        event(new ImportSuccessful($this->user));
    }
    protected function import()
    {
        DB::beginTransaction();

        $data = collect($this->data)->recursive();
        try {
            if (isset($data['fx_roles'])) {
                foreach ($data['fx_roles'] as $role) {
                    Role::firstOrCreate(['name' => $role['role']]);
                }
            }
            if (isset($data['fx_categories'])) {
                foreach ($data['fx_categories']->where('module', 'expenses') as $cat) {
                    Category::firstOrCreate(['name' => $cat['cat_name']], ['module' => 'expenses']);
                }
            }
            if (isset($data['fx_status'])) {
                foreach ($data['fx_status'] as $status) {
                    Status::firstOrCreate(['status' => $status['status']]);
                }
            }
            foreach ($data['fx_config'] as $config) {
                if (Options::where('config_key', $config['config_key'])->count()) {
                    Options::where('config_key', $config['config_key'])->first()->update(['config_key' => $config['config_key']]);
                }
            }
            if (isset($data['fx_payment_methods'])) {
                foreach ($data['fx_payment_methods'] as $method) {
                    AcceptPayment::firstOrCreate(['method_name' => $method['method_name']]);
                }
            }
            if (isset($data['fx_departments'])) {
                foreach ($data['fx_departments'] as $dept) {
                    Department::firstOrCreate(['deptname' => $dept['deptname']]);
                }
            }
            if (isset($data['fx_tax_rates'])) {
                foreach ($data['fx_tax_rates'] as $rate) {
                    TaxRate::firstOrCreate(['name' => $rate['tax_rate_name']], ['rate' => $rate['tax_rate_percent']]);
                }
            }
            if (isset($data['fx_users'])) {
                foreach ($data['fx_users'] as $user) {
                    $member = User::firstOrCreate(['email' => $user['email']], [
                        'username'          => $user['username'],
                        'password'          => $user['password'],
                        'name'              => $data['fx_account_details']->where('user_id', $user['id'])->first()['fullname'],
                        'email_verified_at' => now()->toDateTimeString(),
                        'calendar_token'    => str_random(60),
                    ]);
                    $p = $data['fx_account_details']->where('user_id', $user['id'])->first();

                    $member->profile->update([
                        'city'         => $p['city'],
                        'country'      => $p['country'],
                        'address'      => $p['address'],
                        'phone'        => $p['phone'],
                        'avatar'       => $p['avatar'],
                        'use_gravatar' => 1,
                        'hourly_rate'  => $p['hourly_rate'],
                    ]);
                    $member->syncRoles($data['fx_roles']->where('r_id', $user['role_id'])->first()['role']);
                    if (isset($data['fx_notes'])) {
                        foreach ($data['fx_notes']->where('owner', $user['id']) as $note) {
                            $member->notes()->create([
                                'user_id'     => $member->id,
                                'name'        => $note['name'],
                                'description' => $note['description'],
                                'date'        => strtotime(now()) * 1000,
                            ]);
                        }
                    }
                }
            }
            if (isset($data['fx_companies'])) {
                foreach ($data['fx_companies'] as $client) {
                    $company = Client::firstOrCreate(['email' => $client['company_email']], [
                        'code'       => $client['company_ref'],
                        'name'       => $client['company_name'],
                        'website'    => $client['company_website'],
                        'phone'      => $client['company_phone'],
                        'address1'   => $client['company_address'],
                        'city'       => $client['city'],
                        'state'      => $client['state'],
                        'currency'   => $client['currency'],
                        'country'    => $client['country'],
                        'tax_number' => $client['VAT'],
                        'zip_code'   => $client['zip'],
                        'linkedin'   => $client['linkedin'],
                        'facebook'   => $client['facebook'],
                        'twitter'    => $client['twitter'],
                        'notes'      => $client['notes'],
                    ]);
                    // Update company contact
                    if (isset($data['fx_account_details'])) {
                        foreach ($data['fx_account_details']->where('company', $client['co_id']) as $contact) {
                            $u = User::where('email', $data['fx_users']->where('id', $contact['user_id'])->first()['email'])->first();
                            $u->profile()->update(['company' => $company->id]);
                        }
                    }
                    // Import client invoices
                    if (isset($data['fx_invoices'])) {
                        foreach ($data['fx_invoices']->where('client', $client['co_id']) as $invoice) {
                            $inv = Invoice::create([
                                'reference_no'  => empty($invoice['reference_no']) ? generateCode('invoices') : $invoice['reference_no'],
                                'client_id'     => $company->id,
                                'due_date'      => validateDate($invoice['due_date'] . ' 00:00:00') ? dateParser($invoice['due_date'])->toDateTimeString() : now(),
                                'notes'         => $invoice['notes'],
                                'tax'           => $invoice['tax'],
                                'tax2'          => $invoice['tax2'],
                                'discount'      => $invoice['discount'],
                                'currency'      => $invoice['currency'],
                                'is_visible'    => $invoice['show_client'] == 'Yes' ? 1 : 0,
                                'extra_fee'     => $invoice['extra_fee'],
                                'reminded_at'   => now()->toDateTimeString(),
                                'created_at'    => validateDate($invoice['date_saved']) ? dateParser($invoice['date_saved'])->toDateTimeString() : now(),
                                'alert_overdue' => 1,
                            ]);
                            if (isset($data['fx_items'])) {
                                foreach ($data['fx_items']->where('invoice_id', $invoice['inv_id']) as $item) {
                                    $inv->items()->create([
                                        'tax_rate'    => $item['item_tax_rate'],
                                        'quantity'    => $item['quantity'],
                                        'name'        => $item['item_name'],
                                        'description' => $item['item_desc'],
                                        'unit_cost'   => $item['unit_cost'],
                                        'total_cost'  => $item['total_cost'],
                                    ]);
                                }
                            }
                            if (isset($data['fx_payments'])) {
                                foreach ($data['fx_payments']->where('invoice', $invoice['inv_id']) as $payment) {
                                    $inv->payments()->create([
                                        'code'             => empty($payment['trans_id']) ? generateCode('payments') : $payment['trans_id'],
                                        'client_id'        => $inv->client_id,
                                        'payment_method'   => 2,
                                        'currency'         => $payment['currency'],
                                        'amount'           => $payment['amount'],
                                        'notes'            => $payment['notes'],
                                        'payment_date'     => validateDate($payment['payment_date'] . ' 00:00:00') ? dateParser($payment['payment_date'])->toDateTimeString() : now(),
                                        'amount_formatted' => formatCurrency($payment['currency'], $payment['amount']),
                                    ]);
                                }
                            }
                        }
                    }
                    // Import estimates
                    if (isset($data['fx_estimates'])) {
                        foreach ($data['fx_estimates']->where('client', $client['co_id']) as $estimate) {
                            $est = Estimate::create([
                                'reference_no' => generateCode('estimates'),
                                'client_id'    => $company->id,
                                'due_date'     => validateDate($estimate['due_date'] . ' 00:00:00') ? dateParser($estimate['due_date'])->toDateTimeString() : now(),
                                'notes'        => $estimate['notes'],
                                'tax'          => $estimate['tax'],
                                'tax2'         => $estimate['tax2'],
                                'discount'     => $estimate['discount'],
                                'currency'     => $estimate['currency'],
                                'is_visible'   => $estimate['show_client'] == 'Yes' ? 1 : 0,
                                'status'       => $estimate['status'],
                                'invoiced_at'  => now()->toDateTimeString(),
                                'reminded_at'  => now()->toDateTimeString(),
                                'created_at'   => validateDate($estimate['date_saved']) ? dateParser($estimate['date_saved'])->toDateTimeString() : now(),
                            ]);
                            if (isset($data['fx_estimate_items'])) {
                                foreach ($data['fx_estimate_items']->where('estimate_id', $estimate['est_id']) as $i) {
                                    $est->items()->create([
                                        'tax_rate'    => $i['item_tax_rate'],
                                        'quantity'    => $i['quantity'],
                                        'name'        => $i['item_name'],
                                        'description' => $i['item_desc'],
                                        'unit_cost'   => $i['unit_cost'],
                                        'total_cost'  => $i['total_cost'],
                                    ]);
                                }
                            }
                        }
                    }

                    // Import client expenses
                    if (isset($data['fx_expenses'])) {
                        foreach ($data['fx_expenses']->where('project', 0)->where('client', $client['co_id']) as $exp) {
                            Expense::create([
                                'code'         => generateCode('expenses'),
                                'billable'     => $exp['billable'],
                                'client_id'    => $company->id,
                                'amount'       => $exp['amount'],
                                'expense_date' => validateDate($exp['expense_date'] . ' 00:00:00') ? dateParser($exp['expense_date']) : now(),
                                'currency'     => $company->currency,
                                'notes'        => $exp['notes'],
                                'invoiced'     => $exp['invoiced'],
                                'category'     => Category::where('name', $data['fx_categories']->where('id', $exp['category'])->first()['cat_name'])->first()->id,
                                'is_visible'   => $exp['show_client'] == 'Yes' ? 1 : 0,
                                'user_id'      => User::role('admin')->first()->id,
                            ]);
                        }
                    }

                    // Import projects
                    if (isset($data['fx_projects'])) {
                        foreach ($data['fx_projects']->where('client', $client['co_id']) as $project) {
                            $pr = Project::create([
                                'code'              => generateCode('projects'),
                                'name'              => $project['project_title'],
                                'client_id'         => $company->id,
                                'currency'          => $project['currency'],
                                'start_date'        => validateDate($project['start_date'] . ' 00:00:00') ? dateParser($project['start_date'])->toDateTimeString() : now(),
                                'due_date'          => validateDate($project['due_date'] . ' 00:00:00') ? dateParser($project['due_date'])->toDateTimeString() : now(),
                                'description'       => $project['description'],
                                'hourly_rate'       => $project['hourly_rate'],
                                'fixed_price'       => $project['fixed_price'],
                                'auto_progress'     => 1,
                                'estimate_hours'    => $project['estimate_hours'],
                                'alert_overdue'     => 1,
                                'token'             => genToken(),
                                'feedback_disabled' => 1,
                                'progress'          => (int) $project['progress'],
                                'status'            => $project['status'],
                                'archived_at'       => $project['archived'] > 0 ? now() : null,
                                'settings'          => $project['settings'] != 'null' ? json_decode($project['settings']) : json_decode(get_option('default_project_settings')),
                                'created_at'        => validateDate($project['date_created']) ? dateParser($project['date_created'])->toDateTimeString() : now(),
                            ]);

                            // Create team
                            if (isset($data['fx_assign_projects'])) {
                                foreach ($data['fx_assign_projects']->where('project_assigned', $project['project_id']) as $agent) {
                                    $pr->assignees()->create([
                                        'user_id' => $agent['assigned_user'] > 0 ? User::where('email', $data['fx_users']->where('id', $agent['assigned_user'])->first()['email'])->first()->id : 1,
                                    ]);
                                }
                            }

                            // Import project expenses
                            if (isset($data['fx_expenses'])) {
                                foreach ($data['fx_expenses']->where('project', $project['project_id']) as $ex) {
                                    $pr->expenses()->create([
                                        'code'         => generateCode('expenses'),
                                        'billable'     => $ex['billable'],
                                        'client_id'    => $pr->client_id,
                                        'amount'       => $ex['amount'],
                                        'expense_date' => validateDate($ex['expense_date'] . ' 00:00:00') ? dateParser($ex['expense_date'])->toDateTimeString() : now(),
                                        'currency'     => $company->currency,
                                        'notes'        => $ex['notes'],
                                        'invoiced'     => $ex['invoiced'],
                                        'category'     => Category::where('name', $data['fx_categories']->where('id', $ex['category'])->first()['cat_name'])->first()->id,
                                        'is_visible'   => $ex['show_client'] == 'Yes' ? 1 : 0,
                                        'user_id'      => User::role('admin')->first()->id,
                                    ]);
                                }
                            }
                            // Import project milestones
                            if (isset($data['fx_milestones'])) {
                                foreach ($data['fx_milestones']->where('project', $project['project_id']) as $milestone) {
                                    $pr->milestones()->create([
                                        'milestone_name' => $milestone['milestone_name'],
                                        'description'    => $milestone['description'],
                                        'start_date'     => validateDate($milestone['start_date'] . ' 00:00:00') ? dateParser($milestone['start_date'])->toDateTimeString() : now(),
                                        'due_date'       => validateDate($milestone['due_date'] . ' 00:00:00') ? dateParser($milestone['due_date'])->toDateTimeString() : now(),
                                    ]);
                                }
                            }
                            // Import project tasks
                            if (isset($data['fx_tasks'])) {
                                foreach ($data['fx_tasks']->where('project', $project['project_id']) as $task) {
                                    $t = $pr->tasks()->create([
                                        'name'            => $task['task_name'],
                                        'description'     => $task['description'],
                                        'visible'         => $task['visible'],
                                        'progress'        => (int) $task['task_progress'],
                                        'estimated_hours' => $task['estimated_hours'],
                                        'start_date'      => validateDate($task['start_date'] . ' 00:00:00') ? dateParser($task['start_date'])->toDateTimeString() : now(),
                                        'due_date'        => validateDate($task['due_date'] . ' 00:00:00') ? dateParser($task['due_date'])->toDateTimeString() : now(),
                                        'user_id'         => User::role('admin')->first()->id,
                                        'reminded_at'     => now()->toDateTimeString(),
                                        'created_at'      => validateDate($task['date_added']) ? dateParser($task['date_added'])->toDateTimeString() : now(),
                                    ]);
                                    // Create team
                                    if (isset($data['fx_assign_tasks'])) {
                                        foreach ($data['fx_assign_tasks']->where('task_assigned', $task['t_id']) as $team) {
                                            $t->assignees()->create([
                                                'user_id' => $team['assigned_user'] > 0 ? User::where('email', $data['fx_users']->where('id', $team['assigned_user'])->first()['email'])->first()->id : 1,
                                            ]);
                                        }
                                    }
                                    // Import task timesheets
                                    if (isset($data['fx_tasks_timer'])) {
                                        foreach ($data['fx_tasks_timer']->where('task', $task['t_id']) as $timer) {
                                            $staff = $timer['user'] == 0 || is_null(optional(User::where('email', $data['fx_users']->where('id', $timer['user'])->first()['email'])->first())->id) ? 1 : User::where('email', $data['fx_users']->where('id', $timer['user'])->first()['email'])->first()->id;
                                            $pr->timesheets()->create([
                                                'task_id'    => $t->id,
                                                'start'      => (int) $timer['start_time'],
                                                'end'        => (int) $timer['end_time'],
                                                'billable'   => (int) $timer['billable'],
                                                'total'      => (int) $timer['time_in_sec'],
                                                'notes'      => $timer['description'],
                                                'billed'     => $timer['status'] == '1' ? 1 : 0,
                                                'user_id'    => $staff,
                                                'created_at' => validateDate($timer['date_timed']) ? dateParser($timer['date_timed'])->toDateTimeString() : now(),
                                            ]);
                                        }
                                    }

                                    // Import task comments
                                    if (isset($data['fx_comments'])) {
                                        foreach ($data['fx_comments']->where('task_id', $task['t_id']) as $c) {
                                            $t->comments()->create([
                                                'user_id'    => $c['posted_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $c['posted_by'])->first()['email'])->first()->id : 1,
                                                'message'    => $c['message'],
                                                'created_at' => validateDate($c['date_posted']) ? dateParser($c['date_posted'])->toDateTimeString() : now(),
                                            ]);
                                        }
                                    }

                                    // Import task files
                                    if (isset($data['fx_task_files'])) {
                                        foreach ($data['fx_task_files']->where('task', $task['t_id']) as $f) {
                                            $t->files()->create([
                                                'filename'     => $f['file_name'],
                                                'title'        => $f['title'],
                                                'path'         => $f['path'],
                                                'ext'          => $f['file_ext'],
                                                'size'         => $f['size'],
                                                'is_image'     => (int) $f['is_image'],
                                                'image_width'  => $f['image_width'],
                                                'image_height' => $f['image_height'],
                                                'description'  => $f['description'],
                                                'user_id'      => $f['uploaded_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $f['uploaded_by'])->first()['email'])->first()->id : 1,
                                            ]);
                                        }
                                    }
                                }
                            }

                            // Import project todos
                            if (isset($data['fx_todo'])) {
                                foreach ($data['fx_todo']->where('project', $project['project_id']) as $todo) {
                                    $pr->todos()->create([
                                        'subject'     => $todo['list_name'],
                                        'assignee'    => User::role('admin')->first()->id,
                                        'reminded_at' => now()->toDateTimeString(),
                                        'is_visible'  => $todo['visible'] == 'Yes' ? 1 : 0,
                                        'completed'   => $todo['status'] == 'done' ? 1 : 0,
                                        'user_id'     => $todo['saved_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $todo['saved_by'])->first()['email'])->first()->id : 1,
                                        'reminded_at' => now()->toDateTimeString(),
                                    ]);
                                }
                            }

                            // Import project comments
                            if (isset($data['fx_comments'])) {
                                foreach ($data['fx_comments']->where('project', $project['project_id']) as $comment) {
                                    $pr->comments()->create([
                                        'user_id'    => $comment['posted_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $comment['posted_by'])->first()['email'])->first()->id : 1,
                                        'message'    => $comment['message'],
                                        'created_at' => validateDate($comment['date_posted']) ? dateParser($comment['date_posted'])->toDateTimeString() : now(),
                                    ]);
                                }
                            }

                            // Import project issues
                            if (isset($data['fx_bugs'])) {
                                foreach ($data['fx_bugs']->where('project', $project['project_id']) as $issue) {
                                    $i = $pr->issues()->create([
                                        'code'            => generateCode('issues'),
                                        'assignee'        => User::role('admin')->first()->id,
                                        'subject'         => $issue['issue_title'],
                                        'reproducibility' => $issue['reproducibility'],
                                        'severity'        => $issue['severity'],
                                        'priority'        => $issue['priority'],
                                        'description'     => $issue['bug_description'],
                                        'user_id'         => $issue['reporter'] > 0 ? User::where('email', $data['fx_users']->where('id', $issue['reporter'])->first()['email'])->first()->id : 1,
                                        'status'          => optional(Status::where('status', $issue['bug_status'])->first())['id'],
                                    ]);

                                    if (isset($data['fx_bug_comments'])) {
                                        foreach ($data['fx_bug_comments']->where('bug_id', $issue['bug_id']) as $bug) {
                                            $i->comments()->create([
                                                'user_id' => $bug['comment_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $bug['comment_by'])->first()['email'])->first()->id : 1,
                                                'message' => $bug['comment'],
                                            ]);
                                        }
                                    }
                                }
                            }
                            // Import project files
                            if (isset($data['fx_files'])) {
                                foreach ($data['fx_files']->where('project', $project['project_id']) as $file) {
                                    $pr->files()->create([
                                        'filename'     => $file['file_name'],
                                        'title'        => $file['title'],
                                        'path'         => $file['path'],
                                        'ext'          => $file['ext'],
                                        'size'         => $file['size'],
                                        'is_image'     => (int) $file['is_image'],
                                        'image_width'  => $file['image_width'],
                                        'image_height' => $file['image_height'],
                                        'description'  => $file['description'],
                                        'user_id'      => $file['uploaded_by'] > 0 ? User::where('email', $data['fx_users']->where('id', $file['uploaded_by'])->first()['email'])->first()->id : 1,
                                    ]);
                                }
                            }
                            // Import project timesheets
                            if (isset($data['fx_project_timer'])) {
                                foreach ($data['fx_project_timer']->where('project', $project['project_id']) as $entry) {
                                    $staff = $entry['user'] == 0 || is_null(optional(User::where('email', $data['fx_users']->where('id', $entry['user'])->first()['email'])->first())->id) ? 1 : User::where('email', $data['fx_users']->where('id', $entry['user'])->first()['email'])->first()->id;
                                    $pr->timesheets()->create([
                                        'start'    => (int) $entry['start_time'],
                                        'end'      => (int) $entry['end_time'],
                                        'billable' => (int) $entry['billable'],
                                        'total'    => (int) $entry['time_in_sec'],
                                        'notes'    => $entry['description'],
                                        'billed'   => $entry['status'] == '1' ? 1 : 0,
                                        'user_id'  => $staff,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
            // Import Tickets
            if (isset($data['fx_tickets'])) {
                foreach ($data['fx_tickets'] as $ticket) {
                    $support = Ticket::create([
                        'code'       => generateCode('tickets'),
                        'subject'    => $ticket['subject'],
                        'user_id'    => $ticket['reporter'] > 0 ? User::where('email', $data['fx_users']->where('id', $ticket['reporter'])->first()['email'])->first()->id : 0,
                        'body'       => $ticket['body'],
                        'status'     => Status::where('status', $ticket['status'])->first()->id,
                        'department' => Department::where('deptname', $data['fx_departments']->where('deptid', $ticket['department'])->first()['deptname'])->first()->deptid,
                        'created_at' => validateDate($ticket['created']) ? dateParser($ticket['created'])->toDateTimeString() : now(),
                    ]);
                    if (isset($data['fx_ticketreplies'])) {
                        foreach ($data['fx_ticketreplies']->where('replierid', $user['id']) as $reply) {
                            $support->comments()->create([
                                'user_id'    => $member->id,
                                'message'    => $reply['body'],
                                'created_at' => validateDate($reply['time']) ? dateParser($reply['time'])->toDateTimeString() : now(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}
