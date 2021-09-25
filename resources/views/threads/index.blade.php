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
                                {{-- $thread->title --}}
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
                            <a href="{{ route('profile', $thread->creator) }}" style="text-decoration: none;"><b>{{ $thread->creator->name }}</b> </a>
                            <a>@lang('messages.threads_index_published') <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                            <br />@lang('messages.threads_index_there_have_been')
                            <a><b>{{ $thread->visits }}</b> @lang('messages.threads_visits')</a>
                            <a><b>{{ $thread->replies_count }}</b> @lang('messages.threads_replies')</a>
                        </div>

                        <div class="card-body">
                            <p class="lead">{!! Str::limit($thread->body, 255) !!}</p>
                        </div>
                        <br /><hr>
                    @empty
                        <div class="card-body">@lang('messages.threads_index_empty')</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
