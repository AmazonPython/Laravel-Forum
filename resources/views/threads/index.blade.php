@extends('layouts.app')

@section('title')
    @lang('messages.threads_index_title') - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>@lang('messages.threads_index_title')</h3>
                </div>

                <div class="card-body">
                    @forelse ($threads as $thread)
                        <h3 class="text-center">
                            <a href="{{ url($thread->path()) }}" style="text-decoration: none;">
                                @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                    <strong>
                                        {{ $thread->title }}
                                    </strong>
                                @else
                                    {{ $thread->title }}
                                @endif
                            </a>
                        </h3>
                        <div class="card-header">
                            <a href="{{ route('profile', $thread->creator) }}" style="text-decoration: none;">
                                <img src="{{ $thread->creator->avatar ?: $thread->creator->defaultAvatar() }}" alt="{{ $thread->creator->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                                <b>{{ $thread->creator->name }}</b>
                            </a>
                            <a>@lang('messages.threads_index_published') <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                            <br />@lang('messages.threads_index_there_have_been')
                            <a><b>{{ $thread->visits() }}</b> @lang('messages.threads_visits')</a>
                            <a><b>{{ $thread->replies_count }}</b> @lang('messages.threads_replies')</a>
                        </div>

                        <div class="card-body">
                            <p class="lead">{!! Str::limit($thread->body, 255) !!}</p>
                        </div>
                        <br /><hr>
                    @empty
                        <div class="card-body">@lang('messages.threads_index_empty')</div>
                    @endforelse
                    {{ $threads->render() }}
                </div>
            </div>
        </div>
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
    </div>
</div>
@endsection
