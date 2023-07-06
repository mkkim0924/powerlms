<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\ChatThread;
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
        if ($request->has('thread_id')) {
            $currentThread = ChatThread::findOrFail($request->input('thread_id'));
        }
        $threads = ChatThread::with(['courseDetail', 'unreadChatMessages'])->whereHas('chatMessages')->whereHas('courseDetail')->whereHas('chatParticipants', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        })->orderBy('updated_at', 'DESC')->get();
        if (count($threads) > 0 && !isset($currentThread)){
            $currentThread = $threads[0];
        }
        if (isset($currentThread)) {
            ChatMessage::whereNull('read_at')->where('thread_id', $currentThread->id)->where('user_id', '!=', $user_id)->update(['read_at' => Carbon::now()]);
        }
        return view('admin.chat.index', compact('threads', 'currentThread', 'user'));
    }
}
