<br />
<div class="card-header">
    <reply :attributes="{{ $reply }}" inline-template v-cloak>
        <div id="reply-favorite-{{ $reply->id }}" class="panel panel-default">
            <a href="{{ route('profile', $reply->owner) }}" id="{{ $thread->path() }}#reply-{{ $reply->owner->name }}" style="text-decoration: none;">
                <b>{{ $reply->owner->name }}</b>
            </a>
            <a>@lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b></a>
            <a class="float-right" title="@lang('messages.threads_reply_favorite')">
                @if (Auth::check())
                    <favorite :reply="{{ $reply }}"></favorite>
               @endif
            </a><br /><br />
        </div>
    </reply>
</div>
<div class="card-header">{!! $reply->body !!}</div>
