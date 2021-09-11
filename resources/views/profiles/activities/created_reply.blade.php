<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} </b>@lang('messages.threads_replied')
        <a href="{{ $activity->subject->thread->path() }}" style="text-decoration: none;">
            <b> "{{ $activity->subject->thread->title }}"</b>
            @can('update', $activity->subject)
                <button type="submit" class="btn btn-info float-right ml-4">
                    修改
                </button>
                <form action="{{ url('replies', $activity->subject->id) }}" method="post" class="float-right">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        @lang('messages.threads_delete')
                    </button>
                </form>
            @endcan
        </a><br /><br />
    @endslot

    @slot('body')
        <p class="lead">{!! $activity->subject->body !!}</p><hr>
    @endslot
@endcomponent
</div>
