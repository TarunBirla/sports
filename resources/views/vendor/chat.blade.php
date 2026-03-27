@extends('vendor.layout')

@section('content')

<div class="flex h-[85vh] bg-gray-100 rounded-xl overflow-hidden shadow">

    <!-- Sidebar -->
    <div class="w-1/3 bg-white border-r overflow-y-auto">
        <div class="p-4 font-semibold text-lg border-b">
            Users
        </div>

        @foreach($allusers as $user)
            <div class="user-item p-4 cursor-pointer border-b flex items-center gap-3 transition hover:bg-gray-100"
                 data-id="{{ $user->id }}">

                <div class="w-10 h-10 bg-blue-500 text-white flex items-center justify-center rounded-full">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>

                <div>
                    <div class="font-medium">{{ $user->name }}</div>
                    <div class="text-sm text-gray-500">Click to chat</div>
                </div>

            </div>
        @endforeach
    </div>

    <!-- Chat Area -->
    <div class="w-2/3 flex flex-col">

        <!-- Header -->
        <div class="p-4 bg-white border-b font-semibold">
            Chat
        </div>

        <!-- Messages -->
        <div id="messages" class="flex-1 p-4 overflow-y-auto space-y-2 bg-gray-50"></div>

        <!-- Input -->
        <div class="p-3 bg-white border-t flex gap-2">
            <input id="msg"
                   type="text"
                   placeholder="Type a message..."
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">

            <button id="sendBtn"
                    class="bg-blue-500 text-white px-5 py-2 rounded-full hover:bg-blue-600 transition">
                Send
            </button>
        </div>

    </div>
</div>

@endsection


@push('scripts')
<script>

let currentChat = null;
let myId = {{ auth()->id() ?? 0 }};

console.log("JS LOADED ✅");

// Click users
document.querySelectorAll('.user-item').forEach(function(el) {
    el.addEventListener('click', function() {

        document.querySelectorAll('.user-item').forEach(function(item) {
            item.classList.remove('bg-blue-100', 'border-l-4', 'border-blue-500');
        });

        this.classList.add('bg-blue-100', 'border-l-4', 'border-blue-500');

        let userId = this.getAttribute('data-id');
        startChat(userId);
    });
});

// Send button
document.getElementById('sendBtn').addEventListener('click', send);

// Enter key
document.getElementById('msg').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') send();
});

// Start chat
function startChat(userId) {
    fetch('/chat/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            user_id: userId,
            vendor_id: myId
        })
    })
    .then(res => res.json())
    .then(chat => {
        currentChat = chat.id;
        loadMessages();
    });
}

// Load messages
function loadMessages() {

    if (!currentChat) return;

    fetch('/chat/messages/' + currentChat)
    .then(res => res.json())
    .then(data => {

        let html = '';

        data.forEach(function(m) {

            let me = m.sender_id == myId;
            let align = me ? 'justify-end' : 'justify-start';
            let bubble = me ? 'bg-blue-500 text-white' : 'bg-gray-200';

            html += `
                <div class="flex ${align}">
                    <div class="${bubble} px-4 py-2 rounded-2xl max-w-xs break-words">
                        ${m.message}
                    </div>
                </div>
            `;
        });

        let msgBox = document.getElementById('messages');
        msgBox.innerHTML = html;
        msgBox.scrollTop = msgBox.scrollHeight;
    });
}

// Send message
function send() {

    let msgInput = document.getElementById('msg');
    let msg = msgInput.value;

    if (!msg.trim() || !currentChat) return;

    fetch('/chat/send', {
        method:'POST',
        headers:{
            'Content-Type':'application/json',
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        body: JSON.stringify({
            chat_id: currentChat,
            message: msg
        })
    })
    .then(()=>{
        msgInput.value = '';
        loadMessages();
    });
}

// Auto refresh
setInterval(() => {
    if(currentChat) loadMessages();
}, 2000);

</script>
@endpush