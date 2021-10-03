@auth
@section('js')
    @include('partials.editor')
@endsection

    @include('partials.errors')
    <form action="{{ url($thread->path() . '/replies') }}" method="post">
        @csrf
        <div class="form-group">
            <span class="text-muted">@lang('messages.threads_discussion')</span>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" id="editor">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">@lang('messages.threads_reply_button')</button>
    </form>
    @foreach ($replies as $reply)
        @include('threads.favorite')
    @endforeach
@else
    <a href="{{ route('login') }}" style="text-decoration: none;">@lang('messages.threads_login_to_reply')</a><hr>
    @foreach ($thread->replies as $reply)
        @include('threads.favorite')
    @endforeach
@endauth
