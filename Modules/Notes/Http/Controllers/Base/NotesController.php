<?php

namespace Modules\Notes\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Notes\Entities\Note;
use Modules\Notes\Http\Requests\ModuleNoteRequest;
use Modules\Notes\Http\Requests\NoteRequest;
use Modules\Projects\Entities\Project;

abstract class NotesController extends Controller
{
    /**
     * Note Model
     *
     * @var \Modules\Notes\Entities\Note
     */
    protected $note;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_notes']);
        $this->note    = new Note;
        $this->request = $request;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = $this->getPage();

        return view('notes::index')->with($data);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        return \Auth::user()->notes->toJson();
    }

    public function store()
    {
        $note = $this->note->findOrFail($this->request->id);
        $note->update(
            [
                'name'        => $this->request->name,
                'description' => $this->request->description,
                'date'        => $this->request->date,
                'user_id'     => \Auth::id(),
            ]
        );

        return $note->toJson();
    }

    public function create()
    {
        $note = \Auth::user()->notes()->create(
            [
                'name'        => $this->request->name,
                'description' => is_null($this->request->description) ? 'Note' : $this->request->description,
                'date'        => $this->request->date,
                'user_id'     => \Auth::id(),
            ]
        );

        return $note->toJson();
    }

    public function saveNote(ModuleNoteRequest $request)
    {
        $this->note->create($request->all());
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function get_note($id)
    {
        return $this->note->findOrFail($id)->toJson();
    }

    public function updateNote(Note $note)
    {
        $note->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function editNote(Note $note)
    {
        $data['note'] = $note;

        return view('notes::update')->with($data);
    }

    public function destroyNote(Note $note)
    {
        if ($this->request->ajax()) {
            if ($note->delete()) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'msg' => 'something went wrong'], 401);
        }
    }

    public function project(NoteRequest $request)
    {
        $project = Project::findOrFail($request->project_id);
        $project->update(['notes' => $request->notes]);
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('projects.view', ['id' => $project->id, 'tab' => 'notes']);

        return ajaxResponse($data);
    }

    public function delete()
    {
        $note = $this->note->findOrFail($this->request->id);
        $note->delete();

        return 'Successfull';
    }

    private function getPage()
    {
        return langapp('notes');
    }
}
