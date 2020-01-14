<table class="table table-striped table-hover table-sm" id="laravel_crud">
    <thead>
    <tr>
        <th>Id</th>
        <th>Endereço da página</th>
        <th>Status Code</th>
        <th>Data da visita</th>
        <td colspan="3">Action</td>
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
                    <a href="{{ route('webpages.edit', $webpage->id)}}" class="btn btn-primary btn-sm">Editar</a>
                @else
                    <a href="javascript:;" class="btn btn-primary btn-sm disabled">Editar</a>
                @endif
            </td>
            <td>
                @if(is_null($webpage->visited_at))
                    <form action="{{ route('webpages.destroy', $webpage->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                    </form>
                @else
                    <a href="javascript:;"  class="btn btn-danger btn-sm disabled" type="submit">Excluir</a>
                @endif
            </td>
            <td>
                @if(!is_null($webpage->visited_at))
                    <a href="{{ route('webpages.show', $webpage->id)}}" class="btn btn-success btn-sm show-content" data-toggle="modal" data-target="#webpage-content-modal">Conteúdo</a>
                @else
                    <a href="javascript:;" class="btn btn-success btn-sm disabled">Conteúdo</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $webpages->links() !!}