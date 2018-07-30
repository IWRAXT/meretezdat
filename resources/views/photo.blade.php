@extends ('layouts.master')

@section ('content')

    <div id="app">
        <upload></upload>
    </div>
    <script src="{{asset('js/app.js')}}"></script>



    {{--<div class="jumbotron">--}}
        {{--<img src="storage/images/ponty.jpg">--}}
        {{--<div class="d-flex p-2 bd-highlight">--}}
            {{--<form method="POST" action="/" enctype="multipart/form-data">--}}
                {{--{{csrf_field()}}--}}

                {{--<div class="form-group">--}}
                    {{--<label for="foto">Kép hozzáadás: </label>--}}
                    {{--<input type="file" class="form-control-file" id="file" name="foto">--}}
                    {{--<button type="submit" class="btn btn-primary">Update</button>--}}
                {{--</div>--}}

            {{--</form>--}}

        {{--</div>--}}
    {{--</div>--}}

@endsection


{{--<div class="progress">--}}
{{--<div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--</div>--}}

{{--<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">--}}
{{--Tooltip on top--}}
{{--</button>--}}