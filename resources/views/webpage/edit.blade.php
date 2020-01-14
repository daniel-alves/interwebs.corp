@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.index') }}" class="mb-2">Voltar para listagem</a>
        <br/><br/>

        @if(is_null($webpage->visited_at))
            <form action="{{ route('webpages.update', $webpage->id) }}" method="POST" name="update_webpage">
                {{ csrf_field() }}
                @method('PATCH')

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Endereço da página web</strong>
                            <input type="text" name="address" class="form-control"
                                   placeholder="Informe o endereço da página web" value="{{ $webpage->address }}">
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>

            </form>
        @else
            <div class="alert alert-danger">
                <strong>Não é permitido!</strong> Não é possível editar endereços de páginas que ja foram visitadas.
            </div>
        @endif
    </div>
@endsection
