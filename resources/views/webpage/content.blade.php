@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.index') }}" class="mb-2">Voltar para listagem</a>
        <br/><br/>
{{--        <iframe src="{{$address}}" width="100%"></iframe>--}}

        <object data="{{$address}}" width="100%" height="980px" type="text/html">
            Ohh My Gosh, run to the hills!!!
        </object>

    </div>
@endsection
