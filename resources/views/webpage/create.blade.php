@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.index') }}" class="mb-2">Voltar para listagem</a>
        <br/><br/>
        <form action="{{ route('webpages.store') }}" method="POST" name="add_webpage">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Endereço da página web</strong>
                        <input type="text" name="address" class="form-control"
                               placeholder="Informe o endereço da página web">
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>

        </form>
    </div>
@endsection
