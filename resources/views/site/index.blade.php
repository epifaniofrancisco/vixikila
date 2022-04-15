@extends('layouts.includes_site.Header')
@section('titulo', 'Página-inicial!')
@section('conteudo')

 

<main>
    <div class="apresentar">
        <div class="textos">
            <h2>O seu dinheiro fica seguro durante cada jogo</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore amet, facilis voluptatem sapiente exercitationem alias ad sed omnis. Officia omnis animi quia minus, quibusdam ducimus. Ut voluptatibus quae asperiores eos? Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsam, doloremque. Quisquam voluptatum animi repellat laudantium placeat repellendus corrupti, dicta nihil iste. Ratione rerum adipisci tenetur repudiandae iste dignissimos officiis ipsa!</p>
        </div>
        <img src="{{asset('/assets/image/locker-dynamic-color.png')}}" alt="Cofre de dinheiro">
    </div>

    <div class="kixikilas-activas">
        @if (isset($kixikilas))
            @foreach ($kixikilas as $kixikila)
            <div class="card">
                <div class="header">
                    <div class="hand-img"><img src="{{asset('/assets/image/hand-shake.png')}}" alt="hand-shake"></div>
                    <span>Kixikila</span>
                </div>
                <h4>Informações</h4>
                <p class="descricao">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci deserunt ipsa accusamus, a rem hic? ?
                <p>Participantes: <span class="participantes">{{$kixikila->n_pessoas}}</span></p>
    
                <span class="valor"><span class="montante">{{$kixikila->montante}}</span> Kz / Mês</span>
    
                {{-- @if ($kixikila->montante <= date("Y-m-d")) --}}
                <button class="fazer-parte entrar">Fazer parte</button>
                {{-- @endif --}}
            </div>
            @endforeach
        @endif
      
    </div>
    <div class="img-acima">
        <div class="progresso">
            <div class="textos">
                <h2>Pode ver o progresso da Kixikila</h2>
                <h2> pelo seu Smartphone</h2>
                <p >
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis officia et quis porro incidunt cumque? Soluta alias porro itaque sed, voluptate ipsa laborum animi a iure veniam assumenda tenetur ut.
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. At nemo provident quia, sequi vitae culpa quasi tempora inventore, suscipit officiis officia deleniti fugit nam adipisci, ducimus voluptate reiciendis quibusdam repellendus?
                </p>
            </div>
            <div class="smartphone">
                <img src="{{asset('/assets/image/mobile-dynamic-color.png')}}" alt="Smartphone" class="phone">
                <img src="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO 2x.png')}}" alt="Logo VIxikila" class="logo">
            </div>
    </div>
    </div>

    <div class="tela-entrar-kixikila" id="modal">
        <span class="fechar">&times;</span>
        <h1>Entrar na kixikila</h1>
        <h2>Criador da kixikila: <span>Epifânio Francisco</span></h2>
        <h3>Informações</h3>
            <p class="descricao">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Adipisci deserunt ipsa accusamus, a rem hic? ? Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa temporibus incidunt, ad, corrupti itaque tempore quisquam magnam eius voluptates at inventore laborum similique. Veritatis unde quasi qui aspernatur nam reprehenderit.
            <p class="participante-texto">Participantes: <span class="participantes">3</span></p>

            <span class="valor"><span class="montante">70.000</span> Kz / Mês</span>

        <form action="#">
            <label for="codigo">
                Por favor verifique o seu email, enviamos um código para si a confirmar que é o usuário real que deseja entrar na kixikila.</label>
            <input type="text" name="codigo" id="codigo" placeholder="| Código de confirmação">
            <button>Entrar na kixikila</button>
        </form>
    </div>

</main>
@endsection