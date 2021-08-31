@extends('layouts.app')

@section('title')
    {{ Auth::user()->name }}{{ trans('messages.home_title') }} - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ Auth::user()->name }}{{ trans('messages.home_title') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ trans('messages.home_welcome_back') }}{{ Auth::user()->name }}！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
