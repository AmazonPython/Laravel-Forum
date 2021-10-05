@extends('layouts.app')

@section('title')
    {{ $thread->title }} - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>@lang('messages.threads_show_title')</h3>
                </div>

                <div class="card-body">
                    <h3 class="text-center">
                        <a href="{{ url($thread->path()) }}" style="text-decoration: none;">{{ $thread->title }}</a>
                    </h3>
                    <div class="card-header">
                        <a href="{{ route('profile', $thread->creator) }}" style="text-decoration: none;">
                            <img src="{{ $thread->creator->avatar ?: 'https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/avatar.jpeg' }}" alt="{{ $thread->creator->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                            <b>{{ $thread->creator->name }}</b>
                        </a>
                        <a>@lang('messages.threads_index_published') <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                        @auth
                            @if ($thread->subscribe(Auth::id())->exists())
                                <a href="{{ $thread->path() . '/unsubscribe' }}" type="button" class="btn btn-info float-right">
                                    @lang('messages.threads_unsubscribe')
                                </a>
                            @else
                                <a href="{{ $thread->path() . '/subscribe' }}" type="button" class="btn btn-primary float-right">
                                    @lang('messages.threads_subscribe')
                                </a>
                            @endif
                        @endauth
                        <br />@lang('messages.threads_index_there_have_been')
                        <a><b>{{ $thread->visits }}</b> @lang('messages.threads_visits')</a>
                        <a><b>{{ $thread->replies_count }}</b> @lang('messages.threads_replies')</a>
                    </div>

                    <div class="card-body">
                        <p class="lead">{!! $thread->body !!}</p>
                    </div>
                    <div class="card-footer">
                        @include('threads.reply')
                        {{ $replies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
