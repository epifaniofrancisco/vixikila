@extends('layouts.merge.painel')
@section('titulo', 'Edição de Função')
@section('conteudo')


    <div class="card mb-2">
        <div class="card-body">
            <h2 class="h5 page-title">
               Editar Função
            </h2>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="{{ route('admin.funcao.update', $funcao->id)}} " method="post" class="row"  >
                @csrf
                @include('forms._formFuncao.index')
            </form>

        </div>
    </div>




    @endsection
    

    @if (session('funcao.editar.true'))
    <script>
        Swal.fire(
            'Função Editada Com Sucesso!',
            '',
            'success'
        )

    </script>
    @endif

    @if (session('funcao.editar.false'))
    <script>
        Swal.fire(
            'Erro ao Editar a Funcão!',
            '',
            'error'
        )

    </script>
    @endif
