@extends('layouts.merge.painel')
@section('titulo', 'cadastrar utilizador')
@section('conteudo')

<div class="card mb-2">
    <div class="card-body">
        <h2 class="h5 page-title">
            Cadastrar Utilizador
        </h2>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.user.cadastrar')}}" method="post" class="row">
            @include('forms._formUser.index')
            <div class="form-group text-center mx-auto col-md-3">
        <label class="text-white">lorem</label>
        <button type="submit" class="btn col-md-12 btn-danger">
            Salvar
        </button>

    </div>
        </form>
    </div>
</div>


@endsection
