@extends('layouts.app')

@section('title')
    邮箱验证 - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">验证您的电子邮件地址</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            已将新的验证链接发送到您的电子邮件地址
                        </div>
                    @endif

                        继续之前，请检查您的电子邮件中的验证链接。
                        如果你没有收到邮件，
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">单击此处请求另一个</button>。
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
