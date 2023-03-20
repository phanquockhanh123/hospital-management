<div class="card-body msg_card_body">
    @foreach ($messages as $message)
        <div class="{{$message->from == Auth::id() ? 'd-flex justify-content-end mb-4' : 'd-flex justify-content-start mb-4'}}" >
            <div class="{{$message->from == Auth::id() ? 'msg_cotainer_send' : 'img_cont_msg'}}">
                <img src="https://therichpost.com/wp-content/uploads/2020/06/avatar2.png"
                    class="rounded-circle user_img_msg">
            </div>
            <div class="msg_cotainer">
                {{ $message->message }}
                <span class="msg_time" style="position: absolute;
                left: 0;
                bottom: -20px;
                color: rgba(255, 255, 255, 0.5);
                font-size: 10px;">{{ $message->created_at }}</span>
            </div>
        </div>
    @endforeach
</div>