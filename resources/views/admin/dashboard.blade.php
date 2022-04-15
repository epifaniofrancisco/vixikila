@extends('layouts.merge.painel')
@section('titulo', 'Painel')
@section('conteudo')

<div class="col-md-12">
        <div>
            <h2>Zenga</h2>
        </div>
    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-3 shadow-sm mx-auto card animate__animated animate__fadeIn" style="border-bottom:3px solid #175B99">

                <div class="p-2">

                    <h5 class="">Estabelecimentos</h5>
                    <hr>
                    <div >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total   </h4>
                                </div>
                                <div class="col-md-6 ">
                                   <h4 class="text-center">{{$estabelecimentos}}</h4>
                                </div>
                            </div>
                        </div>
                </div>
                </div>

            </div>

            <div class="col-md-3 shadow-sm mx-auto card animate__animated animate__fadeIn" style="border-bottom:3px solid #E5BF0B">

                <div class="p-2">

                    <h5 class="">Publicidades</h5>
                    <hr>
                    <div >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total   </h4>
                                </div>
                                <div class="col-md-6 ">
                                   <h4 class="text-center">{{$publicidades}}</h4>
                                </div>
                            </div>
                        </div>
                </div>
                </div>

            </div>
            <div class="col-md-3 shadow-sm mx-auto card animate__animated animate__fadeIn" style="border-bottom:3px solid #992C26">

                <div class="p-2">

                    <h5 class="">Multa</h5>
                    <hr>
                    <div >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total   </h4>
                                </div>
                                <div class="col-md-6 ">
                                   <h4 class="text-center">{{$multas}}</h4>
                                </div>
                            </div>
                        </div>
                </div>
                </div>

            </div>

            <div class="col-md-3 shadow-sm mx-auto card animate__animated animate__fadeIn" style="border-bottom:3px solid #2E990F">

                <div class="p-2">

                    <h5 class="">Subscrição</h5>
                    <hr>
                    <div >
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Total   </h4>
                                </div>
                                <div class="col-md-6 ">
                                   <h4 class="text-center">{{$subscricao}}</h4>
                                </div>
                            </div>
                        </div>
                </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
     <div class="row">
        <div class="col-md-6">
            <canvas id="chart1" width="10" height="10"></canvas>

        </div>
        <div class="col-md-6">
            <canvas id="chart2" width="10" height="10"></canvas>

        </div>
     </div>

     <div class="row">
        <div class="col-md-6">
            <canvas id="chart3" width="10" height="10"></canvas>

        </div>
        <div class="col-md-6">
            <canvas id="chart4" width="10" height="10"></canvas>

        </div>
     </div>

    </div>










    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>


    <script>
        var ctx = document.getElementById('chart1');
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Multas','Estabelecimentos',  'Publicidades', 'Subscrição' ,'Usuarios', 'Cancelamentos'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{$multas}}, {{$estabelecimentos}}, {{$publicidades}}, {{$subscricao}}, {{$usuarios}}, {{$cancelamentos}}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


<script>
    var ctx = document.getElementById('chart2');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Multas','Estabelecimentos',  'Publicidades', 'Subscrição' ,'Usuarios', 'Cancelamentos'],
            datasets: [{
                label: '# of Votes',
                data: [{{$multas}}, {{$estabelecimentos}}, {{$publicidades}}, {{$subscricao}}, {{$usuarios}}, {{$cancelamentos}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('chart3');
    var myChart = new Chart(ctx, {
        type: 'bubble',
        data: {
            labels: ['Multas','Estabelecimentos',  'Publicidades', 'Subscrição' ,'Usuarios', 'Cancelamentos'],
            datasets: [{
                label: '# of Votes',
                data: [{{$multas}}, {{$estabelecimentos}}, {{$publicidades}}, {{$subscricao}}, {{$usuarios}}, {{$cancelamentos}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<script>
    var ctx = document.getElementById('chart4');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Multas','Estabelecimentos',  'Publicidades', 'Subscrição' ,'Usuarios', 'Cancelamentos'],
            datasets: [{
                label: '# of Votes',
                data: [{{$multas}}, {{$estabelecimentos}}, {{$publicidades}}, {{$subscricao}}, {{$usuarios}}, {{$cancelamentos}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
</div>




@endsection

{{-- @extends('layouts._includes.Footer') --}}
