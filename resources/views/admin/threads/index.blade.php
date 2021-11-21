@extends('admin.layouts.app')

@section('title')
    @lang('messages.admin_dashboard') / @lang('messages.threads_trending') - {{ config('app.name') }}
@endsection

@section('administration-content')
<p>
    <a class="btn btn-sm btn-dark" href="{{ route('admin.thread.reset') }}">
        @lang('messages.admin_reset_threads_trending') <span class="glyphicon glyphicon-plus"></span>
    </a>
</p>

<div class="card">
    @forelse ($trending as $thread)
        <li class="list-group-item">
            <a href="{{ url($thread->path) }}" style="color: #333333;">
                {{ $thread->title }}
            </a>
        </li>
    @empty
        @lang('messages.threads_no_trending')
    @endforelse
</div>
@endsection
