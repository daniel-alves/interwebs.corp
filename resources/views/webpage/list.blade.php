@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <a href="{{ route('webpages.create') }}" class="mb-2">Cadastrar</a>
        <br><br>
        <div class="row">
            <div class="col-12">

                <table class="table table-bordered" id="laravel_crud">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Endereço da página</th>
                        <th>Status Code</th>
                        <th>Data da visita</th>
                        <td colspan="2">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    @if($webpages->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center">Não há páginas cadastradas!</td>
                        </tr>
                    @endif
                    @foreach($webpages as $webpage)
                        <tr>
                            <td>{{ $webpage->id }}</td>
                            <td>{{ $webpage->address }}</td>
                            <td>{{ $webpage->status_code }}</td>
                            <td>{{ is_null($webpage->visited_at) ? "" : date('d/m/Y', strtotime($webpage->visited_at)) }}</td>
                            <td>
                                @if(is_null($webpage->visited_at))
                                    <a href="{{ route('webpages.edit', $webpage->id)}}"
                                       class="btn btn-primary">Editar</a>
                                @endif
                            </td>
                            <td>
                                @if(is_null($webpage->visited_at))
                                    <form action="{{ route('webpages.destroy', $webpage->id)}}" method="post">
                                        {{ csrf_field() }}
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Excluir</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $webpages->links() !!}
            </div>
        </div>
    </div>
@endsection
