@extends('admin.layouts.app')

@section('title')
    @lang('messages.admin_dashboard') / @lang('messages.nav_channels') - {{ config('app.name') }}
@endsection

@section('administration-content')
<p>
    <a class="btn btn-sm btn-dark" href="{{ route('admin.channel.create') }}">
        @lang('messages.admin_new_channel') <span class="glyphicon glyphicon-plus"></span>
    </a>
</p>

<table class="table">
    <thead>
        <tr>
            <th>@lang('messages.admin_channel_name')</th>
            <th>@lang('messages.admin_channel_slug')</th>
            <th>@lang('messages.admin_channel_description')</th>
            <th>@lang('messages.admin_channel_threads')</th>
        </tr>
    </thead>
    <tbody>
        @forelse($channels as $channel)
            <tr>
                <td>{{ $channel->name }}</td>
                <td>{{ $channel->slug }}</td>
                <td>{{ $channel->description }}</td>
                <td>{{ count($channel->threads) }}</td>
            </tr>
        @empty
            <tr>
                <td>(ーー゛)</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
