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
                    <a><b>{{ $profileUser->name }}</b>@lang('messages.home_title')</a>
                    <a class="ml-4" style="text-decoration: none;color: #212529">
                        @lang('messages.profiles_joined') <b>{{ $profileUser->created_at->diffForHumans() }}</b>
                    </a><br />
                    <img src="{{ $profileUser->avatar ?: 'https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/images/avatar.jpeg' }}" alt="{{ $profileUser->name }} Avatar" style="border-radius: 500px; width: 200px;height: 200px">
                    @can('update', $profileUser)
                        <form method="post" action="{{ route('avatar', $profileUser) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="col-md-6">
                                    <input type="file" value="头像" name="avatar" style="width: 180px">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        @lang('messages.profiles_edit_avatar') <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endcan
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
