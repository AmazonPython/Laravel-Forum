@extends('layouts.app')

@section('title')
    {{ $profileUser->name }} - @lang('messages.profiles_title') - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a>{{ $profileUser->name }}@lang('messages.home_title')</a>
                    <a class="ml-4" style="text-decoration: none;color: #212529">
                        @lang('messages.profiles_joined') <b>{{ $profileUser->created_at->diffForHumans() }}</b>
                    </a>
                </div>

                <div class="card-body">
                    <h2>@lang('messages.home_welcome_back'){{ $profileUser->name }}</h2><br /><hr>
                    @forelse ($activities as $date => $activity)<br />
                        <h3 class="page-header">{{ $date }}</h3>
                        @foreach ($activity as $record)
                            @if (view()->exists("profiles.activities.{$record->type}"))
                                @include ("profiles.activities.{$record->type}", ['activity' => $record])
                            @endif
                        @endforeach
                    @empty
                        <p>@lang('messages.profiles_no_activity')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
