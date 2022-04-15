
@extends('layouts.includes_site.Header')
@section('titulo', 'Editar perfil')
@section('conteudo')





    <div class="basic-3 ">
        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card" >
                 
                    <div class="py-4  d-flex justify-content-center mb-5">
                        <div class="brand_logo_container">
                            <img src="{{ asset('/site/images/logo/ZENGÁ ICONE VERMELHO.svg') }}" class="brand_logo" alt="Logo">
                        </div>
                       
                    </div>
                    <div class="py-4  d-flex justify-content-center pt-4">
                        {{-- <h2 class="card-text  text-center">Iniciar sessão</h2> --}}
                        <img src="{{ asset('/site/images/logo/letra.png') }}" width=200 class="" alt="Logo">
                    </div>
                    <div class="py-4">
                        <h2 class="card-text  text-center">Editar perfil</h2>
                    </div>
                    {{-- <div class="d-flex justify-content-center ">
                        <img src="{{ asset('/site/images/logo/ZENGÁ LOGO HORIZONTAL 01.png') }}" class="w-75 h-75" alt="Logo" >
                       </div> --}}
                    <div class="card-body py-4 ">
                        <form action="{{ route('cliente.perfil.update') }}" method="POST">
                            @csrf

                           
                        
                            <input type="hidden" name="id" value="{{$user->id}}">
                           
                            <div class="row">
                                <div class="form-group col-sm-3 col-md-6 ">
                                    <label for="">Nome:</label>
                                    <input type="text" placeholder="Nome do cliente" class="form-control input"
                                        name="vc_nome" id="" required  value="{{$user->name}}">
                                </div>
                                <div class="form-group  col-sm-3 col-md-6 ">
                                    <label for="">E-mail:</label>
                                    <input type="text" placeholder="E-mail do cliente" class="form-control input"
                                        name="vc_email" id="" required value="{{$user->email}}">
                                </div>
                                <div class="form-group  col-sm-3 col-md-6">
                                    <label for="">Telefone:</label>
                                    <input type="number" placeholder="Telefone do cliente" class="form-control input"
                                        name="it_telefone" id="" maxlength="9" required value="{{$user->it_telefone}}">
                                </div>
                                <div class="form-group col-sm-3 col-md-6 ">
                                    <label for="">Senha</label>
                                    <input type="password" placeholder="Digita a senha" class="form-control input"
                                        name="vc_senha" id="" required>
                                </div>
                                <div class="form-group  col-sm-3 col-md-6 ">
                                    <label for="">Digita a senha:</label>
                                    <input type="password" placeholder="Digita novamente a senha" class="form-control input"
                                        name="confirmed" id="" required>
                                </div>

                                <div class="form-group  col-sm-3 col-md-6">
                                    <label for="">BI:</label>
                                    <input type="text" maxlength="14" placeholder="Número do bilhete"
                                        class="form-control input" name="vc_bi" id="" required value="{{$user->vc_bi}}">
                                </div>

                                <div class="form-group  col-sm-3 col-md-6">
                                    <label for="">Gênero:</label>
                                    <select name="vc_genero" id="" class="form-control input" required>
                                        
                                        @isset($user->vc_genero)
                                            <option  selected value="{{$user->vc_genero}}">{{$user->vc_genero}}</option>
                                        @else
                                            <option disabled selected>Seleciona o gênero</option>
                                        @endisset
                                        <option value="Masculino">Masculino</option>
                                        <option value="Feminino">Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="button" class="btn login_btn">Salvar</button>
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div> <!-- end of container -->
    </div>

    <script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>
                
    @if (session('perfil.editar.true'))
        <script>
            Swal.fire(
                'Perfil actualizado Com Sucesso!',
                '',
                'success'
            )
        </script>
    @endif
    @if (session('perfil.editar.false'))
        <script>
            Swal.fire(
                'Houve algum erro!',
                '',
                'error'
            )
        </script>
    @endif
    




