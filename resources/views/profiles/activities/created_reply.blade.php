<div class="card-body">
@component('profiles.activities.activity')
    @slot('heading')
        <b>{{ $profileUser->name }} </b>@lang('messages.threads_replied')
        <a href="{{ $activity->subject->thread->path() }}" style="text-decoration: none;">
            <b> "{{ $activity->subject->thread->title }}"</b>
        </a><br /><br />

        <reply :attributes="{{ $activity->subject}}" inline-template v-cloak>
            <div id="reply-{{ $activity->subject->id }}" class="panel panel-default">
                <div v-if="editing">
                    <div class="form-group">
                        <textarea id="{{ $activity->subject->id }}" class="form-control" v-model="body"></textarea>
                    </div>
                    <button class="btn btn-info" @click="update">@lang('messages.threads_update')</button>
                    <button class="btn btn-info" @click="editing = false">@lang('messages.threads_update_cancel')</button>
                </div>
                <p class="lead" v-else v-text="body"></p><br />

                @can('update', $activity->subject)
                    <a>
                        <button class="btn btn-info float-left" @click="editing = true">@lang('messages.threads_edit')</button>
                        <form action="{{ url('replies', $activity->subject->id) }}" method="post" class="float-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                @lang('messages.threads_delete')
                            </button>
                        </form>
                    </a><br /><br />
                @endcan
            </div>
        </reply><hr>
    @endslot
@endcomponent
</div>
