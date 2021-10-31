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
                <br /><br />
                @if($reply->id == $thread->best_reply_id)
                    <button class="btn btn-sm btn-outline-info float-right">
                        @lang('messages.threads_best_reply')
                    </button>
                @endif
            @else
                <a href="{{ route('profile', $reply->owner) }}" id="{{ $thread->path() }}#reply-{{ $reply->owner->name }}" style="text-decoration: none;">
                    <img src="{{ $reply->owner->avatar ?: $reply->owner->defaultAvatar() }}" alt="{{ $reply->owner->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                    <b>{{ $reply->owner->name }}</b>
                </a>
                <a>@lang('messages.threads_replied') <b>{{ $reply->created_at->diffForHumans() }}</b></a>
                <br /><br />
                @can('update', $thread->creator)
                    <form method="post" action="{{ route('bestReply', $reply) }}" class="float-left">
                        @csrf
                        <button class="btn btn-sm btn-outline-info">
                            @lang('messages.threads_set_as_best_reply')
                        </button>
                    </form>
                @endcan
            @endif

            <a class="float-right" title="@lang('messages.threads_reply_favorite')">
                @if (Auth::check())
                    <favorite :reply="{{ $reply }}"></favorite>
                @endif
            </a><br /><br />

            @can('update', $reply->owner)
                @if($thread->locked == false)
                    <button class="btn btn-sm btn-outline-info">
                        <a href="{{ url('replies/' . $reply->id . '/edit') }}">@lang('messages.threads_edit')</a>
                    </button>
                    <a>
                        <form action="{{ url('replies/' . $reply->id) }}" method="post" class="float-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-danger">
                                @lang('messages.threads_delete')
                            </button>
                        </form>
                    </a><br /><br />
                @endif
            @endcan
        </div>
    </reply>
</div>
<div class="card-header">{!! $reply->body !!}</div>
