<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} @lang('messages.profiles_favorited_activity')</b>
        <a href="{{ $activity->subject->favorited->path() }}" style="text-decoration: none;">
            <b>"{{ $activity->subject->favorited->owner->name }}@lang('messages.profiles_favorited_reply_activity')"</b>
        </a><br /><br />
        <p class="lead">{!! $activity->subject->favorited->body !!}</p><hr>
    @endslot
@endcomponent
</div>
