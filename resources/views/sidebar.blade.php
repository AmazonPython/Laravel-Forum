<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            @lang('messages.threads_trending')
        </div>
        <div class="card-body">
            <ul class="list-group">
                @forelse ($trending as $thread)
                    <li class="list-group-item">
                        <a href="{{ url($thread->path) }}" style="color: #333333;">
                            {{ $thread->title }}
                        </a>
                    </li>
                @empty
                    @lang('messages.threads_no_trending')
                @endforelse
            </ul>
        </div>
    </div>
</div>
