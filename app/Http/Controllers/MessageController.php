<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\MyMail;
use App\File;
use App\User;
use App\Message;
use Auth;
use Gate;

class MessageController extends Controller
{
    public function shareFile($id)
    {
        $file = File::find($id);
        $users = User::all();

        return view('pages.sharefile')
             ->with('file', $file)
             ->with('users', $users);
    }

    public function sendFile(Request $request, $id)
    {
        $subject = $request->input('subject');
        $sender_id = Auth::user()->id;
        $receiver_id = $request->input('users');
        $file_id = $id;
        $message_text = $request->input('message');

        $file = new Message(array(
            'subject' => $subject,
            'sender_id' => $sender_id,
            'sender_deleted' => 0,
            'receiver_deleted' => 0,
            'receiver_id' => $receiver_id,
            'file_id' => $file_id,
            'message' => $message_text
        ));

        $file->save();

        $title = 'Up - new message';
        $sender_user = User::find($sender_id);
        $receiver_user = User::find($receiver_id);
        $file_name = File::find($file_id)->org_name;
        $download_url = 'https://infinite-plains-55198.herokuapp.com/download/' . $file_id;

        Mail::to($receiver_user->email)->send(new MyMail($sender_user->name, $receiver_user->name, $file_name, $message_text, $download_url));

        return redirect('/messages/' . $sender_id)->with('status', 'Message sent!');
    }

    public function messageInbox($id)
    {
        if ( Gate::forUser(Auth::user())->allows('view', $id) ) {

            $allUsers = User::all();
            $sentMessages = Message::where('sender_id', '=', $id)
                ->where('sender_deleted', '=', '0')->get();
            $receivedMessages = Message::where('receiver_id', '=', $id)
                ->where('receiver_deleted', '=', '0')->get();

            return view('pages.messageinbox')
                ->with('sentMessages', $sentMessages)
                ->with('receivedMessages', $receivedMessages)
                ->with('allUsers', $allUsers);

        } else {
            return redirect('/')->with('status', 'You are not allowed to access this url');
        }
    }

    public function displayMessage($user_id, $msg_id)
    {
        $message = Message::find($msg_id);


        $user = User::where('id', '=', $message->receiver_id)->first();

        if ( Gate::forUser(Auth::user())->allows('view', $user_id) ) {

            $file = File::find($message->file_id);

            return view('pages.displaymessage')
                ->with('user', $user)
                ->with('file', $file)
                ->with('message', $message);

        } else {
            return redirect('/')->with('status', 'You are not allowed to access this url');
        }
    }

    public function deleteMessage($id) {

        $message = Message::find($id);

        if ( $message->sender_id === Auth::user()->id ) {
            $message->sender_deleted = 1;
        } else {
            $message->receiver_deleted = 1;
        }

        $message->save();

        if ( $message->receiver_deleted === 1 && $message->sender_deleted === 1 ) {
            $message->delete();
        }

        return redirect('/messages/' . Auth::user()->id)->with(['status' => 'Message deleted']);
    }
}
