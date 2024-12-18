@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New imovel
                </div>
                <div class="float-end">
                    <a href="{{ route('imovels.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('imovels.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">endereco</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('endereco') is-invalid @enderror" id="endereco" name="endereco" value="{{ old('endereco') }}">
                            @if ($errors->has('endereco'))
                                <span class="text-danger">{{ $errors->first('endereco') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="descricao" class="col-md-4 col-form-label text-md-end text-start">descricao</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao">{{ old('descricao') }}</textarea>
                            @if ($errors->has('descricao'))
                                <span class="text-danger">{{ $errors->first('descricao') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="proprietario" class="col-md-4 col-form-label text-md-end text-start">proprietario</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('proprietario') is-invalid @enderror" id="proprietario" name="proprietario">{{ old('proprietario') }}</textarea>
                            @if ($errors->has('proprietario'))
                                <span class="text-danger">{{ $errors->first('proprietario') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="foto" class="col-md-4 col-form-label text-md-end text-start">foto</label>
                        <div class="col-md-6">
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">{{ old('foto') }}</input>
                            @if ($errors->has('foto'))
                                <span class="text-danger">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add imovel">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection