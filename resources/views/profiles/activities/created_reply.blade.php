<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} </b>@lang('messages.threads_replied')
        <a href="{{ $activity->subject->thread->path() }}" style="text-decoration: none;">
            <b> "{{ $activity->subject->thread->title }}"</b>
        </a><br /><br />
        <p class="lead">{!! $activity->subject->body !!}</p><hr>
    @endslot
@endcomponent
</div>
