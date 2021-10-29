<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} </b>@lang('messages.threads_index_published')
        <a href="{{ $activity->subject->path() }}" style="text-decoration: none;">
            <b> "{{ $activity->subject->title }}"</b>
        </a><br /><br />

        <p class="lead">{!! $activity->subject->body !!}</p>
        {{--}}@can('update', $activity->subject)
            <a href="{{ $activity->subject->path('edit')   }}" class="btn btn-info float-left">@lang('messages.threads_edit')</a>
            <form action="{{ $activity->subject->path() }}" method="post" class="float-right">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    @lang('messages.threads_delete')
                </button>
            </form>
        @endcan<br /><br /><hr>--}}
    @endslot
@endcomponent
</div>
