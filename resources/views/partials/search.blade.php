@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    @if($counts == true)
                        <a>@lang('messages.search_result_not_null') {{ $counts }} @lang('messages.search_result')</a>
                    @else
                        <a>@lang('messages.search_result_null')</a>
                    @endif
                </div>

                <div class="card-body">
                    @foreach ($users as $user)
                        <div class="user-preview">
                            <a href="{{ route('profile', $user) }}" style="text-decoration: none;">
                                <img src="{{ $user->avatar ?: $user->defaultAvatar() }}" alt="{{ $user->name }} Avatar" style="border-radius: 500px; width: 30px; height: 30px;">
                                <b>{{ $user->name }}</b>
                            </a>
                            <p>
                                @lang('messages.profiles_joined') <b>{{ $user->created_at->diffForHumans() }}</b>
                            </p>
                        </div>
                        <hr>
                    @endforeach
                    <div class="clearfix">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
