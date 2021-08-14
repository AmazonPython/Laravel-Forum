@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-title">
                            <h3>{{ $thread->title }}</h3>
                        </div>
                        <div class="panel-body">
                            <p>{{ $thread->body }}</p><br />
                            <p>
                                This thread was published {{ $thread->created_at->diffForHumans() }}
                                , and currently has {{ $thread->replies_count}} comments.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                @foreach ($thread->replies as $reply)
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ $reply->body }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
