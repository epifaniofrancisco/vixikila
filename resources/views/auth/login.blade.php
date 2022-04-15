

 @extends('layouts.includes_site.Header')
@section('titulo', 'Vixikila | Entrar')
@section('conteudo')






<link rel="stylesheet" href="{{asset('/assets/css/entrar.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/cadastrar.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">

<script src="{{asset('/assets/js/cadastrar.js')}}" defer></script>
<script src="{{asset('/assets/js/script.js')}}" defer></script>
<script src="{{asset('/assets/js/entrarKixikila.js')}}')}}" defer></script>


<main>
    <div class="kixikila">
        <img src="{{asset('/assets/image/PADRÃO DO LOGOTIPO.png')}}" alt="Padrão logótipo" class="background">
        <div class="cadastrar-logo"><img src="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO 3@2x.png')}}" alt="Logo de VIxikila"></div>
    </div>
    <div class="form-entrar">
        <img src="{{asset('/assets/image/icon/user-login.png')}}" alt="Ícone usuário">

        <hr>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <input type="text" name="email" id="email-nome" placeholder="| Email">

            <input type="password" name="password" id="senha" placeholder="| Senha">

            
        <button type="submit"><span><img src="{{asset('/assets/image/icon/login.png')}}" alt="Ícone de Login"></span>Entrar</button>
        </form>

        <p>Primeira vez aqui? <a href="{{url('/register')}}">Criar conta</a></p>
    </div>
</main>



        
@endsection





