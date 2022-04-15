@extends('layouts.includes_site.Header')
@section('titulo', 'Bem-vindo!')
@section('conteudo')

<div class=" banner p-5 h-10" style="border-bottom:5px solid rgba(255, 0, 0, 0.616);  height: 520px" >
    <div class="col-md-12 d-flex justify-content-end pt-2" style="margin-top: 4%" >
        @if (!Auth::user())
        <div class="col-md-3 bg-light shadow-lg login py-4" data-aos="fade-up-left" style="">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="my-5">  
                    <h3 class="h3 text-center">Entrar</h3>
                </div>
                <div class="form-group my-3 pt-4">
                    <input type="text" placeholder="email" class="form-control input" name="email" id="">
                </div>
                <div class="form-group pt-4">
                    <input type="password" placeholder="Senha" class="form-control input" name="password" id="">
                </div>
                <div class="col-md-4 mt-5 mx-auto">
                    <button class="btn btn-lg btn-danger ">Entrar</button>
                </div>
            </form>

        </div>
        @else


        @endif

    </div>


</div>
  </div>
<div class="container">

  @include('site.user-menu')

  <div class="col-md-12 mt-2" data-aos="fade-down"
  data-aos-easing="linear"
  data-aos-duration="1500">
      <div class="row">
          <div class="col-md-6 " >
          <img src="{{asset('images/banner1.jpg')}}" class="mx-auto shadow-lg" width="100%"  alt="">

          </div>
          <div class="col-md-6 p-5 ">
              <h2 class="text-center"> Estabelecimentos</h2>
              <p>Todos os estabelecimentos devem estar cadastrados no sistema a fim de poder ter usufruir de um bom negocio e poder
                  assim estar de acordo com a lei.
              </p>
                  <p>
                  Cada estabelecimento após ser cadastrado possuira um codigo QR onde podera identificar o mesmo estabelecimento.
              </p>

          </div>
      </div>

      <div class="row my-2" data-aos="fade-up"
      data-aos-anchor-placement="center-center">

          <div class="col-md-6 p-5 ">

              <h2 class="text-center"> Publicidades</h2>
              <p>Todos os estabelecimentos que necessitarem de emitir uma publicidade ou divulgar os seus produtos deverão pagar pela publicidade no valor de 100kz de acordo com a modalidade de pagamento escolhida pelo estabelecimento</p>
      <p>
          O que poderá evitar disperções e poluições visuais
      </p>

          <p>As publicidades serão cobradas de acordo com o tamanho da publicidade</p>
  </div>
          <div class="col-md-6 " >
               <img src="{{asset('images/publicidade.jpeg')}}" class="img-fluid shadow-lg " width="100%" alt="">

             </div>
      </div>

      <div class="row my-2" data-aos="fade-up"
      data-aos-anchor-placement="center-bottom">
          <div class="col-md-6 " >
         <img src="{{asset('images/banner4.jpg')}}" class="img-fluid shadow-lg" alt="" width="100%">

          </div>
          <div class="col-md-6 p-5 ">
              <h2 class="text-center"> Multas</h2>
              <p>Todos os esatebelcimentos que não pagarem as suas dividas lhes será aplicado uma multa que por efeito aumentará de acordo com os dias.
              </p>
              <p>Melhor é pagar para não gerar mais despezas a receitas.</p>
          </div>
      </div>

      <div class="row my-2">

          <div class="col-md-6 p-5 ">
              <h2 class="text-center"> Subscrições</h2>
  <p>As subscrições serão feitas para cada estabelecimento onde lhes irão preencher um formulario para pode realizar a subscrição onde assim poderá fazer seus trabalhos de acordo com as subscrições.</p>
  <p>Após a subscrição deverá fazer o pagamento da subscroção para que a sua subscrição estar validada. Só após isso poderá ter todos os beneficios do Sistema.</p>

          </div>
          <div class="col-md-6 " >
          <img src="{{asset('images/banner5.png')}}" class="img-fluid shadow-lg" alt="" width="100%">

             </div>
      </div>
  </div>

  <div class="col-md-12 mt-5" data-aos="flip-up" id="sobre">
      <h3 class="text-center my-4 ">Sobre a Plataforma Zenga</h3>

      <div class="row">

          <div class="card col-md-3 mx-auto p-3 shadow-sm">
              <h5 class="text-center">Planos acessiveis</h5>
          </div>
          <div class="card col-md-3 mx-auto p-3 shadow-sm">
              <h5 class="text-center">Inove a forma de Vender</h5>
          </div>
          <div class="card col-md-3 mx-auto p-3 shadow-sm">
              <h5 class="text-center">Juntos por uma Angola Digital</h5>
          </div>

      </div>
      <div class="mt-5 col-md-8 mx-auto  p-5 shadow-lg" style="font-size: 18px;">
          <div class="col-md-3 mx-auto ">
              <img src="{{asset('images/insignia/logo.png')}}" class=" mx-auto" calt="">
          </div>
          <p class="text-center">O Zenga é uma plataforma que veio para melhorar a forma de como vendemos os Produtos , bem como a forma de como as publicitamos</p>
          <p class="text-center">Para uma melhor Organização, a plataforma vai ajudar ao estado controlar os estabelecimentos que estão em uma determinda Area ou cidade , a fim de  prover uma melhor estatistica exata dos lugares onde há muito compra e venda no nosso mercado Angolano</p>
          <p class="text-center">
              A partir de casa poderás acessar a plataforma e poder fazer suas subscrições bem como controlar as suas subscrições
          </p>
      </div>
  </div>

  {{--const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
      el: '.swiper-scrollbar',
    },
  });
   --}}

        <div class="card col-md-3 mx-auto p-3 shadow-sm">
            <h5 class="text-center">Planos acessiveis</h5>
        </div>
        <div class="card col-md-3 mx-auto p-3 shadow-sm">
            <h5 class="text-center">Inove a forma de Vender</h5>
        </div>
        <div class="card col-md-3 mx-auto p-3 shadow-sm">
            <h5 class="text-center">Juntos por uma Angola Digital</h5>
        </div>

    </div>
    <div class="mt-5 col-md-8 mx-auto  p-5 shadow-lg" style="font-size: 18px;">
        <div class="col-md-3 mx-auto ">
            <img src="{{asset('images/insignia/logo.svg')}}" class=" mx-auto" calt="">
        </div>
        <p class="text-center">O Zenga é uma plataforma que veio para melhorar a forma de como vendemos os Produtos , bem como a forma de como as publicitamos</p>
        <p class="text-center">Para uma melhor Organização, a plataforma vai ajudar ao estado controlar os estabelecimentos que estão em uma determinda Area ou cidade , a fim de  prover uma melhor estatistica exata dos lugares onde há muito compra e venda no nosso mercado Angolano</p>
        <p class="text-center">
            A partir de casa poderás acessar a plataforma e poder fazer suas subscrições bem como controlar as suas subscrições
        </p>
    </div>
</div>

@endsection




