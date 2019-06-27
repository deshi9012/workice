<?php

namespace Modules\Notes\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Notes\Entities\Note;
use Modules\Notes\Transformers\NotesResource;

class NotesApiController extends Controller
{
    /**
     * Request Instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Note Model
     *
     * @var \Modules\Notes\Entities\Note
     */
    protected $note;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->note = new Note;
    }
    /**
     * Get all user notes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(\Auth::user()->notes, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $note = \Auth::user()->notes()->create(
            [
            'name' => $this->request->name,
            'description' => $this->request->description,
            'date' => $this->request->date,
            'user_id' => \Auth::id()
            ]
        );

        return response($note, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update($id = null)
    {
        $note = $this->note->findOrFail($id);
        $note->update(
            [
            'name' => $this->request->name,
            'description' => $this->request->description,
            'date' => $this->request->date,
            ]
        );
        return response($note, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id = null)
    {
        $note = $this->note->where('id', $id)->first();
        $note->delete();
        return response(null, Response::HTTP_OK);
    }
}
