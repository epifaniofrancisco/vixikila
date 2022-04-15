<style>
    .modal-backdrop.show {
    opacity: 0.5;
    z-index: 1;
}
</style>

<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <form class="form-inline mr-auto searchform text-muted">
        <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search"
            placeholder="Digite algo..." aria-label="Search">
    </form>
    <ul class="nav">
        <li><div style="margin-top: 15px">
            <a href="#" onclick="doGTranslate('pt|en');return false;" title="English" class="gflag nturl" style="background-position:-0px -0px;"><img src="//gtranslate.net/flags/blank.png" height="25" width="25" alt="English" /></a><a href="#" onclick="doGTranslate('pt|fr');return false;" title="French" class="gflag nturl" style="background-position:-200px -100px;"><img src="//gtranslate.net/flags/blank.png" height="25" width="25" alt="French" /></a><a href="#" onclick="doGTranslate('pt|pt');return false;" title="Portuguese" class="gflag nturl" style="background-position:-300px -200px;"><img src="//gtranslate.net/flags/blank.png" height="25" width="25" alt="Portuguese" /></a>

                <br /><select hidden onchange="doGTranslate(this);"><option value="">Selecione</option><option value="pt|en">Inglês</option><option value="pt|fr">Frances</option><option value="pt|pt">Português</option></select><div id="google_translate_element2"></div>
        </div></li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-grid fe-16"></span>
            </a>
        </li>

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="fe fe-user fe-16"></span>
                <!--      <span class="avatar avatar-sm mt-2">
                     @php
                         $img = Auth::User()->profile_photo_path;
                     @endphp
                    @if (isset($img))
                        <img src="{{ url("storage/{$img}") }}" alt="..." class="avatar-img rounded-circle">
                    @endif
                </span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                <a class="nav-link text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Terminar a Sessão
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </ul>
</nav>

<!-- @if (null !== Auth::user()) -->
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100  d-flex">
            <a class="navbar-brand mx-auto  flex-fill text-center" href="{{ url('/dashboard/admin') }}">
                <img rel="icon" id="logo" src="{{ asset('/images/insignia/logo.svg') }}"
                    style="width:130px; margin:auto" />

            </a>
        </div>


        <ul class="navbar-nav flex-fill w-100 mb-2">

            <span>QRCode ZENGA</span>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" >
                        <i class="fas fa-city"></i>
                         <button type="button" class="btn text-center " data-toggle="modal"
                            data-target="#exampleModal">
                            QR CODE Zenga
                        </button>
                    </a>

                    <a class="nav-link" >
                        <i class="fas fa-city"></i>
                         <button type="button" class="btn text-center " data-toggle="modal"
                            data-target="#exampleModalJaz">
                            QR CODE Jazznocazenga
                        </button>
                    </a>
                </li>
            </ul>
            <span>Painel</span>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item w-100">
                    <a class="nav-link" href="{{ url('/dashboard/admin') }}">
                        <i class="fe fe-help-circle fe-16"></i>
                        <span class="ml-3 item-text">Painel</span>
                    </a>
                </li>
            </ul>


        @if (Auth::user()->vc_perfil != 'Gráfica A' && Auth::user()->vc_perfil != 'Gráfica B')
            
       
            <div>
                <p>Utilizador</p>
            </div>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.user.listar') }}"  class=" nav-link">
                    <i class="far fa-user"></i>
                    <span class="ml-3 item-text"> Utilizador</span>
                </a>
                {{-- <ul class="collapse list-unstyled pl-4 w-100" id="utilizador">

                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.user.criar') }}"><span
                                class="ml-1 item-text">Cadastrar
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.user.listar') }}"><span
                                class="ml-1 item-text">Listar
                            </span></a>
                    </li>
                </ul> --}}
            </li>

                <div>
                    <p>Funcionários</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.funcao.listar') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Funções</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="funcoes">

                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('admin.funcao.cadastrar') }}"><span
                                        class="ml-1 item-text">Cadastrar
                                       </span></a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.funcao.listar') }}"><span class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.funcionario.listar') }}"  class=" nav-link">
                        <i class="fas fa-id-card"></i>
                        <span class="ml-3 item-text"> Funcionários</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="funcionario">

                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('admin.funcionario.cadastrar') }}"><span
                                        class="ml-1 item-text">Cadastrar
                                       </span></a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.funcionario.listar') }}"><span class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>

                


            <div>
                <p>Estabelecimento</p>
            </div>

            <li class="nav-item dropdown">
                <a href="{{ route('admin.categoria-estabelecimento.listar') }}"
                    class="nav-link">
                    {{-- <i class="fe fe-layers"></i> --}}
                    <i class="fas fa-layer-group"></i>
                    <span class="ml-3 item-text">Categoria </span>
                </a>
                {{-- <ul class="collapse list-unstyled pl-4 w-100" id="categoriaestabelecimento">

                    <li class="nav-item">
                        <a class="nav-link pl-3"
                            href="{{ route('admin.categoria-estabelecimento.cadastrar') }}"><span
                                class="ml-1 item-text">Cadastrar</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.categoria-estabelecimento.listar') }}"><span
                                class="ml-1 item-text">Listar</span></a>
                    </li>
                </ul> --}}
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.distrito.listar') }}" class="nav-link">
                    <i class="fas fa-city"></i>
                    <span class="ml-3 item-text">Distrito </span>
                </a>


                <a href="{{ route('admin.alvaras.listar') }}" class="nav-link">
                    <i class="fas fa-city"></i>
                    <span class="ml-3 item-text">   Alvará </span>
                </a>
                {{-- <ul class="collapse list-unstyled pl-4 w-100" id="destrito">

                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.distrito.cadastrar') }}"><span
                                class="ml-1 item-text">Cadastrar</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.distrito.listar') }}"><span
                                class="ml-1 item-text">Listar</span></a>
                    </li>
                </ul> --}}
            </li>

            <li class="nav-item dropdown">
                <a href="{{ route('admin.estabelecimento.listar') }}"
                    class="nav-link">
                    <i class="fas fa-store"></i>
                    <span class="ml-3 item-text"> Estabelecimento</span>
                </a>
                {{-- <ul class="collapse list-unstyled pl-4 w-100" id="estabelecimento">

                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.estabelecimento.cadastrar') }}"><span
                                class="ml-1 item-text">Cadastrar
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.estabelecimento.listar') }}"><span
                                class="ml-1 item-text">Listar
                            </span></a>
                    </li>
                </ul> --}}
            </li>

            {{-- <li class="nav-item dropdown">
                    <a href="{{ route('admin..listar') }}"  class=" nav-link">
                        <i class="fe fe-maximize"></i>
                        <span class="ml-3 item-text">QR Code  </span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="qrcode">

                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('admin.user.criar') }}"><span
                                        class="ml-1 item-text">Gerar</span></a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.user.listar') }}"><span class="ml-1 item-text">Listar</span></a>
                        </li>
                    </ul>
                </li> --}}
            <li class="nav-item dropdown">
                <a href="{{ route('admin.agendamento.listar') }}"  class=" nav-link">
                    <i class="far fa-clock"></i>
                    <span class="ml-3 item-text">Angendamento </span>
                </a>
                {{-- <ul class="collapse list-unstyled pl-4 w-100" id="Angendamento">

                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.agendamento.cadastrar') }}"><span
                                class="ml-1 item-text">Agendar</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.agendamento.listar') }}"><span
                                class="ml-1 item-text">Listar</span></a>
                    </li>

                </ul> --}}
            </li>
            {{-- <li class="nav-item dropdown">
                    <a href="{{ route('admin..listar') }}"  class=" nav-link">
                        <i class="fe fe-x"></i>
                        <span class="ml-3 item-text">Cancelamento </span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="cancelamtoEStabelecimento">

                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('admin.cancelamento_estabelecimento.cadastrar') }}"><span
                                        class="ml-1 item-text">Cancelar</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ route('admin.cancelamento_estabelecimento.listar') }}"><span
                                        class="ml-1 item-text">Listar</span></a>
                            </li>

                    </ul>
                </li> --}}
            <div>




                <div>
                    <p>Alvará</p>
                </div>

                
                <li class="nav-item dropdown">
                    <a href="{{ route('alvaras') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Alvarás</span>
                    </a>
                   
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('alvaras.categorias_alvara') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Categoria</span>
                    </a>
                   
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('alvaras.sub_categorias_alvara') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Subcategoria</span>
                    </a>
                   
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('alvaras.vistoria.agendas') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Agenda/Vistoria</span>
                    </a>
                   
                </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('alvaras.disponibilidades_vistoria') }}"  class=" nav-link">
                        {{-- <i class="fe fe-user"></i> --}}
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span class="ml-3 item-text"> Disponibilidade/Vistoria</span>
                    </a>
                   
                </li>
               
                <div>
                    <p>Publicidade</p>
                </div>

                <li class="nav-item dropdown">
                    {{-- <a href="{{ route('admin.categoria-publicidade.listar') }}" 
                        class=" nav-link">
                        {{-- <i class="fe fe-layers"></i> --}}
                        {{-- <i class="fas fa-layer-group"></i>
                        <span class="ml-3 item-text">Categoria </span>
                    </a> --}}
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="categoriaPublicidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.categoria-publicidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.categoria-publicidade.listar') }}"><span
                                    class="ml-1 item-text">Listar</span></a>
                        </li>


                    </ul> --}}
                </li>

                {{-- <li class="nav-item dropdown">
                    <a href="#publicidade" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fas fa-chalkboard"></i>
                        <span class="ml-3 item-text"> Publicidade</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="publicidade"> --}}

                        {{-- <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.publicidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.publicidade.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.publicidade.nao_aprovadas') }}"><span
                                    class="ml-1 item-text">Não aprovadas</span></a>
                        </li>
                    </ul> --}}
                    <a href="{{ route('admin.publicidade.listar') }}"
                    class=" nav-link">
                    <i class="fas fa-chalkboard"></i>
                    <span class="ml-3 item-text"> Publicidade</span>
                </a>
                </li>

            </div>


            <div>
                {{-- <div>
                    <p>Pagamento</p>
                </div> --}}
                {{-- <li class="nav-item dropdown">
                    <a href="{{ route('admin.periodo-modalidade.listar') }}"
                        class=" nav-link">
                        <i class="far fa-calendar"></i>
                        <span class="ml-3 item-text">Periodo da Modalidade </span>
                    </a> --}}
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="pagamentoModalidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.periodo-modalidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.periodo-modalidade.listar') }}"><span
                                    class="ml-1 item-text">Listar</span></a>
                        </li>
                    </ul> --}}
                {{-- </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.modalidade-pagamento.listar') }}"
                        class=" nav-link">
                        <i class="fe fe-disc"></i>
                        <span class="ml-3 item-text"> Modalidade</span>
                    </a> --}}
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="modalidadePagamento">

                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.modalidade-pagamento.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.modalidade-pagamento.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                {{-- </li>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.periodo-de-pagamento.listar') }}"
                        class=" nav-link">
                        <i class="far fa-hourglass"></i>
                        <span class="ml-3 item-text">Periodo </span>
                    </a> --}}
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="pagamentoPeriodo">

                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.periodo-de-pagamento.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.periodo-de-pagamento.listar') }}"><span
                                    class="ml-1 item-text">Listar</span></a>
                        </li>
                    </ul> --}}
                {{-- </li>
 --}}

            </div>


            <div>
                <div>
                    <p>Subscrição</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.tipo_qr.listar') }}"
                        class=" nav-link">
                        <i class="fas fa-qrcode"></i>
                        <span class="ml-3 item-text"> Tipo de QRCode</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="tipo_qr">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.tipo_qr.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.tipo_qr.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}

                    {{-- <a href="#subscricao" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                       
                        <i class="fas fa-hand-holding-usd"></i>
                        <span class="ml-3 item-text"> Subscrição</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="subscricao"> --}}

                        {{-- <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.subscricao.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.subscricao.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.subscricao.nao_aprovadas') }}"><span
                                    class="ml-1 item-text">Não aprovadas
                                </span></a>
                        </li>


                    </ul> --}}
                    <a href="{{ route('admin.subscricao.listar') }}"
                    class=" nav-link">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span class="ml-3 item-text"> Subscricao</span>
                </a>
                    <a href="{{ route('admin.fatura.listar') }}"
                        class=" nav-link">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span class="ml-3 item-text"> Fatura</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="fatura">
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.fatura.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>
                {{-- <li class="nav-item dropdown">
                        <a href="#Cancelamento" data-toggle="collapse" aria-expanded="false" class=" nav-link">
                            <i class="fe fe-x"></i>
                            <span class="ml-3 item-text"> Cancelamento</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="Cancelamento">

                                <li class="nav-item">
                                    <a class="nav-link pl-3" href="{{ route('admin.user.criar') }}"><span
                                            class="ml-1 item-text">Cancelar
                                        </span></a>
                                </li>
                        </ul>
                    </li> --}}



            </div>


            <div>
                <div>
                    <p>Legalidade</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.multa.listar') }}"  class=" nav-link">
                        <i class="fas fa-money-bill"></i>
                        <span class="ml-3 item-text"> Multa</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="multa">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.multa.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.multa.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>

                <li class="nav-item dropdown">
                    <a href="{{ route('admin.taxa.listar') }}"  class=" nav-link">
                        <i class="fas fa-coins"></i>
                        <span class="ml-3 item-text"> Taxa</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="taxa">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.taxa.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.taxa.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>



            </div>

            <div>
                <div>
                    <p>Taxa de Licença</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="#tipo-publicidade" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Tipo de Publicidade</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="tipo-publicidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.tipo-publicidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.tipo-publicidade.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>   
                <li class="nav-item dropdown">
                    <a href="#modalidade-publicidade" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Modalidade de Publicidades</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="modalidade-publicidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.modalidade-publicidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.modalidade-publicidade.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>        
                
                <li class="nav-item dropdown">
                    <a href="#superficie-publicidade" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Superfície de Publicidades</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="superficie-publicidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.superficie-publicidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.superficie-publicidade.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>   
                <li class="nav-item dropdown">
                    <a href="#ucf-localidade" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Localidade</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="ucf-localidade">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.ucf-localidade.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.ucf-localidade.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a href="#ucf-localidade-valor" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Localidade valor</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="ucf-localidade-valor">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.ucf-localidade-valor.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.ucf-localidade-valor.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>    
                <li class="nav-item dropdown">
                    <a href="#unidade-medida" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="fe fe-credit-card"></i>
                        <span class="ml-3 item-text"> Unidade de medida</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="unidade-medida">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.unidade-medida.cadastrar') }}"><span
                                    class="ml-1 item-text">Cadastrar
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.unidade-medida.listar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul>
                </li>    



            </div>

           
            

            <div>
                <div>
                    <p>Relatório</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="#relatorio" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                        <i class="far fa-clipboard"></i>
                        <span class="ml-3 item-text"> Relatório</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="relatorio">

                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.relatorio.estabelecimento_categoria') }}" target="_blank"><span
                                    class="ml-1 item-text">Estabelecimentos por Categoria
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.relatorio.estabelecimento_distrito') }}"
                                target="_blank"><span class="ml-1 item-text">Estabelecimentos por Distrito
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3"
                                href="{{ route('admin.relatorio.publicidade_estabelecimento') }}"
                                target="_blank"><span class="ml-1 item-text">Publicidades por Estabelecimento
                                </span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.relatorio.multa_estabelecimento') }}"
                                target="_blank"><span class="ml-1 item-text">Multas por Estabelecimento
                                </span></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.relatorio.listar') }}"><span class="ml-1 item-text">Listar
                            </span></a>
                        </li> --}}
                    </ul>
                </li>
            </div>

            <div>
                <div>
                    <p>Registro de Actividades</p>
                </div>
                <li class="nav-item dropdown">
                    <a href="{{ route('admin.log.pesquisar') }}" class=" nav-link">
                        {{-- <i class="fe fe-database"></i> --}}
                        <i class="far fa-flag"></i>
                        <span class="ml-3 item-text"> Registro</span>
                    </a>
                    {{-- <ul class="collapse list-unstyled pl-4 w-100" id="registro">

                        <li class="nav-item">
                            <a class="nav-link pl-3" href="{{ route('admin.log.pesquisar') }}"><span
                                    class="ml-1 item-text">Listar
                                </span></a>
                        </li>
                    </ul> --}}
                </li>



            </div>

        @endif
        <div>
            <div>
                <p>Gráfica</p>
            </div>
            <li class="nav-item dropdown">
                <a href="#grafica" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                    <i class="far fa-clipboard"></i>
                    <span class="ml-3 item-text"> QRcode - estabelecimento</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="grafica">

                    @if (Auth::user()->vc_perfil == "Gráfica B" || Auth::user()->vc_perfil == "Administrador")
                    <li class="nav-item">
                        <a class="nav-link pl-3"
                            href="{{ route('admin.qrcode.estabelecimento.listar','qra') }}" ><span
                                class="ml-1 item-text">QRA
                            </span></a>
                    </li>
                    @endif
                   

                    @if (Auth::user()->vc_perfil == "Gráfica A" || Auth::user()->vc_perfil == "Administrador")
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.qrcode.estabelecimento.listar','qrv') }}"
                            ><span class="ml-1 item-text">QRV
                            </span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pl-3" href="{{ route('admin.qrcode.estabelecimento.listar','qrcar') }}"
                            ><span class="ml-1 item-text">QRCARRO
                            </span></a>
                    </li>
                    @endif
                    
                </ul>
            </li>
        </div>


            <!-- @if (Auth::user()->vc_perfil == 'Administrador' || Auth::user()->vc_perfil == 'Master' )
                    <li class="nav-item dropdown">
                        <a href="#anoLectivo" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-calendar fe-16"></i>
                            <span class="ml-3 item-text"> Anos Lectivo</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="anoLectivo">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ url('/admin/anolectivo/cadastrar') }}"><span
                                        class="ml-1 item-text">Cadastrar</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ url('/admin/anolectivo') }}"><span
                                        class="ml-1 item-text">Listar</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#Disciplinas" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle nav-link">
                            <i class="fe fe-book-open fe-16"></i>
                            <span class="ml-3 item-text"> Disciplinas</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="Disciplinas">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ url('disciplinas/criar') }}"><span
                                        class="ml-1 item-text">Cadastrar</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ url('disciplinas') }}"><span
                                        class="ml-1 item-text">Listar</span></a>
                            </li>
                        </ul>
                    </li>
                    <p class="text-muted nav-heading mt-4 mb-1">
                        <span> Logs de Actidade</span>
                    </p>
                    <li class="nav-item dropdown">
                        <a href="#logs" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                            <i class="fe fe-database fe-16"></i>
                            <span class="ml-3 item-text"> Logs</span>
                        </a>
                        <ul class="collapse list-unstyled pl-4 w-100" id="logs">
                            <li class="nav-item">
                                <a class="nav-link pl-3" href="{{ url('admin/logs/pesquisar') }}"><span
                                        class="ml-1 item-text">Lista
                                        de Logs</span></a>
                            </li>
                        </ul>
                    </li>
                @endif -->
            <!-- @endif -->
        </ul>
        <div style="z-index: 1;" class="modal fade" id="exampleModal" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">QR
                                            CODE
                                            - Zenga</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="col-md-9 mx-auto" style="
                                        width: 318px;
                                        height: 320px;
                                        background: url('/images/qrcode2.png');
                                        background-position: top left;
                                        background-repeat: no-repeat;
                                        background-image-resize: 2;
                                        background-image-resolution: from-image;
                                        ">
                                        <div class="mx-auto" style="width: 170px; height: 170px; padding-top: 85px;">
                                            {{ QrCode::size(170)->generate(route('admin.api.zengaQr.listar')) }}                                        
                                        </div>                                           

                                        </div>                                      
                                    </div>
                                    <div class="modal-footer">
                                        <a {{-- type="a" --}} class="btn btn-secondary" target="blank" href="{{ route('admin.zenga.qrcodeZenga') }}">PDF</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                          <div style="z-index: 1;" class="modal fade" id="exampleModal" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">QR
                                            CODE
                                            - Zenga</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="col-md-9 mx-auto" style="
                                        width: 318px;
                                        height: 320px;
                                        background: url('/images/qrcode2.png');
                                        background-position: top left;
                                        background-repeat: no-repeat;
                                        background-image-resize: 2;
                                        background-image-resolution: from-image;
                                        ">
                                        <div class="mx-auto" style="width: 170px; height: 170px; padding-top: 85px;">
                                            {{ QrCode::size(170)->generate(route('admin.api.zengaQr.listar')) }}                                        
                                        </div>                                           

                                        </div>                                      
                                    </div>
                                    <div class="modal-footer">
                                        <a {{-- type="a" --}} class="btn btn-secondary" target="blank" href="{{ route('admin.zenga.qrcodeZenga') }}">PDF</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
                                    </div>
                                </div>
                            </div>
                        </div>


    
                        <div style="z-index: 1;" class="modal fade" id="exampleModalJaz" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">QR
                                        CODE
                                        - Jazznocazenga</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="col-md-9 mx-auto" style="
                                    width: 318px;
                                    height: 320px;
                                    background: url('/images/qrcode2.png');
                                    background-position: top left;
                                    background-repeat: no-repeat;
                                    background-image-resize: 2;
                                    background-image-resolution: from-image;
                                    ">
                                    <div class="mx-auto" style="width: 170px; height: 170px; padding-top: 85px;">
                                        {{ QrCode::size(170)->generate('https://zenga.co.ao/jazznocazenga') }}                                        
                                    </div>                                           

                                    </div>                                      
                                </div>
                                <div class="modal-footer">
                                    <a {{-- type="a" --}} class="btn btn-secondary" target="blank" href="{{ route('admin.zenga.qrcodeJazz') }}">PDF</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Sair</button>
                                </div>
                            </div>
                        </div>
                    </div>

    </nav>

    
</aside>
