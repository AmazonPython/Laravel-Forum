<div class="card-body">
    @auth
        <form action="{{ url($thread->path() . '/replies') }}" method="post">
            @csrf
            <div class="form-group">
                <textarea name="body" class="form-control" placeholder="有什么想要说的吗？">{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                评论
            </button>
        </form>

        @foreach ($thread->replies as $reply)
            <div class="card-body">
                {{$reply->owner->name}} <br />{!! $reply->body !!}<hr>
            </div>
        @endforeach
    @else
        <a href="{{ route('login') }}">请点击此处</a>登录后评论
    @endauth
</div>
