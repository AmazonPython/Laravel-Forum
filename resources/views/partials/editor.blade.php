<script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmazonPython/Laravel-Forum@master/public/tinymce4x_languages/langs/zh_CN.js"></script>
<script>
    tinymce.init({
        selector: 'textarea#editor',
        language: '@lang('messages.threads_create_editor')',
        height: 400,
        placeholder: '@lang('messages.threads_reply_placeholder')',
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste imagetools wordcount emoticons',
            'help'
        ],
        toolbar: 'fullscreen | insertfile undo redo | styleselect | bold italic | emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image |',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
        mobile: {
            menubar: true
        }
    });
</script>
