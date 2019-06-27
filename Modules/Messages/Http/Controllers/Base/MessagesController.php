<?php

namespace Modules\Messages\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Files\Helpers\Uploader;
use Modules\Messages\Entities\Emailing;
use Modules\Messages\Entities\Message;
use Modules\Messages\Facades\Talk;
use Modules\Messages\Http\Requests\NewMessageRequest;
use Modules\Users\Entities\User;

abstract class MessagesController extends Controller
{
    /**
     * Request Instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', 'talk', '2fa', 'can:menu_messages']);
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']    = $this->getPage();
        $data['group']   = request('group', 'inbox');
        $data['threads'] = Talk::threads();

        return view('messages::index')->with($data);
    }

    public function chatHistory($id)
    {
        $conversations = Talk::getMessagesByUserId($id, 0, 200);
        $user          = '';
        $messages      = [];
        if (!$conversations) {
            $user = User::findOrFail($id);
        } else {
            $user     = $conversations->withUser;
            $messages = $conversations->messages;
        }

        $data['page']     = $this->getPage();
        $data['messages'] = $messages;
        $data['threads']  = Talk::threads();
        $data['user']     = $user;

        return view('messages::conversations')->with($data);
    }

    public function newMessage()
    {
        $data['page']    = $this->getPage();
        $data['threads'] = Talk::threads();

        return view('messages::newMessage')->with($data);
    }

    public function ajaxSend()
    {
        if ($this->request->ajax()) {
            $rules = [
                'message-data' => 'required',
                '_id'          => 'required',
            ];

            $this->validate($this->request, $rules);

            $body    = $this->request->input('message-data');
            $userId  = $this->request->input('_id');
            $message = Talk::sendMessageByUserId($userId, $body);
            $html    = view('messages::partials.newMessageHtml', compact('message'))->render();

            return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('sent_successfully')], 200);
        }
    }

    public function ajaxDeleteMessage($id)
    {
        if ($this->request->ajax()) {
            if (Talk::deleteMessage($id)) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'msg' => 'something went wrong'], 401);
        }
    }

    public function pusherMessage(Message $message)
    {
        $html = view('messages::partials.newMessageReceived', compact('message'))->render();

        return response()->json(['html' => $html, 'sender' => $message->sender->name], 200);
    }

    public function send(NewMessageRequest $request)
    {
        $body    = $request->input('message');
        $userIds = $request->input('to');

        $sentMessages = [];

        foreach ($userIds as $user) {
            $sentMessages[] = Talk::sendMessageByUserId($user, $body);
        }

        if ($request->hasFile('uploads')) {
            foreach ($sentMessages as $message) {
                $this->makeUploads($message, $request);
            }
        }
        $data['message']  = langapp('sent_successfully');
        $data['redirect'] = route('messages.index');

        return ajaxResponse($data);
    }

    public function emailDelete(Emailing $mail)
    {
        $data['mail'] = $mail;

        return view('messages::modal.delete_email')->with($data);
    }
    public function emailDestroy(Emailing $mail)
    {
        if (isAdmin() || $mail->from == \Auth::id()) {
            $mail->delete();
            $data['message']  = langapp('action_completed');
            $data['redirect'] = url()->previous();

            return ajaxResponse($data);
        }
    }

    protected function makeUploads($message, $request)
    {
        $request->request->add(['module' => 'messages']);
        $request->request->add(['module_id' => $message->id]);
        $request->request->add(['title' => 'Message Attachment']);
        $request->request->add(['description' => 'Message attached file']);

        return (new Uploader)->save('uploads/messages', $request);
    }

    private function getPage()
    {
        return langapp('messages');
    }
}
