@if ($errors->any())
    <div class="alert alert-danger">
        <strong>哎呀！</strong>
        你的输入好像有问题。<br /><br />
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
