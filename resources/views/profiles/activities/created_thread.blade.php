<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} </b>@lang('messages.threads_index_published')
        <a href="{{ $activity->subject->path() }}" style="text-decoration: none;">
            <b> "{{ $activity->subject->title }}"</b>
        </a>
        @can('update', $activity->subject)
            <form action="{{ $activity->subject->path() }}" method="post" class="float-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    @lang('messages.threads_delete')
                </button>
            </form>
        @endcan<br /><br />
        <p class="lead">{!! $activity->subject->body !!}</p><hr>
    @endslot
@endcomponent
</div>
