<?php

namespace Modules\Contacts\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Modules\Contacts\Http\Requests\ContactRequest;
use Modules\Contacts\Notifications\InviteContact;
use Modules\Contacts\Transformers\ContactResource;
use Modules\Contacts\Transformers\ContactsResource;
use Modules\Users\Entities\Profile;
use Modules\Users\Entities\User;
use Modules\Users\Jobs\BulkDeleteUsers;

class ContactApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('localize');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */

    public function index()
    {
        $contacts = new ContactsResource(Profile::with(['user:id,username,email,name', 'business:id,name,currency,expense,balance,paid,primary_contact'])->contacts()->orderBy('id', 'desc')->paginate(40));
        if ($this->request->has('json')) {
            $data['contacts'] = $contacts;
            return view('contacts::_ajax._contacts')->with($data);
        }
        return response($contacts, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id = null)
    {
        $contact = Profile::findOrFail($id);
        if (optional($contact)->company > 0) {
            return response(new ContactResource($contact), Response::HTTP_OK);
        }
        return response(['errors' => ['message' => 'User not linked to any company']], Response::HTTP_OK);
    }

    public function save(ContactRequest $request)
    {
        if (!isAdmin() && \Auth::user()->profile->company != $request->company) {
            abort(401);
        }
        $user = User::create($request->except(['company', 'phone', 'invite']));
        $user->update(['email_verified_at' => config('system.verification') ? null : now()]);
        $user->profile->update($request->only(['company', 'phone']));
        if ($request->invite == '1') {
            $user->notify(new InviteContact($user, $request->password));
        }
        return ajaxResponse(
            [
                'id'       => $user->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => $request->has('url') ? $request->url : route('clients.view', ['id' => $user->profile->company]),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id = null)
    {
        $this->request->validate(
            [
                'email'    => [
                    'required',
                    Rule::unique('users')->ignore($id),
                    'email',
                ],
                'name'     => 'required',
                'username' => [
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ]
        );
        $this->checkPassword($this->request);
        $contact = Profile::with(['user:id,username,email', 'business:id,name,currency'])->findOrFail($id);
        $contact->user->update($this->request->only(['username', 'email', 'password', 'name']));
        $contact->update($this->request->except(['id', 'username', 'password', 'email', 'name']));

        return ajaxResponse(
            [
                'id'       => $contact->user->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('contacts.view', ['id' => $contact->id]),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null)
    {
        BulkDeleteUsers::dispatch([$id], \Auth::id())->onQueue('normal');
        return response(null, Response::HTTP_OK);
    }

    private function checkPassword($request)
    {
        if (config('system.secure_password')) {
            return $request->validate(['password' => 'sometimes|pwned']);
        }
        return;
    }
}
