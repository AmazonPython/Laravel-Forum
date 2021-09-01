@extends('layouts.app')

@section('title')
    {{ trans('messages.auth_verify') }} - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('messages.auth_verify_email_address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ trans('messages.auth_verify_email_address_alert_success') }}
                        </div>
                    @endif

                    {{ trans('messages.auth_verify_email_address_alert_wait') }}
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ trans('messages.auth_verify_resend') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
