<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vixikila | Perfil</title>
    <link rel="shortcut icon" href="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO 2x.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/perfil.css')}}">
    <script src="{{asset('/assets/js/perfil.js')}}" defer></script>
       {{-- sweet alert --}}
       <link rel="stylesheet" href="{{asset('/dashboard/css/sweetalert2.min.css')}}">
       <script src="{{asset('/dashboard/js/sweetalert2.all.min.js')}}"></script>
   
</head>
<body>
    <header>
        <div class="logo"><a href="{{url('/')}}"><img src="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO 3@2x.png')}}" alt="Logo VIxikila"></a></div>
        <nav>
            <ul class="descobrir">
                <li><a href="#">Criar Kixikila</a></li>
                <li><a href="#">Pesquisar Kixikila</a></li>
                <li><a href="#">Como funciona?</a></li>
            </ul>


            <ul class="sign">
                @guest
                    <li><a href="{{url('/login')}}"><span><img src="{{asset('/assets/image/icon/login.png')}}" alt="Ícone de Login"></span>
                            Entrar</a></li>
                    <li><a href="{{url('/register')}}"><span><img src="{{asset('/assets/image/icon/user.png')}}" alt="ícone do usuário"></span>
                        Criar Conta</a></li>
                @endguest
                @auth
                   <li><a href="{{route('perfil')}}"><span><img src="{{asset('/assets/image/icon/user.png')}}" alt="ícone do usuário"></span>
                        Perfil</a></li>
                        <li><a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Terminar sessão</a></li>
        
                   
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
        <div class="head">
            <div class="circle"><img src="{{asset('/assets/image/user-login.png')}}" alt="Foto do perfil de usuário" class="user-img">
            <button><img src="{{asset('/assets/image/icon/outline_photo_camera_white_24dp.png')}}" alt="Ícone da camera"> <span>Editar</span></button></div>
            <h1 class="user-nome">{{Auth::user()->nomeusuario}}</h1>
            <h1 class="id-user">ID <span class="id">{{Auth::user()->id}}</span></h1>
            <button class="settings"><img src="{{asset('/assets/image/settings-cogwheel-button.png')}}" alt="Definições"></button>
        </div>
        <h1 class="kixikilas-presentes">Kixikilas em que estou</h1>
        <div class="kixikilas-criadas">
            <h3>CRIADAS POR MIM</h3>
           
            @if (isset($minhaskixikilas))
                @foreach ($minhaskixikilas as $kixikila)
                <div class="card">
                    <div class="first-column">
                        <div class="header">
                            <div class="hand-img"><img src="{{asset('/assets/image/hand-shake.png')}}" alt="hand-shake"></div>
                            <span>Kixikila</span>
                        </div>
    
                        <div class="participantes-texto">
                            Participantes: <span class="participantes">{{$kixikila->n_pessoas}}</span>
                        </div>
                    </div>
                    <div class="second-column">
                        <h4>Informações</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit vel doloribus illum eaque, sequi nesciunt </p>
                        <div class="valor">
                            <span class="montante">{{$kixikila->montante}}</span>   Kz / Mês
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
           

            <div class="criar-kixikila">
                <button id="criarModal"><img src="{{asset('/assets/image/criar-kixikila.png')}}" alt="Clicar para criar kixikila"></button>
                <span>Criar Kixikila</span>
            </div>

        </div>

        <hr>

        <div class="kixikilas-outros">
            <h3>CRIADAS POR OUTROS</h3>
            @if (isset($kixikilas))
                @foreach ($kixikilas as $kixikila)
                <div class="card">
                    <div class="first-column">
                        <div class="header">
                            <div class="hand-img"><img src="{{asset('/assets/image/hand-shake.png')}}" alt="hand-shake"></div>
                            <span>Kixikila</span>
                        </div>
    
                        <div class="participantes-texto">
                            Participantes: <span class="participantes">>{{$kixikila->n_pessoas}}</span>
                        </div>
                    </div>
                    <div class="second-column">
                        <h4>Informações</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit vel doloribus illum eaque, sequi nesciunt </p>
                        <div class="valor">
                            <span class="montante">>{{$kixikila->montante}}</span>   Kz / Mês
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
         

        </div>

        <div class="tela-criar-kixikila" id="modal">
            <span class="fechar">&times;</span>
            <h1>Criar uma kixikila</h1>
            <form action="{{route('site.kixikila.store')}}" method="POST">
                @csrf
                <input type="text" name="id" id="id" placeholder="| ID de Usuário" readonly value="{{Auth::user()->id}}">
                <input type="text" name="iban" id="iban" placeholder="| IBAN" readonly value="{{Auth::user()->iban}}">
                    
                <input type="number" min="0.5" step="0.1" name="montante" id="montante" placeholder="| Valor mensal (00.00 Kz)">
                    
                <div class="numero-pessoas">
                    <div class="radio-group">
                        <input type="radio" name="radio" id="2-pessoas" value="2" checked>
                        <label for="2-pessoas">2 Pessoas</label>
                        <label for="2-pessoas">(2 Meses)</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" value="4" name="radio" id="4-pessoas">
                        <label for="4-pessoas">4 Pessoas</label>
                        <label for="4-pessoas">(4 Meses)</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" value="8" name="radio" id="8-pessoas">
                        <label for="8-pessoas">8 Pessoas</label>
                        <label for="8-pessoas">(8 Meses)</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" value="12" name="radio" id="12-pessoas">
                        <label for="12-pessoas">12 Pessoas</label>
                        <label for="12-pessoas">(12 Meses)</label>
                    </div>
                    
                </div>
                <button>Criar kixikila</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="primeira-coluna">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO 3@2x.png')}}" alt="Logo"></a>
                </div>
                <div class="redes-sociais">
                    <div class="fb"><img src="{{asset('/assets/image/facebook.png')}}" alt="facebook"></div>
                    <div class="linkedin"><img src="{{asset('/assets/image/linkedin.png')}}" alt="linkedin"></div>
                    <div class="gmail"><img src="{{asset('/assets/image/google.png')}}" alt="google"></div>
                </div>
            </div>
            <div class="nav">
                <h2>Navegação</h2>
                <ul class="descobrir">
                    <li><a href="entrar.html"> - Criar Kixikila</a></li>
                    <li><a href="#"> - Pesquisar Kixikila</a></li>
                    <li><a href="#" >- Como funciona?</a></li>
                </ul>
            </div>
            <div class="footer-descricao">
                <h2>Descrição</h2>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Illum sequi ratione saepe nostrum. Maiores similique sunt dolor! Earum error iste veniam similique ipsam tempora ab vitae officiis impedit reprehenderit. Tempore. Lorem ipsum dolor sit amet consectetur adipisicing elit. At perferendis adipisci consequatur omnis sunt fuga debitis nostrum deserunt, excepturi repellat? Molestiae saepe itaque ullam, veniam doloremque ipsam. Obcaecati, sint illo.
                </p>
            </div>
        </div>
    </footer>
    @if (session('kixikila.cadastrar.true'))
<script>
    Swal.fire(
        'Kixikila Cadastrada Com Sucesso!',
        '',
        'success'
    )

</script>
@endif

@if (session('kixikila.cadastrar.false'))
<script>
    Swal.fire(
        'Erro ao cadastrar a Kixikila!',
        '',
        'error'
    )

</script>
@endif
</body>
</html>