@if ($errors->any())
    <div class="alert alert-danger">
        <strong>@lang('messages.threads_create_errors')</strong><br /><br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
