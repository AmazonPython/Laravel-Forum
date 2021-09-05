@extends('layouts.app')

@section('title')
    @lang('messages.profiles_title') - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h1>{{ $profileUser->name }}</h1>
                <small>@lang('messages.profiles_joined') {{ $profileUser->created_at->diffForHumans() }}</small>
            </div><br /><hr>

            @forelse ($activities as $date => $activity)
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
@endsection
