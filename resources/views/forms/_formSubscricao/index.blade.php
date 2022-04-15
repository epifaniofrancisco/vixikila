<div class="col-md-4">
    <div class="form-group">
        <label for="id_publicidade">{{ __('Publicidade') }}</label>
        <select class="form-control  js-example-basic-single @error('id_publicidade') is-invalid @enderror" name="id_publicidade"
            id="id_publicidade" required autocomplete="id_publicidade" autofocus>
            <option value="{{ isset($subscricao) ? $subscricao->id_publicidade : '' }}">
                {{ isset($subscricao) ? $subscricao->vc_publicidade : 'Selecionar a Publicidade' }}
            </option>

         
            @foreach ($publicidades as $publicidade)
                @if (isset($publicidadeSelecionado))
                    @if ($publicidadeSelecionado->id != $publicidade->id)
                        <option value="{{ $publicidade->id }}">{{ $publicidade->vc_nomePublicidade }}</option>
                    @endif
                @else
                    <option value="{{ $publicidade->id }}">{{ $publicidade->vc_nomePublicidade }}</option>
                @endif
            @endforeach
        </select>

        @error('id_usuario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="it_id_tipoPublicidade">{{ __('Tipo de publicidade:') }}</label>
        <select id="it_id_tipoPublicidade_subscricao"
            class="form-control @error('it_id_tipoPublicidade') is-invalid @enderror" name="it_id_tipoPublicidade"
            required autocomplete="it_id_tipoPublicidade" autofocus>
            {{ isset($subscricao) ? '' : '<option select >Seleciona o tipo de publicidade</option>' }}
            <option value="{{ isset($subscricao) ? $subscricao->it_id_tipoPublicidade : '0' }}" select>
                {{ isset($subscricao) ? $subscricao->vc_tipoPublicidade : 'Seleciona o tipo de publicidade' }}
            </option>

            @foreach ($tipos_publicidade as $tipo)

                <option value="{{ $tipo->id }}">{{ $tipo->vc_nome }}</option>


            @endforeach


        </select>


    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="id_superficie">{{ __('Superfície') }}</label>
        <select class="form-control  js-example-basic-single @error('id_superficie') is-invalid @enderror" name="id_superficie" id="id_superficie"
            required autocomplete="id_superficie" autofocus>
            @isset($subscricao)
                <option value="{{ $subscricao->id_superficie }}" select>
                    {{ $subscricao->vc_superficie }}
                </option>
            @endisset
            @isset($superficies)
                @foreach ($superficies as $superficie)

                    <option value="{{ $superficie->id }}">{{ $superficie->vc_nome }}</option>


                @endforeach
            @endisset

        </select>

        @error('id_usuario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="id_modalidades">{{ __('Modalidade de Pagamento') }}</label>
        <select class="form-control  js-example-basic-single @error('id_modalidades') is-invalid @enderror" name="id_modalidade"
            id="id_modalidade" required autocomplete="id_modalidade" autofocus>
            @isset($subscricao)
                <option value="{{ $subscricao->id_modalidade }}" select>
                    {{ $subscricao->vc_modalidade }}
                </option>
            @endisset
            @isset($modalidades)
                @foreach ($modalidades as $modalidade)

                    <option value="{{ $modalidade->id }}">{{ $modalidade->vc_nome }}</option>


                @endforeach
            @endisset
        </select>

        @error('id_usuario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="UCF">{{ __('UCF') }}</label>
        <input id="UCF" type="number" value="{{ isset($UcfLocalidadeValore) ? $UcfLocalidadeValore->fl_custo_ufc : '0' }}"
            class="form-control " name="UCF" placeholder="Valor da UCF" required readonly onkeyup="calcular()">
            

    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label for="id_estabelecimento">{{ __('Estabelecimento') }}</label>
        <select class="form-control  js-example-basic-single @error('id_estabelecimento') is-invalid @enderror" name="id_estabelecimento"
            required autocomplete="id_estabelecimento" autofocus id="id_estabelecimento">
            <option value="{{ isset($subscricao) ? $subscricao->id_estabelecimento : '0' }}">
                {{ isset($subscricao) ? $subscricao->nome_estabelecimento : 'Selecionar o Estabelecimento' }}
            </option>
            @foreach ($estabelecimentos as $estabelecimento)
                @if (isset($estabelecimentoSelecionado))
                    @if ($estabelecimentoSelecionado->id != $estabelecimento->id)
                        <option value="{{ $estabelecimento->id }}">{{ $estabelecimento->nome }}</option>
                    @endif
                @else
                    <option value="{{ $estabelecimento->id }}">{{ $estabelecimento->nome }}</option>
                @endif
            @endforeach
        </select>

        @error('id_estabelecimento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="cliente">{{ __('Cliente') }}</label>
        <select class="form-control" name="id_cliente" id="id_cliente" required autofocus readonly>
            <option value="{{ isset($subscricao) ? $subscricao->id_usuario : '0' }}">
                {{ isset($subscricao) ? $subscricao->name : 'Selecionar o Estabelecimento' }}
            </option>

        </select>

    </div>
</div>

{{-- @if (Auth::user()->vc_perfil != 'Cliente')
<div class="col-md-4">
    <div class="form-group">
        <label for="id_user">{{ __('Usuario') }}</label>
        <select class="form-control  js-example-basic-single @error('id_user') is-invalid @enderror" name="id_user" required
            autocomplete="id_user" autofocus>
            @if (Auth::User()->vc_perfil == 'Cliente')
                <option value="{{ Auth::User()->id }}">{{ Auth::User()->name }}</option>
            @else
                <option  value="{{ isset($userSelecionado) ? $userSelecionado->id : '' }}">
                    {{ isset($userSelecionado) ? $userSelecionado->name : 'Selecionar a user' }}</option>
                @foreach ($users as $user)
                    @if (isset($userSelecionado))
                        @if ($userSelecionado->id != $user->id)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @else
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endif
                @endforeach
            @endif

        </select>

        @error('id_user')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@endif --}}

<div class="col-md-4">
    <div class="form-group">
        <label for="localidade">{{ __('Localidade (UCF)') }}</label>
        <input id="localidade" type="text" class="form-control @error('localidade') is-invalid @enderror"
            name="localidade" placeholder="Localidade"
            value="{{ isset($ufLocalidade) ? $ufLocalidade->vc_nome : '' }}" required readonly
            autocomplete="localidade">

    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="comprimento">{{ __('Comprimento (Em Metros)') }}</label>
        <input id="comprimento" type="number" min="0" max="100"
            value="{{ isset($subscricao->fl_comprimento) ? $subscricao->fl_comprimento : '' }}"
            class="form-control @error('comprimento') is-invalid @enderror" name="fl_comprimento"
            placeholder="Comprimento" required autocomplete="comprimento" onkeyup="calcular()" step="0.01">

    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="largura">{{ __('Largura (Em Metros)') }}</label>
        <input id="largura" type="number" min="0" max="100"
            value="{{ isset($subscricao->fl_largura) ? $subscricao->fl_largura : '' }}"
            class="form-control @error('largura') is-invalid @enderror" name="fl_largura" placeholder="Largura" required
            autocomplete="largura" onkeyup="calcular()" step="0.01">

    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="fl_precoSubscricao">{{ __('Preço') }}</label>
        <input id="fl_precoSubscricao" type="number"
            value="{{ isset($subscricao->fl_precoSubscricao) ? $subscricao->fl_precoSubscricao : '' }}"
            class="form-control @error('fl_precoSubscricao') is-invalid @enderror" name="fl_precoSubscricao"
            placeholder="Preco" required autocomplete="fl_precoSubscricao" readonly>

    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="id_tipo_qr">{{ __('Código QR') }}</label>
        <select class="form-control  js-example-basic-single @error('id_tipo_qr') is-invalid @enderror" name="id_tipo_qr" id="id_tipo_qr"
            required autocomplete="id_tipo_qr" autofocus>
            <option value="{{ isset($subscricao) ? $subscricao->id_tipo_qr : '' }}">
                {{ isset($subscricao) ? $subscricao->vc_tipo : 'Selecionar a tipo_qr' }}
            </option>

            @foreach ($tipo_qrs as $tipo_qr)


                <option value="{{ $tipo_qr->id }}">{{ $tipo_qr->vc_tipo }}</option>

            @endforeach
        </select>

        @error('id_usuario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="col-md-4">
    <div class="form-group">
        <label for="vc_alcool">{{ __('Álcool') }}</label>
        <select class="form-control   @error('vc_alcool') is-invalid @enderror" name="vc_alcool" required id="vc_alcool">

            <option value="{{ isset($subscricao) ? $subscricao->vc_alcool : '0' }}" select>
                {{ isset($subscricao) ? ($subscricao->vc_alcool == 'N' ? 'Não' : 'Sim') : 'Seleciona uma opção' }}
            </option>
            <option value="S">Sim</option>

            <option value="N">Não</option>


        </select>
    </div>

</div>

<div class="col-md-4">
    <div class="form-group" id="div_matricula">
        <label for="vc_matricula">{{ __('Matricula') }}</label>
        <input value="{{ isset($subscricao->vc_matricula) ? $subscricao->vc_matricula : '' }}" id="vc_matricula"
            type="text" class="form-control @error('vc_matricula') is-invalid @enderror" name="vc_matricula"
            placeholder="Matricula" autocomplete="vc_matricula">

    </div>
</div>

<div class="col-md-4">
    <div class="form-group" id="it_croqui"    style="display: {{$dis}};">
        <label for="">{{ __('Possui um croquí de localização?') }}</label><br>

        <!-- Default inline 1-->
        <div class="custom-control custom-radio custom-control-inline">
            <input value="0" type="radio" class="custom-control-input" id="c1" name="it_croqui" {{(isset($subscricao->it_croqui) && ($subscricao->it_croqui == 0))?'checked':''}}>
            <label class="custom-control-label" for="c1">Não</label>
        </div>

         <!-- Default inline 2-->
         <div class="custom-control custom-radio custom-control-inline">
            <input value="1" type="radio" class="custom-control-input" id="c2" name="it_croqui"  {{(isset($subscricao->it_croqui) && ($subscricao->it_croqui == 1))?'checked':''}}>
            <label class="custom-control-label" for="c2">Sim</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
            <input value="2" type="radio" class="custom-control-input" id="c3" name="it_croqui"  {{(isset($subscricao->it_croqui) && ($subscricao->it_croqui == 2))?'checked':''}}>
            <label class="custom-control-label" for="c3">Outro</label>
        </div>




    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="dt_pagamento">{{ __('Data de pagamento:') }}</label>
        <input value="{{ isset($publicidade->dt_pagamento) ? $publicidade->dt_pagamento : '' }}" id="dt_pagamento"
            type="date" class="form-control " name="dt_pagamento"
            >

    </div>
</div>
<div class="col-md-12">
    <div class="form-group text-center mx-auto col-md-3">
        <label class="text-white">lorem</label>
        <button type="submit" class="btn col-md-12 btn-danger">
            Salvar
        </button>

    </div>
</div>

<script>
    // function publicidadeSelecionada() {
    //     let publicidade = document.getElementById('id_publicidade').value;
    //     if(publicidade == '') {
    //         return 0;
    //     }
    //     let dados =publicidades.find((item)=>item.id == publicidade);
    //     let total = dados.fl_comprimento * dados.fl_largura;
    //     return total;
    // }

    // function modalidadeSelecionada() {
    //     let modalidade = document.getElementById('id_modalidade').value;
    //     if(modalidade == '') {
    //         return 0;
    //     }
    //     let dados =modalidades.find((item)=>item.id == modalidade);
    //     // console.log(dados);
    //     let total = dados.it_multiplo * 88;
    //     return total;
    // }

    // function calcular() {
    //     let total = publicidadeSelecionada() * modalidadeSelecionada();
    //     let preco = document.getElementById('fl_precoSubscricao');
    //     preco.value = total;

    // }

    function calcular() {
        let UCF = Math.abs(document.getElementById('UCF').value);
        let comprimento = Math.abs(document.getElementById('comprimento').value);
        let largura = Math.abs(document.getElementById('largura').value);
        var tipo_publicidade = $("#it_id_tipoPublicidade_subscricao option:selected").text();
        let total = 0;
                if (UCF == '' || comprimento == '' || largura == '') {
                    return 0;
                }


                if (tipo_publicidade == "Publicidade Sonora") {
                     total = (UCF * 88);
                }else{ 
                     total = (UCF * 88) * (comprimento * largura);
                }

        let preco = document.getElementById('fl_precoSubscricao');
        console.log(preco);
        preco.value = total.toFixed(2);
    }
</script>





{{-- 
<script>
    $('#it_id_tipoPublicidade_subscricao').change(function() {



        var id = $(this).val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getSuperficies/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(superficies) {

                // response.forEach(element => {
                //     console.log
                // });


                console.log(superficies);
                $("#id_superficie").empty();
                $("#id_superficie").append('<option select  "> Seleciona a superfície</option>');
                $.each(superficies, function(id, vc_nome) {
                    $("#id_superficie").append('<option value="' + id + '">' + vc_nome +
                        '</option>');
                });




            }
        });




    });

    $('#id_superficie').change(function() {



        var id = $(this).val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getModalidades/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(modalidades) {

                // response.forEach(element => {
                //     console.log
                // });



                $("#id_modalidade").empty();
                $("#UCF").val(0);
                $("#id_modalidade").append('<option select  "> Seleciona a modalidade</option>');
                $.each(modalidades, function(id, vc_nome) {
                    $("#id_modalidade").append('<option value="' + id + '">' + vc_nome +
                        '</option>');
                });





            }
        });




    });


    $('#id_modalidade').change(function() {



        var id = $(this).val();
        var id_supeficie = $('#id_superficie').val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getUCF/' + id + '/' + id_supeficie,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(UCF_localidade) {

                $.each(UCF_localidade, function(localidade, ucf) {

                    $("#UCF").val(ucf);
                    //
                    $("#localidade").val(localidade);
                });








            }
        });




    });

    $('#id_estabelecimento').change(function() {

        console.log("oa");

        var id = $(this).val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getCliente/' + id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(cliente) {
                $("#id_cliente").append('<option  select > Usuário</option>');
                $("#id_cliente").empty();


                $.each(cliente, function(id, name) {
                    $("#id_cliente").append('<option  value="' + id + '">' + name +
                        '</option>');
                });

            }
        });




    });
    $('#id_tipo_qr').change(function() {


        var id = $(this).val();
        if (id == 2) {
            $('#div_matricula').show();

        } else {

            $('#div_matricula').hide();
        }



    });

    var id = $('#id_tipo_qr').val();
    if (id == 2) {
        $('#div_matricula').show();

    } else {
        $('#div_matricula').val("");
        $('#div_matricula').hide();
    }




    $('#id_publicidade').change(function() {



        var id = $(this).val();
        var id_publicidade = $('#id_publicidade').val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getEstabelecimento/' + id_publicidade,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(estabelecimento) {
                console.log(estabelecimento);
                // $.each(UCF_localidade, function(localidade, ucf) {

                //     $("#UCF").val(ucf);
                //     //
                //     $("#localidade").val(localidade);
                // });








            }
        });




    });
</script> --}}
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

// $('#fl_precoSubscricao').change(function(){
// var valor= $('#vc_alcool').val();
// if(valor=='S'){
//     var novoPreco=$('#fl_precoSubscricao').val()*2;
//     $('#fl_precoSubscricao').val(novoPreco);
// }
    
// });
</script>
