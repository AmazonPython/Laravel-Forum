@extends('layouts.app')

@section('title')
    发帖 - {{ config('app.name') }}
@endsection

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="color: #e27575;">
                    <h3>发布新贴</h3>
                </div>
                @include('partials.errors')

                <div class="card-body">
                    <form method="post" action="{{ url('threads') }}">
                        @csrf
                        <div class="form-group">
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">点击选择一个频道···</option>
                                @foreach ($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="title" type="text" class="form-control" placeholder="标题" value="{{ old('title') }}" required>
                        </div>
                        <div class="form-group">
                            <textarea name="body" class="form-control" placeholder="内容" rows="10" required>{{ old('body') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            发送
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
@endsection
