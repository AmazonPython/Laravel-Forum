@extends('layouts.app')

@section('title')
    @lang('messages.threads_edit') - {{ config('app.name') }}
@endsection

@section('js')
    @include('partials.editor')
    @include('partials.recaptcha')
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
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>
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
