<div class="card-body">
    @auth
        <form action="{{ url($thread->path() . '/replies') }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="有什么想要说的吗？" rows="5" required>{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">评论</button>
        </form>

        @foreach ($thread->replies as $reply)
            <br /><a><b>{{ $reply->owner->name }}</b> 回复于 <b>{{ $reply->created_at->diffForHumans() }}</b></a><br />
            {!! $reply->body !!}<hr>
        @endforeach
    @else
        <a href="{{ route('login') }}" style="text-decoration: none;">请点击此处</a>登录后评论
    @endauth
</div>
