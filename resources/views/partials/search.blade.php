@extends('layouts.app')

@section('title')
    @lang('messages.search_result') - {{ config('app.name') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a>@lang('messages.search_result')</a>
                </div>

                <div class="card-body">
                    @foreach ($users as $user)
                        <div class="user-preview">
                            <a href="{{ route('profile', $user) }}" style="text-decoration: none;">
                                <h3 class="user-title">{{ $user->name }}</h3>
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
