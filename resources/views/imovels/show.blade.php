@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    imovel Information
                </div>
                <div class="float-end">
                    <a href="{{ route('imovels.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Endereço:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $imovel->endereco }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Descrição:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $imovel->descricao }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Proprietário:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $imovel->proprietario }}
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Foto:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                        <td><img src="{{ asset('storage/' . $imovel->foto) }}" width="100px" alt="Imagem do Imóvel"></td>
                        </div>
                    </div>

                    <div class="row">
                        <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Data de cadastro:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $imovel->created_at }}
                        </div>
                    </div>
        
            </div>
        </div>
    </div>    
</div>
    
@endsection