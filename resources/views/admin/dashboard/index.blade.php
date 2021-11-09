@extends('admin.layouts.app')

@section('title')
    @lang('messages.admin_dashboard') - {{ config('app.name') }}
@endsection

@section('administration-content')
    <h2 class="text-center btn-dark">@lang('messages.admin_dashboard')</h2>
@endsection
