@extends('layouts.app')

@section('title')
    首页 - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>首页</h3>
                </div>

                <div class="card-body">
                    @forelse ($threads as $thread)
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
                            <p class="lead">{!! Str::limit($thread->body, 255) !!}</p>
                        </div>
                        <br /><hr>
                    @empty
                        <div class="card-body">目前尚无相关结果(=￣ω￣=)···</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
