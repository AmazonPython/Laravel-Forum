@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>发布新贴</h3>
                </div>

                <div class="card-body">
                    @auth
                        <form method="post" action="{{ url('threads') }}">
                            @csrf
                            <div class="form-group">
                                <input name="title" type="text" class="form-control" placeholder="标题" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <textarea name="body" class="form-control" placeholder="内容">{{ old('body') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                发送
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}">请点击此处</a>登录后发帖
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
