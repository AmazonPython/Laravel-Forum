<div v-if="editing">
    <div class="form-group">
        <textarea id="{{ $reply->id }}" class="form-control" v-model="body"></textarea>
    </div>
    <button class="btn btn-info" @click="update">@lang('messages.threads_update')</button>
    <button class="btn btn-info" @click="editing = false">@lang('messages.threads_update_cancel')</button>
</div>

<p class="lead" v-else v-text="body"></p>
