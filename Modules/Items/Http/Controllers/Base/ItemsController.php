<?php

namespace Modules\Items\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Expenses\Entities\Expense;
use Modules\Invoices\Entities\Invoice;
use Modules\Items\Entities\Item;
use Modules\Items\Exports\ItemsExport;

abstract class ItemsController extends Controller
{
    /**
     * Item Model
     *
     * @var \Modules\Items\Entities\Item
     */
    protected $item;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->item    = new Item;
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = langapp('items');

        return view('items::index')->with($data);
    }
    /**
     * Insert item from item templates
     */
    public function insert($id, $module)
    {
        $data['id']     = $id;
        $data['module'] = $module;

        return view('items::modal.fromtemplate', $data);
    }
    /**
     * Show expenses
     */
    public function expenses(Invoice $invoice)
    {
        $data['invoice'] = $invoice;
        return view('items::modal.expenses')->with($data);
    }
    /**
     * Bill expenses
     */
    public function billExpenses()
    {
        $this->request->validate(['expense' => 'required']);
        if ($this->request->has('expense') && count($this->request->expense) > 0) {
            foreach ($this->request->expense as $key => $ar) {
                $expense = Expense::findOrFail($key);
                $cost    = $expense->cost;
                $invoice = Invoice::findOrFail($this->request->invoice);
                if ($expense->currency != $invoice->currency) {
                    $cost = convertCurrency($expense->currency, $expense->cost, $invoice->currency);
                }
                $invoice->items()->create(
                    [
                        'name'        => langapp('expenses') . ' [' . optional($expense->AsCategory)->name . ']',
                        'description' => $expense->notes . PHP_EOL . '&raquo; ' . dateTimeFormatted($expense->expense_date),
                        'unit_cost'   => $cost,
                        'quantity'    => '1.00',
                    ]
                );
                $expense->update(['invoiced' => 1, 'invoiced_id' => $invoice->id]);
            }
        }
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }
    /**
     * Export invoices as CSV
     */
    public function export($module = 'invoices')
    {
        if (isAdmin()) {
            return (new ItemsExport($module))->download($module . '_items_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }

    public function create()
    {
        return view('items::modal.create');
    }

    public function edit(Item $item)
    {
        $data['item'] = $item;

        return view('items::modal.update', $data);
    }

    public function fromTemplate()
    {
        $template          = $this->item->whereId($this->request->item)->first()->toArray();
        $template['id']    = '';
        $template['order'] = $this->item->latest()->first()->id + 1;
        classByName($this->request->module)->findOrFail($this->request->id)->items()->create($template);
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function autoitems()
    {
        $names = $this->item->groupBy('name')->orderBy('name')->get();
        $name  = array();
        foreach ($names as $n) {
            $name[] = $n->name;
        }

        return ajaxResponse($name);
    }

    public function autoitem()
    {
        $names = $this->item->whereName($this->request->name)->get();
        $name  = $names[0];

        return ajaxResponse($name);
    }

    public function delete(Item $item)
    {
        $data['item'] = $item;

        return view('items::modal.delete', $data);
    }

    public function reOrder()
    {
        if ($this->request->ajax()) {
            $items = $this->request->json;
            $items = json_decode($items);
            foreach ($items[0] as $ix => $item) {
                $this->item->findOrFail($item->id)->update(['order' => ++$ix]);
            }
            return response()->json(
                [
                    'status' => 'success', 'message' => langapp('changes_saved_successful')],
                200
            );
        }
    }
}
