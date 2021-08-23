@extends('layouts.app')

@section('title')
    个人中心 - {{ Auth::user()->name }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">个人中心</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    欢迎回来，{{ Auth::user()->name }}！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
