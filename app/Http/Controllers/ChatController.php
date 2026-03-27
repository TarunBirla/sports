<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\String\s;

class ChatController extends Controller
{
    // ================= USER =================
    public function userChat()
    {
        $user = Auth::user();

        $trainerId = auth()->user()->trainer_id;

        $vendors = Vendor::
                    where('id', $trainerId)
                    ->get();

        $chats = Chat::where('user_id', $user->id)
            ->with('vendor')
            ->get();

        return view('dashboard.chat', compact('vendors', 'chats'));
    }

    // ================= VENDOR =================
    public function vendorChat()
    {
        $vendor = Auth::user();

        $users = User::where('role', 'user')->get();

        $chats = Chat::where('vendor_id', $vendor->id)
            ->with('user')
            ->get();

        return view('vendor.chat', compact('users', 'chats'));
    }

    // ================= CREATE CHAT =================
    public function createChat(Request $request)
    {

        if($request->vendor_id ==0) {
            $vendorId=session('vendor_id');
        }
        $chat = Chat::firstOrCreate([
            'user_id' => $request->user_id,
            'vendor_id' => $vendorId ?? $request->vendor_id
        ]);

        return response()->json($chat);
    }

    // ================= GET MESSAGES =================
    public function getMessages(Chat $chat)
    {
        return Message::where('chat_id', $chat->id)
            ->with('sender')
            ->orderBy('created_at')
            ->get();
    }

    // ================= SEND MESSAGE =================
    public function sendMessage(Request $request)
    {
        $msg = Message::create([
            'chat_id' => $request->chat_id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'type' => 'text',
            'created_at' => now()
        ]);

        return response()->json($msg);
    }
}