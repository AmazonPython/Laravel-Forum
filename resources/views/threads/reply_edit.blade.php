@extends('layouts.app')

@section('title')
    @lang('messages.threads_edit') - {{ config('app.name') }}
@endsection

@section('js')
    @include('partials.editor')
    {{--<script src="https://www.google.com/recaptcha/api.js" async defer></script>--}}
    <!-- 中国大陆地区无法连接到谷歌服务的代替方案 -->
    <script src="https://recaptcha.net/recaptcha/api.js" async defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="color: #e27575;">
                        <h3>@lang('messages.threads_edit')</h3>
                    </div>
                    @include('partials.errors')

                    <div class="card-body">
                        <form method="post" action="{{ url('replies', $reply->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="editor">{{ $reply->body }}</textarea>
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ env('recaptcha_key') }}"></div>
                            <button type="submit" class="btn btn-primary">
                                @lang('messages.threads_publish_thread')
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
