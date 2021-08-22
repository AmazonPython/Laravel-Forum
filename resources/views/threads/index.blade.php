@extends('layouts.app')

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
                        <a><b>{{ $thread->creator->name }}</b> 发布于 <b>{{ $thread->created_at->diffForHumans() }}</b></a>
                        <div class="card-body">
                            {!! $thread->body !!}
                        </div>
                        <div class="card-footer">
                            <a>浏览量：{{ $thread->visits }}</a> |
                            <a href="{{ $thread->path() }}" style="text-decoration: none;">评论：{{ $thread->replies_count }}</a>
                        </div><br /><br />
                    @empty
                        <div class="card-body">目前尚无相关结果(=￣ω￣=)···</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
