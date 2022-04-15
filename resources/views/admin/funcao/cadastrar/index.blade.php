@extends('layouts.merge.painel')
@section('titulo', 'Cadastro de Funcão ')
@section('conteudo')

<div class="card mb-2">
    <div class="card-body">
        <h2 class="h5 page-title">
            Cadastrar Função
        </h2>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.funcao.store')}}" method="post" class="row">
            @csrf
            @include('forms._formFuncao.index')
        </form>
    </div>
</div>



@if (session('funcao.cadastrar.true'))
<script>
    Swal.fire(
        'Funcão Cadastrada Com Sucesso!',
        '',
        'success'
    )

</script>
@endif

@if (session('funcao.cadastrar.false'))
<script>
    Swal.fire(
        'Erro ao cadastrar a Funcão!',
        '',
        'error'
    )

</script>
@endif

@endsection
