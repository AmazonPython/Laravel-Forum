@extends('layouts.app')

@section('title')
    @lang('messages.threads_create_title') - {{ config('app.name') }}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>
    <script src="{{ asset('tinymce4x_languages/langs/zh_CN.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor',
            language: 'zh_CN',
            height: 400,
            placeholder: '@lang('messages.threads_content')',
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

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>@lang('messages.threads_create_title')</h3>
                </div>
                @include('partials.errors')

                <div class="card-body">
                    <form method="post" action="{{ url('threads') }}">
                        @csrf
                        <div class="form-group">
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">@lang('messages.threads_choose_channel')</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="title" type="text" class="form-control" placeholder="@lang('messages.threads_title')" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" id="editor">{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            @lang('messages.threads_publish_thread')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
