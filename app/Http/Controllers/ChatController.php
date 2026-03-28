<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    // USER SIDE
    public function userChat()
    {
        $userId = Auth::user()->id;

        $vendors = Vendor::all();

        return view('dashboard.chat', compact('vendors', 'userId'));
    }

    // VENDOR SIDE
    public function vendorChat()
    {
        $vendorId = session('vendor_id');

        $userIds = \App\Models\Order::distinct()->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        return view('vendor.chat', compact('users', 'vendorId'));
    }

    // GET MESSAGES
   public function getMessages($id)
{
    // ✅ CORRECT DETECTION
    if (session()->has('vendor_id')) {
        $myId = session('vendor_id');
    } else {
        $myId = Auth::id();
    }

    $messages = Message::where(function ($q) use ($myId, $id) {
        $q->where('sender_id', $myId)
          ->where('receiver_id', $id);
    })
    ->orWhere(function ($q) use ($myId, $id) {
        $q->where('sender_id', $id)
          ->where('receiver_id', $myId);
    })
    ->orderBy('created_at')
    ->get();

    return response()->json($messages);
}

    // SEND MESSAGE
   public function sendMessage(Request $request)
{
    if (session()->has('vendor_id')) {
        $senderId = session('vendor_id');
    } else {
        $senderId = Auth::user()->id;
    }

    Message::create([
        'sender_id' => $senderId,
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
        'type' => 'text',
        'created_at' => now()
    ]);

    return response()->json(['status' => true]);
}
}