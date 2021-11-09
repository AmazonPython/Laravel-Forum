@extends('admin.layouts.app')

@section('title')
    @lang('messages.admin_add_channel') - {{ config('app.name') }}
@endsection

@section('administration-content')
<form method="POST" action="{{ route('admin.channel.store') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">@lang('messages.admin_channel_name')</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label for="description">@lang('messages.admin_channel_description')</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">@lang('messages.admin_add_channel')</button>
    </div>

    @if (count($errors))
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</form>
@endsection
