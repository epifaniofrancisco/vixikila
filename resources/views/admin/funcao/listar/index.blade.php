@extends('layouts.merge.painel')
@section('titulo', 'Lista de Funções')

@section('conteudo')
    <div class="card mb-2">
        <div class="card-body">
            <h2 class="h5 page-title">
                Lista de Funções
            </h2>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-danger" href="{{ route('admin.funcao.cadastrar') }}">
            <strong class="text-light">Cadastrar Função</strong>
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- sweetalert -->

            <table class="table datatables table-hover table-bordered" id="caps">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ACÇÕES</th>
                    </tr>
                </thead>
                <tbody class="bg-white">

                    @foreach ($funcoes as $funcao)
                        <tr class="text-center">
                            <th>{{ $funcao->id}}</th>
                            <th>{{ $funcao->vc_nomeFuncao }} </th>
                            @csrf
                            @method('delete')
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-clone fa-sm" aria-hidden="true"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="{{ route('admin.funcao.editar', $funcao->id) }}"
                                            class="dropdown-item">Editar</a>
                                      <a href="{{ route('admin.funcao.eliminar', $funcao->id) }}"
                                            class="dropdown-item"
                                            data-confirm="Tem certeza que deseja eliminar?">Eliminar</a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <script src="/js/datatables/jquery-3.5.1.js"></script>

            <script>
                $(document).ready(function() {

                    //start delete
                    $('a[data-confirm]').click(function(ev) {
                        var href = $(this).attr('href');
                        if (!$('#confirm-delete').length) {
                            $('table').append(
                                '<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"> <div class="modal-header"> <h5 class="modal-title" id="exampleModalLabel">Eliminar os dados</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que pretende elimnar?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <a  class="btn btn-info" id="dataConfirmOk">Eliminar</a> </div></div></div></div>'
                            );
                        }
                        $('#dataConfirmOk').attr('href', href);
                        $('#confirm-delete').modal({
                            shown: true
                        });
                        return false;

                    });
                    //end delete
                });

            </script>
            <!-- Footer-->
        </div>
    </div>

    @if (session('eliminar'))
     <script>
         Swal.fire(
             'Classe Eliminada com sucesso!',
             '',
             'success'
         )

     </script>
 @endif
 

 @if (session('funcao.eliminar.true'))
 <script>
     Swal.fire(
         'Função Eliminada Com Sucesso!',
         '',
         'success'
     )

 </script>
 @endif

 @if (session('funcao.eliminar.false'))
 <script>
     Swal.fire(
         'Erro ao Eliminar a Função!',
         '',
         'error'
     )

 </script>
 @endif
 @if (session('funcao.purgar.true'))
 <script>
     Swal.fire(
         'funcao Purgada Com Sucesso!',
         '',
         'success'
     )

 </script>
 @endif

 @if (session('funcao.purgar.false'))
 <script>
     Swal.fire(
         'Erro ao Purgar a funcao!',
         '',
         'error'
     )

 </script>
 @endif

@endsection
