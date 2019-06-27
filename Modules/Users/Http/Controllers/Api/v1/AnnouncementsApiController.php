<?php

namespace Modules\Users\Http\Controllers\Api\v1;

use App\Entities\Announcement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\AnnouncementRequest;
use Modules\Users\Notifications\AnnouncementAlert;

class AnnouncementsApiController extends Controller
{
    public $request;
    public $announcement;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request      = $request;
        $this->announcement = new Announcement;
    }

    public function save(AnnouncementRequest $request)
    {
        $announcement = $this->announcement->create($request->all());
        \Notification::send(User::active()->get(), (new AnnouncementAlert($announcement))->delay(dateParser($request->announce_at)));
        return ajaxResponse(
            [
                'id'       => $announcement->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('announcements.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = $this->announcement->findOrFail($id);
        $announcement->update($request->only(['subject', 'url', 'message']));
        return ajaxResponse(
            [
                'id'       => $announcement->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('announcements.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id)
    {
        $announcement = $this->announcement->findOrFail($id);
        $announcement->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('announcements.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
