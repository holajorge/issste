<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	<link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/bootstrap.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/jquery.min.js"></script>
	 
</head>
<body>


 <div class="container-fluid">
  

  <canvas id="myChart" width="400" height="150"></canvas>
</div>
	<script>
 
 $(document).ready(function() {

    var clasificaciones = [];
	var fechas = []; 
	// var rojo = "ROJO";
	// var amarillo = "mayo";
	// var verde = "julio";

	$.post("<?php echo base_url();?>admin/get_clasificacion",
   
		function(data){
			
			var obj = JSON.parse(data);
			alert(obj);

			$.each(obj, function(item){				

				clasificaciones.push(item.clasificacion);
			});

			var ctx = $("#myChart");
			
			var myChart = new Chart(ctx, {
			    
			    type: 'bar',
			    data: {
			    	 labels: clasificaciones, //horizontal
			    	datasets: [
			        	{
				            label: "ROJOS",
				            fill: true,
				            lineTension: 0.1,
				            backgroundColor: "rgba(255, 0, 0, 0.8)",
				            borderColor: "rgba(75,192,192,1)",
				            borderCapStyle: 'butt',
				            borderDash: [],
				            borderDashOffset: 0.0,
				            borderJoinStyle: 'miter',
				            pointBorderColor: "rgba(75,192,192,1)",
				            pointBackgroundColor: "#F8061A",
				            pointBorderWidth: 10,
				            pointHoverRadius: 5,
				            pointHoverBackgroundColor: "rgba(248,6,26)",
				            pointHoverBorderColor: "rgba(220,220,220,1)",
				            pointHoverBorderWidth: 5,
				            pointRadius: 1,
				            pointHitRadius: 10,
				            data: clasificaciones, //paramValores,//vertical
				            spanGaps: false
				        }]				    			    	
				},
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero:true
			                }
			            }]
			        }
			    }
			});
		});
	});

			
	</script>


</body>
</html>