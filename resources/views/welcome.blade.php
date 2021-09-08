@extends('layouts.app')

@section('title')
    @lang('messages.welcome_title'){{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

        <p align="center">
            <a href="https://travis-ci.org/laravel/framework">
                <img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status">
            </a>
            <a href="https://packagist.org/packages/laravel/framework">
                <img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads">
            </a>
            <a href="https://packagist.org/packages/laravel/framework">
                <img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version">
            </a>
            <a href="https://packagist.org/packages/laravel/framework">
                <img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License">
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
            <img src="https://octodex.github.com/images/tentocats.jpg" class="featurette-image img-fluid mx-auto" alt="githun-octodex-banner-image">
        </div>
    </div>
</div>
@endsection
