<?php

namespace Modules\Users\Http\Controllers\Base;

use App\Entities\Announcement;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

abstract class AnnouncementController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Announcement Model
     *
     * @var Announcement
     */
    protected $announcement;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request      = $request;
        $this->announcement = new Announcement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = $this->getPage();

        return view('users::announcements.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $data['page'] = $this->getPage();

        return view('users::announcements.create')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $data['announcement'] = $this->announcement->findOrFail($id);
        return view('users::announcements.update')->with($data);
    }

    private function getPage()
    {
        return langapp('announcements');
    }
}
