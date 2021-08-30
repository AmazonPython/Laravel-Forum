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
                    <div class="card-header">
                        <a><b>{{ $thread->creator->name }}</b> 发布于 <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                        <br />已有
                        <a><b>{{ $thread->visits }}</b> 次阅读，</a>
                        <a><b>{{ $thread->replies_count }}</b> 条评论</a>
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
