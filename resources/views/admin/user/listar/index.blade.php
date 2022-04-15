@extends('layouts.merge.painel')
@section('titulo', 'Lista de utilizadores')

@section('conteudo')
    <div class="card mb-2">
        <div class="card-body">
            <h2 class="h5 page-title">
                Lista de Utilizadores
            </h2>
        </div>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-danger" href="{{ route('admin.user.criar') }}">
            <strong class="text-light">Cadastrar utilizador</strong>
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- sweetalert -->

            <table class="table datatables table-hover table-bordered" id="dataTable-1">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>PERFIL</th>
                        <th>BI</th>
                        <th>TELEFONE</th>
                        <th>ACÇÕES</th>
                       
                    </tr>
                </thead>
                <tbody class="bg-white">

                    @foreach ($users as $user)
                        <tr class="text-center">
                            <th>{{ $user->id}}</th>
                            <th>{{ $user->name }} </th>
                            <th>{{ $user->email }} </th>
                            
                                
                              

                                @if(Auth::user()->vc_perfil == 'Administrador' && $user->id != Auth::user()->id && $user->vc_perfil=='Administrador')
                                <th class="utilizador">
                                    {{$user->vc_perfil}}
                                        
                                </th>
                                @else
                                <th class="utilizador">
                                    <select id="{{ $user->id }}" name="utilizador" class="form-control border-0" required>
                                        <option value="">{{ $user->vc_perfil }}</option>
                                    </select>
                                        
                                </th>
                                @endif


                                
                       
                            <th>{{ $user->vc_bi }} </th>
                            <th>{{ $user->it_telefone }} </th>
                           




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
                                       

                                        @if (Auth::user()->vc_perfil == 'Administrador')
                                            @if (($user->vc_perfil != 'Administrador' ) && (Auth::user()->id != $user->id) || ($user->vc_perfil == 'Administrador' ) && (Auth::user()->id == $user->id))
                                            <a href="{{ route('admin.user.criarEdicao', $user->id) }}"
                                                class="dropdown-item">Editar</a>
                                            @endif
                                        @elseif(Auth::user()->vc_perfil == 'Master')
                                        <a href="{{ route('admin.user.criarEdicao', $user->id) }}"
                                            class="dropdown-item">Editar</a>
                                        @endif
                                      
                                      <a href="{{ route('admin.user.eliminar', $user->id) }}"
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


     <script>
           $('.utilizador').click(function(e) {
          console.log($( "th.utilizador > select" ))
                var id = e.target.id;
                if ($('#' + id + ' option').length == '1') {
                    $('#' + id)
                        .append('<option value="Administrador">Administrador</option>')
                        .append('<option value="Fiscal">Fiscal</option>')
                        .append('<option value="Cliente">Cliente</option>')
                        .append('<option value="Master">Master</option>')
                        .append('<option value="Gráfica A">Gráfica A</option>')
                        .append('<option value="Gráfica B">Gráfica B</option>')
                        .append(
                            '<option value="Publicitário">Publicitário</option>')
                      
                }

                $('#' + id).change(function() {
                    console.log('ola');
                    var nivel = $('#' + id).val();
                    
                  

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '/editar_nivel/' + id + '/' + nivel,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                        
                        async: false,
                        success: function(response) {

                            // response.forEach(element => {
                            //     console.log
                            // });
                            console.log(response)

                            

                            Swal.fire(
                                   'Dados Actualizados com sucesso',
                                    '',
                                   'success'
                                  )
                            // console.log(response.length)
                            
                               }
                             

                        // complete: function (data) {
                        //           printWithAjax(); 
                        //            }
                    })
                });

            });
        
     </script>
@endsection
