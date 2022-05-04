<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Đăng ký</title>

    <script src="https://cdn.tiny.cloud/1/sw2sl8pyffsot4t1ozvquiihiqtqqxy2u6tkojlxwqkbdgq0/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        var editor_config = {
            path_absolute: "http://localhost/ecommerce/public/",
            selector: 'textarea',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
</head>

<body>
    <h1 class='text-center'></h1>
    <div class='container'>
        <div class='row'>
            <div class="col-sm-12">
                <h1 class='text-center'>Đăng ký</h1>
                {!! Form::open(['url' => 'user/store', 'method' => 'POST','files'=> true]) !!}
                <div class='form-group'>
                    {!! Form::label('username', 'Username:') !!}
                    {!! Form::text('username', '', ['placeholder' => 'Nhập username', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['placeholder' => 'Nhập password', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('email', 'Email:') !!}
                    {!! Form::email('email', '', ['placeholder' => 'Nhập email', 'class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('city', 'Thành phố:') !!}
                    {!! Form::select('city', [0 => 'Chọn', 1 => 'Hà nội', 2 => 'TP.HCM'], 2, ['class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('gender', 'Giới Tính:') !!}
                    <div class='form-check'>
                        {!! Form::radio('gender', 'male', '', ['class' => 'form-check-input', 'id' => 'male']) !!}
                        {!! Form::label('male', 'Nam', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class='form-check'>
                        {!! Form::radio('gender', 'female', 'checked', ['class' => 'form-check-input', 'id' => 'female']) !!}
                        {!! Form::label('female', 'Nữ', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('sills', 'Kỹ năng:') !!}
                    <div class='form-check'>
                        {!! Form::checkbox('sills', 'html', 'checked', ['class' => 'form-check-label', 'id' => 'html']) !!}
                        {!! Form::label('html', 'HTML', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class='form-check'>
                        {!! Form::checkbox('sills', 'css', '', ['class' => 'form-check-label', 'id' => 'css']) !!}
                        {!! Form::label('css', 'CSS', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
                <div class='form-group'>
                    {!! Form::label('Brithday', 'Ngày sinh:') !!}
                    {!! Form::date('Brithday', '', ['class' => 'form-control']) !!}
                </div>
                <div class='form-group'>
                    {!! Form::label('content', 'Giới thiệu bản thân:') !!}
                    {!! Form::textarea('content', '', ['class' => 'form-control', 'id' => 'myTextarea']) !!}
                </div>
            </div>
            <div class='form-group'>
                {!! Form::submit('Đăng ký', ['name' => 'sm-reg', 'class' => 'btn btn-success']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    </div>
</body>

</html>
