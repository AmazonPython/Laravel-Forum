@extends('layouts.app')

@section('title')
    欢迎来到{{ config('app.name') }}
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
            <h1 class="featurette-heading"><span class="text-muted">本论坛基于 Laravel 构建。</span></h1>
            <p class="lead">
                我们致力于交流计算机科学技术，并试图让全世界听见我们的声音。想试试世界上最好的语言 PHP？
                欢迎贡献代码，喜欢的话可以为该项目点亮一颗小星星。最后补充一句，Take care of yourself. Happy Coding!
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img src="{{ asset('images/profile-first-issue.svg') }}" class="featurette-image img-fluid mx-auto" alt="banner-img">
        </div>
    </div>
</div>
@endsection
