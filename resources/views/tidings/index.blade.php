@extends('layouts.app')
</div>
@section('content')
        <table class="table table-striped">
            <thread>
                <tr>
                    <th> Manchete </th>
                    <th> Título da Notícia </th>
                    <th> Texto </th>
                    <th> Editar </th>
                    <th> Ver Publicação </th>
                    <th> Deletar </th>
                    <th>
                        <form action="{{route('tidings.search')}}" method="GET">
                        @csrf
                            <input type="text" name="search" placeholder="Digite:">
                            <button type="submit"> PESQUISAR </button>
                        </form>
                    </th>
                    <th> <a class="btn-primary" href="{{route('tidings.create')}}"> Adicionar Notícia </a></th>
                </tr>
            </thread>
            <tbody>
                @forelse($data as $item)
                <tr>
                    <td> {{$item->manchete}} </td>
                    <td> {{$item->title_tiding}} </td>
                    <td> {{$item->description_tiding}} </td>
                    <td> <a href="{{route('tidings.edit', $item->id)}}"> Editar </a> </td>
                    <td> <a href="{{route('tidings.show', $item->id)}}"> Visualizar </a> </td>
                    <td>
                        <form action="{{route('tidings.destroy', $item->id)}}" method="POST">
                            @method('delete')
                            @csrf
                            <button> Deletar </button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="40"> Informações não encontradas! </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
@endsection        