@extends('dashboard.layouts.app')

@section('content')

<div class="flex h-[85vh] bg-gray-100 rounded-xl overflow-hidden shadow">

    <!-- Sidebar -->
    <div class="w-1/3 bg-white border-r overflow-y-auto">
        <div class="p-4 font-semibold text-lg border-b">
            Vendors
        </div>

        @foreach($vendors as $vendor)
            <div class="vendor-item p-4 cursor-pointer border-b flex items-center gap-3 transition hover:bg-gray-100"
                 data-id="{{ $vendor->id }}">

                <!-- Avatar -->
                <div class="w-10 h-10 bg-green-500 text-white flex items-center justify-center rounded-full">
                    {{ strtoupper(substr($vendor->name,0,1)) }}
                </div>

                <!-- Name -->
                <div>
                    <div class="font-medium">{{ $vendor->name }}</div>
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
                   class="flex-1 border rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">

            <button id="sendBtn"
                    class="bg-green-500 text-white px-5 py-2 rounded-full hover:bg-green-600 transition">
                Send
            </button>
        </div>

    </div>
</div>

<script>

let currentChat = null;
let myId = {{ auth()->id() ?? 0 }};

console.log("USER CHAT JS LOADED ✅");

// CLICK VENDOR
document.querySelectorAll('.vendor-item').forEach(function(el) {
    el.addEventListener('click', function() {

        // remove active
        document.querySelectorAll('.vendor-item').forEach(function(item) {
            item.classList.remove(
                'bg-green-100',
                'border-l-4',
                'border-green-500',
                'shadow-sm'
            );
        });

        // add active
        this.classList.add(
            'bg-green-100',
            'border-l-4',
            'border-green-500',
            'shadow-sm'
        );

        let vendorId = this.getAttribute('data-id');

        // save selection
        localStorage.setItem('activeVendor', vendorId);

        startChat(vendorId);
    });
});


// RESTORE LAST SELECTED VENDOR
window.addEventListener('load', function() {
    let saved = localStorage.getItem('activeVendor');
    if (saved) {
        let el = document.querySelector(`.vendor-item[data-id="${saved}"]`);
        if (el) el.click();
    }
});


// SEND BUTTON
document.getElementById('sendBtn').addEventListener('click', send);

// ENTER KEY
document.getElementById('msg').addEventListener('keypress', function(e){
    if(e.key === 'Enter') send();
});


// START CHAT
function startChat(vendorId) {

    fetch('/chat/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            user_id: myId,
            vendor_id: vendorId
        })
    })
    .then(res => res.json())
    .then(chat => {
        currentChat = chat.id;
        loadMessages();
    });
}


// LOAD MESSAGES
function loadMessages() {

    if (!currentChat) return;

    fetch('/chat/messages/' + currentChat)
    .then(res => res.json())
    .then(data => {

        let html = '';

        data.forEach(function(m) {

            let me = m.sender_id == myId;
            let align = me ? 'justify-end' : 'justify-start';
            let bubble = me ? 'bg-green-500 text-white' : 'bg-gray-200';

            html += `
                <div class="flex ${align}">
                    <div class="${bubble} px-4 py-2 rounded-2xl max-w-xs break-words">
                        ${m.message}
                    </div>
                </div>
            `;
        });

        let box = document.getElementById('messages');
        box.innerHTML = html;
        box.scrollTop = box.scrollHeight;

    });

}


// SEND MESSAGE
function send() {

    let input = document.getElementById('msg');
    let msg = input.value;

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
        input.value = '';
        loadMessages();
    });

}


// AUTO REFRESH
setInterval(()=>{
    if(currentChat) loadMessages();
},2000);

</script>

@endsection



