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
                    <h3>详情页</h3>
                </div>

                <div class="card-body">
                    <h3 class="text-center">
                        <a href="{{ url($thread->path()) }}" style="text-decoration: none;">{{ $thread->title }}</a>
                    </h3>
                    <a><b>{{ $thread->creator->name }}</b> 发布于 <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                    <div class="card-body">
                        {!! $thread->body !!}
                    </div>
                    <div class="card-footer">
                        <div class="card-title">
                            <a>浏览量：{{ $thread->visits }}</a> |
                            <a href="{{ $thread->path() }}" style="text-decoration: none;">评论：{{ $thread->replies_count }}</a>
                        </div>
                        @include('threads.reply')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
