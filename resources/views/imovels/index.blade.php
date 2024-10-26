@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Imóvel List</div>
    <div class="card-body">
        @can('create-imovel')
            <a href="{{ route('imovels.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Imóvel</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                <th scope="col">S#</th>
                <th scope="col">Name</th>
                <th scope="col">Descrição</th>
                <th scope="col">Proprietário</th>
                <th scope="col">Foto</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($imovels as $imovel)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $imovel->endereco }}</td>
                    <td>{{ $imovel->descricao }}</td>
                    <td>{{ $imovel->proprietario }}</td>
                    <td>{{ $imovel->foto }}</td>


                    <td>
                        <form action="{{ route('imovels.destroy', $imovel->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <a href="{{ route('imovels.show', $imovel->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                            @can('edit-imovel')
                                <a href="{{ route('imovels.edit', $imovel->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan

                            @can('delete-imovel')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this imovel?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                    <td colspan="4">
                        <span class="text-danger">
                            <strong>No imovel Found!</strong>
                        </span>
                    </td>
                @endforelse
            </tbody>
        </table>

        {{ $imovels->links() }}

    </div>
</div>
@endsection