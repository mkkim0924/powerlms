<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\ChatParticipant;
use App\Models\ChatThread;
use App\Models\CourseUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $user_id = $user->id;
        $currentThread = null;
        if ($request->has('id')) {
            $courseUser = CourseUser::findOrFail($request->input('id'));
            $currentThread = ChatThread::where('course_user_id', $request->input('id'))->first();
            if (is_null($currentThread)) {
                $currentThread = ChatThread::create([
                    'user_id' => $user_id,
                    'course_id' => $courseUser->course_id,
                    'course_user_id' => $request->input('id')
                ]);

                ChatParticipant::create([
                    'user_id' => $user_id,
                    'thread_id' => $currentThread->id,
                ]);
                ChatParticipant::create([
                    'user_id' => $courseUser->courseDetails->instructor_id,
                    'thread_id' => $currentThread->id,
                ]);
            }
        }
        if ($request->has('thread_id')) {
            $currentThread = ChatThread::findOrFail($request->input('thread_id'));
        }
        $threads = ChatThread::with(['courseDetail', 'unreadChatMessages'])->whereHas('courseDetail')->whereHas('chatParticipants', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->orderBy('updated_at', 'DESC')->get();
        if (count($threads) > 0 && !isset($currentThread)){
            $currentThread = $threads[0];
        }
        if (isset($currentThread)){
            ChatMessage::whereNull('read_at')->where('thread_id', $currentThread->id)->where('user_id', '!=', $user_id)->update(['read_at' => Carbon::now()]);
        }
        return view('front-end.chat.index', compact('user', 'threads', 'currentThread'));
    }

    public function sendMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $requestData = $request->all();
        $chatMessage = ChatMessage::create([
            'thread_id' => $requestData['thread_id'],
            'user_id' => $user->id,
            'body' => $requestData['message']
        ]);
        ChatThread::where('id', $requestData['thread_id'])->update(['updated_at' => Carbon::now()]);
        $type = 'sender';
        $returnHtml = view('front-end.chat.partials.new_message', compact('user', 'chatMessage', 'type'))->render();
        return response()->json(['status' => true, 'html' => $returnHtml, 'last_message_id' => $chatMessage->id]);
    }

    public function checkNewMessage(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $requestData = $request->all();
        if (isset($requestData['thread_id'])){
            $chatMessage = ChatMessage::where('user_id', '!=', $user->id)->where('thread_id', $requestData['thread_id'])->orderBy('id', 'desc')->first();
            if (isset($chatMessage) && $chatMessage->id > $requestData['last_message_id']) {
                ChatMessage::where('user_id', '!=', $user->id)->where('thread_id', $requestData['thread_id'])->whereNull('read_at')
                    ->update(['read_at' => Carbon::now()]);
                $type = 'receiver';
                $returnHtml = view('front-end.chat.partials.new_message', compact('user', 'chatMessage', 'type'))->render();
                return response()->json(array('success' => true, 'html' => $returnHtml, "last_message_id" => $chatMessage->id));
            }
        }
        return response()->json(array('success' => true, 'html' => "", "last_message_id" => null));
    }
}
