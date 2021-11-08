@extends('admin.layouts.app')

@section('administration-content')
<p>
    <a class="btn btn-sm btn-default" href="{{ route('admin.channel.create') }}">
        新频道 <span class="glyphicon glyphicon-plus"></span>
    </a>
</p>

    <table class="table">
        <thead>
        <tr>
            <th>名称</th>
            <th>SEO标题</th>
            <th>描述</th>
            <th>帖子</th>
        </tr>
        </thead>
        <tbody>
        @forelse($channels as $channel)
            <tr>
                <td>{{ $channel->name }}</td>
                <td>{{ $channel->slug }}</td>
                <td>{{ $channel->description }}</td>
                <td>{{ count($channel->threads()) }}</td>
            </tr>
        @empty
            <tr>
                <td>空空如也</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
