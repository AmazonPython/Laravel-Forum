@extends('admin.layouts.app')

@section('administration-content')
<form method="POST" action="{{ route('admin.channel.store') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">频道名称：</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label for="description">描述：</label>
        <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">添加新频道</button>
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
