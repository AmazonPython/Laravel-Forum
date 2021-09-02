@extends('layouts.app')

@section('title')
    {{ trans('messages.profiles_title') }} - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{ $profileUser->name }}
        </div>
    </div>
</div>
@endsection
