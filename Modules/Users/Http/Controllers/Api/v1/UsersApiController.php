<?php

namespace Modules\Users\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;
use Modules\Users\Events\UserUpdated;
use Modules\Users\Http\Requests\UserRequest;
use Modules\Users\Transformers\UserResource;
use Modules\Users\Transformers\UsersResource;

class UsersApiController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    public $request;
    /**
     * User Model
     *
     * @var User
     */
    public $user;

    public function __construct(Request $request)
    {

        $this->middleware('localize');
        $this->request = $request;
        $this->user    = new User;
    }

    public function index()
    {
        $users = new UsersResource(
            $this->user->with(['profile.business:id,name'])
                ->orderByDesc('id')
                ->paginate(50)
        );
        return response($users, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $user = $this->user->findOrFail($id);

        return response(new UserResource($user), Response::HTTP_OK);
    }

    public function save(UserRequest $request)
    {

        $this->checkPassword($request);
        $userColumns = ['username', 'email', 'password', 'name', 'locale', 'desk_id'];

        $user        = $this->user->create($request->only($userColumns));
        $user->desk_id = $request->desk;
        $user->update(['email_verified_at' => config('system.verification') ? null : now()]);
        $user->profile->update($request->except(['username', 'password', 'email', 'roles', 'department', 'name', 'locale','desk_id']));

        $user->syncRoles($request->roles);

        return ajaxResponse(
            [
                'id'       => $user->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('users.index'),
            ],
            true,
            Response::HTTP_CREATED
        );
    }

    public function update(UserRequest $request, $id = null)
    {
        logger($request->all());
        $this->checkPassword($request);
        $user = $this->user->findOrFail($id);
        $user->update($request->all());
        $user->desk_id = $request->all()['desk'];
        $user->save();
        $user->profile->update($request->all());
        $user->syncRoles($request->roles);
        event(new UserUpdated($user));
        return ajaxResponse(
            [
                'id'       => $user->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('users.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function ban($id = null)
    {
        $user = $this->user->findOrFail($id);
        $user->update(['banned' => $user->banned ? 0 : 1, 'ban_reason' => $this->request->ban_reason]);
        return ajaxResponse(
            [
                'id'       => $user->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('users.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id = null)
    {
        $model = $this->user->find($id);
        $model->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('users.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    private function checkPassword($request)
    {
        if (config('system.secure_password')) {
            return $request->validate(['password' => 'sometimes|pwned']);
        }
        return;
    }
}
