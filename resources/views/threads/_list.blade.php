<h3 class="text-center">
    <a href="{{ url($thread->path()) }}" style="text-decoration: none;">
        @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
            <strong>
                {{ $thread->title }}
            </strong>
        @else
            {{ $thread->title }}
        @endif
    </a>
</h3>

<div class="card-header">
    <a href="{{ route('profile', $thread->creator) }}" style="text-decoration: none;">
        <img src="{{ $thread->creator->avatar ?: $thread->creator->defaultAvatar() }}" alt="{{ $thread->creator->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
        <b>{{ $thread->creator->name }}</b>({{ $thread->creator->reputation }} XP)
    </a>
    <a>@lang('messages.threads_index_published') <b>{{ $thread->created_at->diffForHumans() }}</b></a>
    <br />@lang('messages.threads_index_there_have_been')
    <a><b>{{ $thread->visits }}</b> @lang('messages.threads_visits')</a>
    <a><b>{{ $thread->replies_count }}</b> @lang('messages.threads_replies')</a>
