<br />
<div class="card-header">
    <reply :attributes="{{ $reply }}" inline-template v-cloak>
        <div id="reply-favorite-{{ $reply->id }}" class="panel panel-default">
            @if(isset($thread->best_reply_id))
                <a href="{{ route('profile', $reply->owner) }}" id="{{ $thread->path() }}#reply-{{ $reply->owner->name }}" style="text-decoration: none;">
                    <img src="{{ $reply->owner->avatar ?: $reply->owner->defaultAvatar() }}" alt="{{ $reply->owner->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                    <b>{{ $reply->owner->name }}</b>
                </a>
                <a>@lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b></a>

                @if($reply->id == $thread->best_reply_id)
                    <button class="btn  btn-outline-info float-right ml-2">
                        <i class="fas fa-vote-yea">  @lang('messages.threads_best_reply')</i>
                    </button>
                @endif
            @else
                <a href="{{ route('profile', $reply->owner) }}" id="{{ $thread->path() }}#reply-{{ $reply->owner->name }}" style="text-decoration: none;">
                    <img src="{{ $reply->owner->avatar ?: $reply->owner->defaultAvatar() }}" alt="{{ $reply->owner->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                    <b>{{ $reply->owner->name }}</b>
                </a>
                <a>@lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b></a>

                @can('update', $thread->creator)
                    <form method="post" action="{{ route('bestReply', $reply) }}" class="float-right ml-2">
                        @csrf
                        <button class="btn  btn-outline-info">
                            <i class="fas fa-vote-yea"> @lang('messages.threads_set_as_best_reply')</i>
                        </button>
                    </form>
                @endcan
            @endif

            <a class="float-right" title="@lang('messages.threads_reply_favorite')">
                @if (Auth::check())
                    <favorite :reply="{{ $reply }}"></favorite>
               @endif
            </a><br /><br />
        </div>
    </reply>
</div>
<div class="card-header">{!! $reply->body !!}</div>
