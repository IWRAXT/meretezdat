
@extends ('layouts.master')

@section ('content')
    <form action="/file-upload"
          class="dropzone"
          id="my-awesome-dropzone"></form>


    <div id="app">
        <upload></upload>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
@endsection
