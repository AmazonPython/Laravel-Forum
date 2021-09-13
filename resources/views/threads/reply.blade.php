@auth
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/tinymce4x_languages/langs/zh_CN.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor',
            language: '@lang('messages.threads_create_editor')',
            height: 400,
            placeholder: '@lang('messages.threads_reply_placeholder')',
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste imagetools wordcount'
            ],
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
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
