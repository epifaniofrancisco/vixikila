
<div>
    <canvas id="myChart2" width="400px" height="400px"></canvas>
    </div>
    
<script>
    var colorArray = [
        '#FF6633', '#FFB399', '#FF33FF', '#FFFF99', 
        '#E6B333', '#3366E6', '#999966', '#00B3E6',
        '#99FF99', '#80B300', '#809900', '#E6B3B3',
        '#FF99E6', '#CCFF1A', '#FF1A66', '#33FFCC',
        '#66994D', '#B366CC', '#4D8000', '#CC80CC', 
        '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
        '#E666B3', '#33991A', '#CC9999', '#00E680', 
        '#4D8066', '#809980', '#E6FF80', '#6680B3',
        '#FF3380', '#66E64D', '#4D80CC', '#9900B3', 
        '#E64D66', '#4DB380', '#99E6E6', '#6666FF'];

    var ctx=document.getElementById("myChart2");
    var municipios = <?php echo $dados->municipios ?>;
    var militantes = <?php echo $dados->militantes ?>;

    var color = [];
    municipios.forEach(element => {
        color.push(colorArray[Math.floor(Math.random()*40)]);
    });
    var chart2=new Chart(ctx,{
        type: 'pie',
        data:{
            labels:municipios,
            datasets: [
                {
                    label: 'Militantes',
                    data:militantes,
                    backgroundColor:color,
                },
            ]
        },
        options: {
        plugins: {
            title: {
            display: true,
            text: 'Militantes por Municipio',
            color: '#fff'
            },
        },
        responsive: true,
        
        },
    });
</script>
