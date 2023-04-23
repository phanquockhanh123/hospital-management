<div class="card-body msg_card_body">
    @foreach ($messages as $message)
        <div class="{{$message->from == Auth::id() ? 'd-flex justify-content-end mb-4' : 'd-flex justify-content-start mb-4'}}" >
            <div class="msg_cotainer" title="{{ $message->created_at }}">
                {{ $message->message }}
            </div>
        </div>
    @endforeach
</div>

