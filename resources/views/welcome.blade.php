@extends('layouts.app')

@section('title')
    @lang('messages.welcome_title'){{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <p align="center">
            <img src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/logo-laravel.svg" alt="Laravel logo">
        </p>

        <p align="center">
            <a href="https://jsdelivr.com">
                <img src="https://data.jsdelivr.com/v1/package/gh/AmazonPython/Laravel-Forum/badge" alt="hits/month">
            </a>
            <a href="https://jsdelivr.com">
                <img src="https://data.jsdelivr.com/v1/package/gh/AmazonPython/Laravel-Forum/badge/rank" alt="rank">
            </a>
            <a href="https://github.com/996icu/996.ICU/blob/master/LICENSE">
                <img src="{{ asset('images/License-Anti 996-green.svg') }}" alt="License">
            </a>
        </p>
    </div>

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h1 class="featurette-heading"><span class="text-muted">@lang('messages.welcome_featurette_heading')</span></h1>
            <p class="lead">
                @lang('messages.welcome_featurette-text')
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img src="https://img.maocdn.cn/img/2021/09/09/tentocats.jpg" class="featurette-image img-fluid mx-auto" alt="githun-octodex-banner-image">
        </div>
    </div>
</div>
@endsection
