@extends('layouts.app')

@section('title')
    {{ trans('messages.profiles_title') }} - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h1>{{ $profileUser->name }}</h1>
                <small>{{ trans('messages.profiles_joined') }} {{ $profileUser->created_at->diffForHumans() }}</small>
            </div><br /><hr>

            <div class="card-body">
                @forelse ($threads as $thread)
                    <h3 class="text-center">
                        <a href="{{ url($thread->path()) }}" style="text-decoration: none;">{{ $thread->title }}
                            @auth
                                <form action="{{ $thread->path() }}" method="post" class="float-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        {{ trans('messages.threads_delete') }}
                                    </button>
                                </form><hr>
                            @endauth
                        </a>
                    </h3>
                    <div class="card-header">
                        <a><b>{{ $thread->creator->name }}</b> {{ trans('messages.threads_index_published') }} <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                        <br />{{ trans('messages.threads_index_there_have_been') }}
                        <a><b>{{ $thread->visits }}</b> {{ trans('messages.threads_visits') }}</a>
                        <a><b>{{ $thread->replies_count }}</b> {{ trans('messages.threads_replies') }}</a>
                    </div>

                    <div class="card-body">
                        <p class="lead">{!! Str::limit($thread->body, 255) !!}</p>
                    </div>
                    <br /><hr>
                @empty
                    <div class="card-body">{{ trans('messages.threads_index_empty') }}</div>
                @endforelse
            </div>
            {{ $threads->links() }}
        </div>
    </div>
</div>
@endsection
