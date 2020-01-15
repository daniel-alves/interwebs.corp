@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.create') }}" class="mb-2">Cadastrar</a>
        <a href="{{ route('webpages.reload') }}" class="mb-2 float-right" id="reload-webpage-list">Atualizar</a>
        <br><br>
        <div class="row">
            <div class="col-12" id="webpage-list-container">

                @include('webpage.table', ['webpages' => $webpages])

            </div>
        </div>
    </div
@endsection

@section('js_footer')
    <script>

        $(function () {
            $('#reload-webpage-list').click(function (e) {

                $.get($(this).prop('href'), function (response) {
                    $('#webpage-list-container').html(response);
                });

                e.preventDefault();
                return false;
            });
        });

    </script>
@endsection
