@extends('layouts.app')

@section('title')
    {{ $thread->title }} - {{ config('app.name') }}
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
                        <form method="post" action="{{ url($thread->path() ) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="{{ $thread->channel->id }}">{{ $thread->channel->name }}</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                            {{ $channel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="title" type="text" class="form-control" minlength="2" maxlength="100" placeholder="@lang('messages.threads_title')" value="{{ $thread->title }}" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="body" id="editor">{{ $thread->body }}</textarea>
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
