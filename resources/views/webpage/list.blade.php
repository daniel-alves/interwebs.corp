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
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="webpage-content-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Conteúdo da página web</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="webpage-content-container">
                    Blá blá blá
                </div>
            </div>
        </div>
    </div>
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

            $('#webpage-list-container').on("click", ".show-content", function(){
                $("#webpage-content-container").html("Carregando...");
                $.get($(this).prop('href'), function (response) {
                    $('#webpage-content-container').html(response);
                });
            });
        });

    </script>
@endsection
