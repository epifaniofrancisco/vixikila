<header>
    <div class="logo"><a href="{{url('/')}}"><img src="{{asset('assets/image/LOGO ORIGINAL/VIxikila LOGO 3@2x.png')}}"
                alt="Logo VIxikila"></a></div>
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