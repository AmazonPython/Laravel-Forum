@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @forelse ($threads as $thread)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="level">
                                <div class="flex">
                                    <h4>
                                        <a href="{{ url('threads', $thread->id) }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h4>
                                </div>

                                <a href="{{ url('threads', $thread->id) }}">
                                    {{ $thread->replies_count }} {{ $thread->replies_count }}
                                </a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="body">{!! $thread->body !!}</div>
                        </div>

                        <div class="panel-footer">
                            {{ $thread->visits }} Visits
                        </div>
                    </div>
                @empty
                    <p>There are no relevant results at this time.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
