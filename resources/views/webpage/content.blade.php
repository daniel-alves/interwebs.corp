@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.index') }}" class="mb-2">Voltar para listagem</a>
        <br/><br/>
        <iframe srcdoc="{{$address}}" width="100%" height="700px" sandbox type="text/html" style="border: 1px solid black;">
            Oops, algo inesperado aconteceu, não foi possível salvar o conteúdo da página solicitada!!
        </iframe>
    </div>
@endsection
