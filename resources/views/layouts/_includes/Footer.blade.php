</div> <!-- .wrapper -->

<script type="text/javascript" src="{{ asset('/js/translator.js') }}"></script>
<!-- Google translator -->
<script src="{{ asset('/dashboard/js/jquery.min.js') }}"></script>
<script src="{{asset('/dashboard/js/sweetalert2.all.min.js')}}"></script>
<script src="{{ asset('/dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/moment.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/daterangepicker.js') }}"></script>
<script src="{{ asset('/dashboard/js/simplebar.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/tinycolor-min.js') }}"></script>

<script src="{{ asset('/dashboard/js/topojson.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/datamaps.all.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/datamaps-zoomto.js') }}"></script>
<script src="{{ asset('/dashboard/js/datamaps.custom.js') }}"></script>
<script src="{{ asset('/dashboard/js/Chart.min.js') }}"></script>

<script src="{{ asset('/dashboard/js/jquery.stickOnScroll.js') }}"></script>
<script src="{{ asset('/dashboard/js/config.js') }}"></script>
<script src="{{ asset('/dashboard/js/d3.min.js') }}"></script>


<script>
    /* defind global options */
    Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
    Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>


<script src="{{ asset('/dashboard/js/gauge.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/apexcharts.custom.js') }}"></script>

<script src="{{ asset('/dashboard/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/select2.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/jquery.timepicker.js') }}"></script>

<script src="{{ asset('/dashboard/js/dropzone.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/uppy.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/quill.min.js') }}"></script>

<script src="{{ asset('/dashboard/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/dashboard/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
    $('#dataTable-1').DataTable({
        autoWidth: true,
        "lengthMenu": [
            [16, 32, 64, -1],
            [16, 32, 64, "All"]
        ]
    });
    $('#dataTable-2').DataTable({
        autoWidth: true,
        "lengthMenu": [
            [16, 32, 64, -1],
            [16, 32, 64, "All"]
        ]
    });
</script>

<script>
    $('.select2').select2({
        theme: 'bootstrap4',
    });
    $('.select2-multi').select2({
        multiple: true,
        theme: 'bootstrap4',
    });
    $('.drgpicker').daterangepicker({
        singleDatePicker: true,
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'MM/DD/YYYY'
        }
    });
    $('.time-input').timepicker({
        'scrollDefault': 'now',
        'zindex': '9999' /* fix modal open */
    });
    /** date range picker */
    if ($('.datetimes').length) {
        $('.datetimes').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });
    }
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                'month')]
        }
    }, cb);
    cb(start, end);
    $('.input-placeholder').mask("00/00/0000", {
        placeholder: "__/__/____"
    });
    $('.input-zip').mask('00000-000', {
        placeholder: "____-___"
    });
    $('.input-money').mask("#.##0,00", {
        reverse: true
    });
    $('.input-phoneus').mask('(000) 000-0000');
    $('.input-mixed').mask('AAA 000-S0S');
    $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
        translation: {
            'Z': {
                pattern: /[0-9]/,
                optional: true
            }
        },
        placeholder: "___.___.___.___"
    });
    // editor
    var editor = document.getElementById('editor');
    if (editor) {
        var toolbarOptions = [
            [{
                'font': []
            }],
            [{
                'header': [1, 2, 3, 4, 5, 6, false]
            }],
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{
                    'header': 1
                },
                {
                    'header': 2
                }
            ],
            [{
                    'list': 'ordered'
                },
                {
                    'list': 'bullet'
                }
            ],
            [{
                    'script': 'sub'
                },
                {
                    'script': 'super'
                }
            ],
            [{
                    'indent': '-1'
                },
                {
                    'indent': '+1'
                }
            ], // outdent/indent
            [{
                'direction': 'rtl'
            }], // text direction
            [{
                    'color': []
                },
                {
                    'background': []
                }
            ], // dropdown with defaults from theme
            [{
                'align': []
            }],
            ['clean'] // remove formatting button
        ];
        var quill = new Quill(editor, {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
    }
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


<script>
    function mudarCor(novaCor) {
        var elemento = document.getElementById("scroller");
        elemento.style.overflow = "hidden !important";
    }
</script>

<style>
    /* style a mexer */
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 35px;
        user-select: none;
        -webkit-user-select: none;

    }

</style>

<script type="text/javascript">
    $('.buscarEscola').select2({
        placeholder: 'Selecionar Escola',
        ajax: {
            url: '/buscar/escolas',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                console.log('aqui', data)

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.vc_escola,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('.buscarClasse').select2({
        placeholder: 'Selecionar a classe',
        ajax: {
            url: '/buscar/classes',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                console.log('aqui', data)

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.vc_classe,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });



    $('.buscarAnoLetivo').select2({
        placeholder: 'Selecionar o ano lectivo',
        ajax: {
            url: '/buscar/anoletivo',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                console.log('aqui', data)

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.ya_inicio + '-' + item.ya_fim,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });



    $('.buscarDiasSemana').select2({
        placeholder: 'Selecionar o dia da semana',
        ajax: {
            url: '/buscar/diasSemana',
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                console.log('aqui', data)

                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.vc_dia,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>

<script>
    $("#img-input").click(function() {
        $("#image_visible").hide();
    });
</script>

<script>
    function readImage() {
        if (this.files && this.files[0]) {
            var file = new FileReader();
            file.onload = function(e) {
                document.getElementById("preview").src = e.target.result;
            };
            file.readAsDataURL(this.files[0]);
        }
    }

    document.getElementById("img-input").addEventListener("change", readImage, false);
</script>
<script src="{{ asset('/dashboard/js/apps.js') }}"></script>


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
        var tipo_publicidade = $("#it_id_tipoPublicidade_subscricao option:selected").text();
        
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



                


                let UCF = Math.abs(document.getElementById('UCF').value);
                let comprimento = Math.abs(document.getElementById('comprimento').value);
                let largura = Math.abs(document.getElementById('largura').value);
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
                preco.value = total.toFixed(2);



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
                    $("#comprimento").append('<option  value="' + id + '">' + name +
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

        
        var id_publicidade = $('#id_publicidade').val();
        var it_id_tipoPublicidade_subscricao = $('#it_id_tipoPublicidade_subscricao').val();
        var id_supeficie = $('#id_superficie').val();
        var id_modalidade = $('#id_modalidade').val();
        var id_estabelecimento = $('#id_estabelecimento').val();
        var id_tipo_qr = $(this).val();
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/getCroqui/' + id_publicidade+'/'+it_id_tipoPublicidade_subscricao+'/'+id_supeficie+'/'+id_modalidade+'/'+id_estabelecimento+'/'+id_tipo_qr,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            async: false,
            success: function(existe) {


              

            if (existe == false) {

                
                 $('#it_croqui').show();

                 let c1 = document.getElementById('c1');
                 c1.setAttribute("checked", "checked");
                 

            } else {

               
                $('#it_croqui').hide();
            }

            }
        });



    });

    var id = $('#id_tipo_qr').val();
    if (id == 2) {
        $('#div_matricula').show();

    } else {
        $('#div_matricula').val("");
        $('#div_matricula').hide();
    }




    $('#id_publicidade').change(function() {



        vaid = $(this).val();
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
                $("#id_estabelecimento").empty();
                $("#id_cliente").empty();

                $("#vc_alcool").empty();
                console.log(estabelecimento.id);
                $('#id_estabelecimento')
                    .append('<option  value="' + estabelecimento.id + '">' + estabelecimento.nome +
                        '</option>');


                $("#comprimento").val(estabelecimento.fl_comprimento);
                $("#largura").val(estabelecimento.fl_largura);
                $("#id_cliente").append('<option  value="' + estabelecimento.id_usuario + '">' +
                    estabelecimento.name +
                    '</option>');
                var s = estabelecimento.vc_alcool == 'S' ? 'Sim' : 'Não';
                $("#vc_alcool").append('<option  value="' + estabelecimento.vc_alcool + '">' + s +
                    '</option>');
            

            }
        });




    });
</script>

</body>

</html>
