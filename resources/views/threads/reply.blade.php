<div class="card-body">
    @auth
        <form action="{{ url($thread->path() . '/replies') }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="{{ trans('messages.threads_reply_placeholder') }}" rows="10" required>{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ trans('messages.threads_reply_button') }}</button>
        </form>

        @foreach ($replies as $reply)
            <br />
            <div class="card-header">
                <a><b>{{ $reply->owner->name }}</b> {{ trans('messages.threads_replied') }} <b>{{ $reply->created_at->diffForHumans() }}</b></a><br />
            </div>
            <div class="card-header">{!! $reply->body !!}</div>
        @endforeach
    @else
        <a href="{{ route('login') }}" style="text-decoration: none;">{{ trans('messages.threads_login_to_reply') }}</a><hr>
        @foreach ($thread->replies as $reply)
            <br />
            <div class="card-header">
                <a><b>{{ $reply->owner->name }}</b> {{ trans('messages.threads_replied') }} <b>{{ $reply->created_at->diffForHumans() }}</b></a><br />
            </div>
            <div class="card-header">{!! $reply->body !!}</div>
        @endforeach
    @endauth
</div>
