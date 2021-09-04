<div class="card-body">
    @auth
        <form action="{{ url($thread->path() . '/replies') }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="@lang('messages.threads_reply_placeholder')" rows="10" required>{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">@lang('messages.threads_reply_button')</button>
        </form>

        @foreach ($replies as $reply)
            <br />
            <div class="card-header">
                <a href="{{ route('profile', $reply->owner) }}" style="text-decoration: none;"><b>{{ $reply->owner->name }}</b> </a>
                <a>@lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b>
                    <form action="/replies/{{ $reply->id }}}/favorites" method="post" class="float-right">
                        @csrf
                        <button type="submit" class="btn btn-primary" {{ $reply->isFavorited() ? 'disabled' : '' }} title="@lang('messages.threads_reply_favorite')">
                            {{ $reply->favorites()->count() }} ❤️
                        </button>
                    </form><br />
                </a><br />
            </div>
            <div class="card-header">{!! $reply->body !!}</div>
        @endforeach
    @else
        <a href="{{ route('login') }}" style="text-decoration: none;">@lang('messages.threads_login_to_reply')</a><hr>
        @foreach ($thread->replies as $reply)
            <br />
            <div class="card-header">
                <a><b>{{ $reply->owner->name }}</b> @lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b>
                    <button type="submit" class="btn btn-primary float-right" title="@lang('messages.threads_reply_favorite')">
                        {{ $reply->favorites()->count() }} @lang('messages.threads_reply_favorite')
                    </button><br />
                </a><br />
            </div>
            <div class="card-header">{!! $reply->body !!}</div>
        @endforeach
    @endauth
</div>
