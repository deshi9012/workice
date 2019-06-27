<?php

namespace Modules\Comments\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comments\Entities\Comment;
use Modules\Comments\Http\Requests\CommentRequest;
use Modules\Files\Helpers\Uploader;

abstract class CommentsController extends Controller
{
    protected $comment;
    protected $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->comment = new Comment;
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CommentRequest $request)
    {
        if ($request->parent <= 0) {
            $comment = $this->createComment($request);
        } else {
            $comment = $this->comment->create($request->except(['uploads']));
        }
        if ($request->has('reply_close')) {
            $comment->commentable->closeTicket();
        }

        if ($request->hasFile('uploads')) {
            $this->makeUploads($comment, $request);
        }

        $data['message']  = langapp('sent_successfully');
        $data['redirect'] = $this->request->has('previous_url') ? $this->request->previous_url : url()->previous();

        return ajaxResponse($data);
    }

    public function ajaxSend(CommentRequest $request)
    {
        if ($request->ajax()) {
            if ($comment = $this->createComment($request)) {
                if ($request->has('reply_close')) {
                    $comment->commentable->closeTicket();
                }
                if ($request->hasFile('uploads')) {
                    $this->makeUploads($comment, $request);
                }

                $html = view('comments::newCommentHtml', compact('comment'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('sent_successfully')], 200);
            }
        }
    }

    public function delete(Comment $comment, $module = null)
    {
        $data['comment'] = $comment;
        $data['module']  = $module;

        return view('comments::delete')->with($data);
    }

    public function edit(Comment $comment)
    {
        $data['comment'] = $comment;

        return view('comments::update')->with($data);
    }

    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);
        $comment->update(['message' => $this->request->message]);

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = $this->request->has('previous_url') ? $this->request->previous_url : url()->previous();

        return ajaxResponse($data);
    }

    public function reply(Comment $comment)
    {
        $data['comment'] = $comment;
        return view('comments::reply')->with($data);
    }

    public function ajaxDeleteComment()
    {
        if ($this->request->ajax()) {
            $comment = $this->comment->findOrFail($this->request->id);
            $this->authorize('delete', $comment);
            if ($comment->delete()) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }

    public function destroy()
    {
        $comment = $this->comment->findOrFail($this->request->id);
        $this->authorize('delete', $comment);
        $comment->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect(url()->previous());
    }

    protected function makeUploads($comment, $request)
    {
        $request->request->add(['module' => 'comments']);
        $request->request->add(['module_id' => $comment->id]);
        $request->request->add(['title' => 'Comment file']);
        $request->request->add(['description' => 'Attached comment file']);

        return (new Uploader)->save('uploads/comments', $request);
    }

    private function createComment(CommentRequest $request)
    {
        $model = classByName($request->commentable_type)->findOrFail($request->commentable_id);
        return $model->comments()->create($request->except(['uploads', 'commentable_id', 'commentable_type']));
    }
}
