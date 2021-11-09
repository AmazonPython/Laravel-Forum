@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li class="nav-link" role="presentation">
                    <a href="{{ route('admin.dashboard.index') }}">@lang('messages.admin_dashboard')</a>
                </li>
                <li class="nav-link" role="presentation">
                    <a href="{{ route('admin.channel.index') }}">@lang('messages.nav_channels')</a>
                </li>
            </ul>
        </div>

        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-body">
                    @yield('administration-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
