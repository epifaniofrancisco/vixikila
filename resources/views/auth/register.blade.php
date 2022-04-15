

@extends('layouts.includes_site.Header')
@section('titulo', 'Vixikila | Criar Conta')
@section('conteudo')

<link rel="stylesheet" href="{{asset('/assets/css/entrar.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/cadastrar.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">

<script src="{{asset('/assets/js/cadastrar.js')}}" defer></script>
<script src="{{asset('/assets/js/script.js')}}" defer></script>
<script src="{{asset('/assets/js/entrarKixikila.js')}}')}}" defer></script>

<div class="progressbar">
    <div class="progress" id="progress"></div>

    <div class="progress-step progress-step-active" data-title="Dados Pessoais"></div>
    <div class="progress-step" data-title="Confirmar dados"></div>
    <div class="progress-step" data-title="Dados bancários"></div>
    <div class="progress-step" data-title="Verificação"></div>
  </div>

  
    <form action="{{ route('register') }}" method="POST"  class="form" id="form1">
        @csrf
    <!-- Passos -->
    <!-- Primeira Etapa: Dados pessoais -->
    <div class="form-step form-step-active">
      <div class="primeira-etapa">
        <div class="cadastrar">
          <img src="{{asset('/assets/image/PADRÃO DO LOGOTIPO.png')}}" alt="Padrão do logótipo" class="background">
          <div class="cadastrar-logo"><img src="{{asset('/assets/image/LOGO ORIGINAL/VIxikila LOGO @2x.png')}}"
              alt="Logo de VIxikila"></div>
          <hr>
          <button class="btn-next" id="submit" onclick="submeter()">Submeter dados</button>
        </div>
        <div class="forms">
          <div class="input-forms">
            <input required type="text" name="nomeusuario" id="nomeusuario" placeholder="| Nome de usuário">
            <input required type="text" name="numerobi" minlength="14" maxlength="14" id="numerobi" placeholder="| Número do Bilhete de Identidade">
            <input required type="email" name="email" id="email" placeholder="| Email">
            <input required type="tel"  name="telefone" id="telefone" placeholder="| Telefone">
            <input required type="password" name="password" id="senha" placeholder="| Senha">
            <input required type="password" name="confirmed" id="confirmarsenha" placeholder="| Confirmar senha">
          </div>
          <p>Depois de preencher os seus dados, terá que <span>submeter os dados</span> para criar o seu perfil</p>
        </div>
      </div>
    </div>

    <!-- Segunda Etapa: Confirmação dos dados -->
    <div class="form-step">
      <div class="segunda-etapa">
        <div class="input-row">
          <div class="input-group">
            <label for="nomecompletobi">Nome Completo</label>
            <input required type="text" name="nomecompletobi" id="nomecompletobi"  readonly/>
          </div>
          <div class="input-group">
            <label for="numero-bilhete">Nº do Bilhete</label>
            <input required type="text" name="numero-bilhete" id="numero-bilhete"  readonly/>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label for="emailbi">Email</label>
            <input required type="text" name="email" id="emailbi"  readonly/>
          </div>
          <div class="input-group">
            <label for="telefonebi">Telefone</label>
            <input required type="number" name="telefone" id="telefonebi"  readonly/>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label for="data-nascimento">Data de Nascimento</label>
            <input required type="text" name="dataNascimento" id="data-nascimento"  readonly/>
          </div>
          <div class="input-group">
            <label for="genero">Género</label>
            <input required type="text" name="genero" id="genero"  readonly/>
          </div>
        </div>
        <div class="input-row">
          <div class="input-group">
            <label for="pais">País</label>
            <input required type="text" name="pais" id="pais"  readonly/>
          </div>
          <div class="input-group">
            <label for="provincia">Província</label>
            <input required type="text" name="provincia" id="provincia"  readonly/>
          </div>
        </div>

        <div class="input-row">
          <div class="input-group">
            <label for="municipio">Município</label>
            <input required type="text" name="municipio" id="municipio"  readonly />
          </div>
          <div class="input-group">
            <label for="residencia">Residência</label>
            <input required type="text" name="residencia" id="residencia"  readonly/>
          </div>
        </div>
        <div class="btns-group">
          <button class="btn btn-prev" id="voltar1">Voltar</button>
          <button class="btn btn-next" id="proximo1">Próximo</button>
        </div>
      </div>
    </div>

    <!-- Terceira Etapa: Dados bancários -->
    <div class="form-step">
      <div class="terceira-etapa">
        <div class="banco-group">
          <div class="banco">
            <label for="conta-bancaria">Número da conta bancária</label>
            <input required type="text" name="contaBancaria" id="dob" />
          </div>
          
        <div class="btns-group">
          <button class="btn btn-prev" id="voltar2">Voltar</button>      
          <button class="seguinte" id="seguinte" >Seguinte</button>
        </div>
        </div>

        <!-- Confirmação dos dados bancários -->
        <div class="confirmar-banco">
          <div class="input-row">
            <div class="input-group">
              <label for="nometitular">Nome Titular</label>
              <input required type="text" name="nometitular" id="nometitular"  readonly/>
            </div>
            <div class="input-group">
              <label for="numero-bilhete-banco">Nº do Bilhete</label>
              <input required type="text" name="numero-bilhete-banco" id="numero-bilhete-banco"  readonly/>
            </div>
          </div>
          <div class="input-row">
            <div class="input-group">
              <label for="email-banco">Email</label>
              <input required type="text" name="email-banco" id="email-banco"  readonly/>
            </div>
            <div class="input-group">
              <label for="telefone-banco">Telefone</label>
              <input required type="number" name="telefone-banco" id="telefone-banco"  readonly/>
            </div>
          </div>
          <div class="input-row">
            <div class="input-group">
              <label for="data-nascimento-banco">Data de Nascimento</label>
              <input required type="text" name="data-nascimento-banco" id="data-nascimento-banco"  readonly/>
            </div>
            <div class="input-group">
              <label for="genero-banco">Género</label>
              <input required type="text" name="genero-banco" id="genero-banco"  readonly/>
            </div>
          </div>
          <div class="input-row">
            <div class="input-group">
              <label for="iban">IBAN</label>
              <input required type="text" name="iban" id="iban"  readonly/>
            </div>
            <div class="input-group">
              <label for="data-exp">Data de expiração</label>
              <input required type="text" name="dataExpCartao" id="data-exp"  readonly/>
            </div>
          </div>

          
        <div class="btns-group center">
          <button class="btn btn-next" id="proximo2">Próximo</button>
        </div>

        </div>
      </div>
    </div>

    <!-- Quarta Etapa: Código de confirmação -->
    <div class="form-step">
      <div class="quarta-etapa">

        <h1>Verifique o Seu Email</h1>
        <hr>
        <p>Obrigado por se cadastrar na <span>VIxikila</span>, por favor clique no botão abaixo para finalizar o seu
          cadastro  e receber um link de confirmação no seu email.</p>
        <button id="verificar" type="submit">Terminar cadastro</button>

      </div>
    </div>
  </form>


   
                    
   




  <script src="//cdn.jsdelivr.net/npm/sweetalert2.all.min.js"></script>

  @if (session('error'))
      <script>
          Swal.fire(
              'Houve algum erro!',
              '',
              'error'
          )
      </script>
  @endif

 <script>

     //submeter
     function submeter(){

       
         
         var nomeusuario = $("#nomeusuario").val();
         var numerobi = $("#numerobi").val();
         var email = $("#email").val();
         var telefone = $("#telefone").val();
      
        // alert(`Usuário ${nomeusuario} com o BI número ${numerobi}`)
        //if (nomeusuario!=" " AND numerobi!=" " AND email!=" " AND telefone!=" " AND numerobi.length==14) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url:`https://api.gov.ao/consultarBI/v2/?bi=${numerobi}&fbclid=IwAR3SIXqTcobUuKufa6eBxh8gc1ySWGJAiPh1NqKzanykrewqeiww_pZGTso`,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            async: false,
            success: function(dados) {
               
                     var cliente = typeof(dados);
                     console.log(dados[0].RESIDENCE_ADDRESS);

                    
                     document.getElementById('nomecompletobi').value = dados[0].FIRST_NAME +" "+dados[0].LAST_NAME;    


                      document.getElementById('numero-bilhete').value =dados[0].ID_NUMBER;
                      document.getElementById('emailbi').value =email;
                      document.getElementById('telefonebi').value =telefone;
                      document.getElementById('data-nascimento').value =dados[0].BIRTH_DATE;
                      document.getElementById('genero').value =dados[0].GENDER_NAME;
                      document.getElementById('pais').value =dados[0].RESIDENCE_COUNTRY_NAME;
                      document.getElementById('provincia').value =dados[0].RESIDENCE_PROVINCE_NAME;
                      document.getElementById('municipio').value =dados[0].RESIDENCE_MUNICIPALITY_NAME;
                      document.getElementById('residencia').value =dados[0].RESIDENCE_NEIGHBOR +" "+dados[0].RESIDENCE_ADDRESS;
            }
           
        });
        // }


     }


    //proximo 1
    const proximo1 = document. querySelector("#proximo1")
    proximo1. addEventListener("click", function(e) {
    e. preventDefault();
   
    });
    const seguinte = document. querySelector("#seguinte")
    seguinte.addEventListener("click", function(e) {
    
    var nomecompleto = $("#nomecompletobi").val();
        var numerobi = $("#numero-bilhete").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var datanascimento = $("#data-nascimento").val();
        var genero = $("#genero").val();
        var iban = $("#dob").val();

        // const dataActual = Date.now();
        // var dataValidade = new Date();
        // dataValidade.setDate(time.getDate() + 360); // Adiciona 3 dias           
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url:`https://api.gov.ao/consultarBI/v2/?bi=${numerobi}&fbclid=IwAR3SIXqTcobUuKufa6eBxh8gc1ySWGJAiPh1NqKzanykrewqeiww_pZGTso`,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            async: false,
            success: function(dados) {

            
                document.getElementById('nometitular').value = nomecompleto;    
                document.getElementById('numero-bilhete-banco').value =numerobi;
                document.getElementById('email-banco').value =email;
                document.getElementById('telefone-banco').value =telefone;
                document.getElementById('data-nascimento-banco').value =datanascimento ;
                document.getElementById('genero-banco').value =genero;
                document.getElementById('iban').value =iban;
                document.getElementById('data-exp').value = "07-07-2025";
            }
           
        });
        e. preventDefault();
   
    });

    //seguinte
    
    function getDadosBancarios(){

       
         
        var nomecompleto = $("#nomecompletobi").val();
        var numerobi = $("#numero-bilhete").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var datanascimento = $("#data-nascimento").val();
        var genero = $("#genero").val();
        var iban = $("#dob").val();

        // const dataActual = Date.now();
        // var dataValidade = new Date();
        // dataValidade.setDate(time.getDate() + 360); // Adiciona 3 dias           
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url:`https://api.gov.ao/consultarBI/v2/?bi=${numerobi}&fbclid=IwAR3SIXqTcobUuKufa6eBxh8gc1ySWGJAiPh1NqKzanykrewqeiww_pZGTso`,
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            async: false,
            success: function(dados) {

            
                document.getElementById('nometitular').value = nomecompleto;    
                document.getElementById('numero-bilhete-banco').value =numerobi;
                document.getElementById('email-banco').value =email;
                document.getElementById('telefone-banco').value =telefone;
                document.getElementById('data-nascimento-banco').value =datanascimento ;
                document.getElementById('genero-banco').value =genero;
                document.getElementById('iban').value =iban;
                document.getElementById('data-exp').value = "07-07-2025";
            }
           
        });
   }


      //proximo 2
      const proximo2 = document. querySelector("#proximo2")
    proximo2. addEventListener("click", function(e) {
    e. preventDefault();
   
    });

      //voltar1
      const voltar1 = document. querySelector("#voltar1")
    voltar1. addEventListener("click", function(e) {
    e. preventDefault();
   
    });
     //voltar2
     const voltar2 = document. querySelector("#voltar2")
    voltar2. addEventListener("click", function(e) {
    e. preventDefault();
   
    });

    //terminar
    // this is the id of the form
$("#form1").submit(function(e) {

e.preventDefault(); // avoid to execute the actual submit of the form.

var form = $(this);
var actionUrl = form.attr('action');

$.ajax({
    type: "POST",
    url: actionUrl,
    data: form.serialize(), // serializes the form's elements.
    success: function(data)
    {
      alert("Enviamos um email para si com o link de verificação"); // show response from the php script.

      // if (data) {
      //   window.location.replace("/");
      // }
      
    }
});

});
   
 </script>
@endsection

