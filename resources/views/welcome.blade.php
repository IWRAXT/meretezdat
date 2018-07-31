<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">
        {{--<form method="POST" action="/" enctype="multipart/form-data">--}}
            {{--{{csrf_field()}}--}}

            {{--<div class="form-group">--}}
                {{--<label for="foto">Kép hozzáadás: </label>--}}
                {{--<input type="file" class="form-control-file" id="file" name="foto">--}}
                {{--<button type="submit" class="btn btn-primary">Update</button>--}}
            {{--</div>--}}

        {{--</form>--}}

        <form method="POST"
              action="/"
              class="dropzone"
              id="my-awesome-dropzone" enctype="multipart/form-data">
            {{csrf_field()}}

        </form>
        @foreach (Illuminate\Support\Facades\File::allFiles(public_path().'/storage/images/') as $file)

            {{$filename = $file->getRelativePathName()}}

            <img src="storage/images/{{$filename}}" style="height: 100px"><br>
        @endforeach


        {{--<img src="storage/images/pontyresize.jpg">--}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

        <script type="text/javascript">
            Dropzone.options.imageUpload = {
                maxFile         :       1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                url: "http://fotos.test/"
            };
        </script>

    </div>
</div>
</body>
</html>
