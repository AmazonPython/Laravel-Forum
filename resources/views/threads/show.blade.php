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
                    @include('threads._list')

                    @can('update', $thread)
                        <br /><br />
                        <a href="{{ $thread->path() . '/edit' }}" class="btn-sm btn-outline-primary float-left">@lang('messages.threads_edit')</a>
                        <form action="{{ $thread->path() }}" method="post" class="float-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-outline-danger">
                                @lang('messages.threads_delete')
                            </button>
                        </form>
                        <br /><hr>
                    @endcan

                    @auth
                        @if(auth()->user()->isAdmin)
                            @if($thread->locked == true)
                                <form action="{{ url('unlocked', $thread) }}" method="post">
                                    @csrf
                                    <button class="btn-sm btn-outline-primary float-right ml-2">解锁</button>
                                </form>
                            @else
                                <form action="{{ url('locked', $thread) }}" method="post">
                                    @csrf
                                    <button class="btn-sm btn-outline-info float-right ml-2">锁定</button>
                                </form>
                            @endif
                        @endif

                        @if($thread->subscribe(Auth::id())->exists())
                            <a href="{{ $thread->path() . '/unsubscribe' }}" type="button" class="btn-sm btn-outline-primary float-right">
                                @lang('messages.threads_unsubscribe')
                            </a>
                        @else
                            <a href="{{ $thread->path() . '/subscribe' }}" type="button" class="btn-sm btn-outline-info float-right">
                                @lang('messages.threads_subscribe')
                            </a>
                        @endif
                    @endauth<br />
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
