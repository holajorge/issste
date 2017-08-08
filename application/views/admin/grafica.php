<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin | TRIAGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="<?php echo base_url();?>plantillas/img/logo.jpg"/>
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/admin.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/bootstrap.css"/>
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/css/sweetalert.css"/>
 <style>
  .container-fluid {
    margin-left: 100px;
    margin-right: 100px;
   }
  </style> 
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/admin.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/adminEnfermero.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/adminConsultorio.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/sweetalert.min.js"></script> 
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/jquery.min.js"></script>
 <script src="https://code.highcharts.com/highcharts.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/sand-signika.js"></script>
 <script src="https://code.highcharts.com/modules/exporting.js"></script>
 </head>
<body>

 <div class="cabeza">
  <div class="row">
    <div class="col-xs-12 col-sm-3 logo">
    </div>
    <div class="col-xs-12 col-sm-6">
      <h1 class="text-center">PANEL DEL ADMINISTRADOR</h1>
    </div>
    <div class="hidden-xs col-sm-3 logo">
    </div>
  </div>
</div>
 <nav class="navbar navbar-inverse container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand pantalla" href="javascript: abrirPantalla()">SUDH</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ALTAS<span class="caret"></span></a>
        <ul class="dropdown-menu">
         <li><a href="<?php echo base_url();?>admin/doctor">DOCTOR</a></li>
         <li><a href="<?php echo base_url();?>admin/urgenciologo">URGENCIOLOGO</a></li>
         <li><a href="<?php echo base_url();?>admin/enfermero">ENFERMERO</a></li>
         <li><a href="<?php echo base_url();?>admin/Consultorio">CONSULTORIO</a></li>
         <li><a href="<?php echo base_url();?>admin/videos">VIDEOS</a></li>
       </ul>
     </li>     

     <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REPORTES <span class="caret"></span></a>
      <ul class="dropdown-menu">
       <li><a class="btn " data-toggle="modal" data-target="#myModal">REPORTES POR DOCTOR</a></li>
       <li><a class="btn " data-toggle="modal" data-target="#myModalD">REPORTES POR RANGO</a></li>
       <li><a class="btn " data-toggle="modal" data-target="#myModalDFalta">REPORTES DE FALTANTES</a></li>
      </ul>    
     </li>
     <li><a href="<?php echo base_url();?>admin/espera">EN ESPERA</a></li>
     <li><a href="<?php echo base_url();?>admin/enconsultorio">EN CONSULTA</a></li>
     <li><a href="<?php echo base_url();?>admin/no_asistio">NO ASISTIO</a></li>
     <li ><a href="<?php echo base_url();?>admin/eliminar">ELIMINAR DERECHOHABIENTE</a></li>
     <li class="active"><a href="<?php echo base_url();?>admin/grafica">GRAFICA</a></li>
   </ul>
   <ul class="nav navbar-nav navbar-right">
     <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo " ".$nombre." ".$apellido; ?></a></li>
     <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
   </ul>
</nav>

  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/bootstrap.min.js"></script>
  <script>

  function checarAA(year)
    {
      year.value=Solo_NumericoYear(year.value);
    }  

  function Solo_NumericoYear(variable){
        Numer=variable;
        if (Numer.length==4) {
          $("#btn_graficarAyear").focus();
          return Numer;
        }
        if(Numer.length>4){         
          return "";
        }
        if(isNaN(Numer)){
            return "";
        }
        return Numer;
    }


  function checar(dato)
    {
      dato.value=Solo_Numerico(dato.value);
    }  
   
  function Solo_Numerico(variable)
    {
        Numer=variable;
        if (Numer.length==2) {
          $("#year").focus();
          return Numer;
        }
        if(Numer.length>2){         
          return "";
        }
        if(isNaN(Numer)){
           
            return "";
        }        
            return Numer;        
    }

  function checarA(dato)
    {
      dato.value=Solo_NumericoA(dato.value);
    }  
   function Solo_NumericoA(variable){
        Numer=variable;
        if (Numer.length==4) {
          $("#btn_graficar").focus();
          return Numer;
        }
        if(Numer.length>4){         
          return "";
        }
        if(isNaN(Numer)){
            return "";
        }
        return Numer;
    }

  function graficar_MA()
    {

      var mess = document.getElementById("mes").value;

      if (mess === "") {
        swal({
              title: "NECESARIO EL DATO DEL MES!",              
              timer: 2000,
              showConfirmButton: false
            });
        return false;
      }
      var yea = document.getElementById("year").value;

      if (yea === "") {
        swal({
              title: "NECESARIO EL DATO DEL AÑO!",              
              timer: 2000,
              showConfirmButton: false
            });
        return false;
      }

      var y  = $("#year").val();
      var m = $("#mes").val();

      var texto = "ESTADISTIAS POR FECHAS DE:";

      var todo = String(texto+" "+m+"-"+y);

      console.log(todo);

          $.ajax({
           type: "POST",
           url: base_url()+"admin/get_estadisticas",
           data: $("#from_grafica").serialize(),
           success: function(respuesta) 
           {
             var verdin;
             var rojin;
             var amarillin;   

             var ver = [];
             var ama = [];
             var llora = [];

            console.log(respuesta);

             var datos = JSON.parse(respuesta);

            console.log(datos[0]); 

            var verde = datos[0];
            var amarillo = datos[1];
            var rojo = datos[2];

            console.log(verde); 

            $.each(verde, function(clave, valor){

                  verdin = Number(valor);
                   console.log(verdin); 
                });
           $.each(amarillo, function(clave2, valor2){

                  amarillin = Number(valor2);
                   console.log(amarillin); 
               });
           $.each(rojo, function(clave3, valor3){

                  rojin = Number(valor3);
                   console.log(valor3); 
               });

           var chart1 = new Highcharts.Chart({

                    chart: {
                       plotBackgroundColor: null,
                       plotBorderWidth: null,
                       plotShadow: false,
                       renderTo: 'graficoFechas',
                       type: 'pie',
                       borderWidth: 2,
                       spacingRight: 20
                    },
                     title: {
                       text: todo,
                       // m,
                       // y                     
                    },
                    tooltip: {                           
                             headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                             pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                    },     
                    plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              dataLabels: {
                                  enabled: true,
                                  format: '{point.y:.1f}%'
                              },
                              showInLegend: true
                          }
                      },                  
                    series:  [{
                          name: 'PORSENTAJE',
                          colorByPoint: true,
                          data: [{
                              name: 'VERDES',
                              y: verdin ,         
                          }, {
                              name: 'AMARILLOS',
                              y: amarillin,                
                          }, {
                              name: 'ROJOS',
                              y: rojin,                
                              sliced: true,
                              selected: true                              
                          }]
                     }]                  
                });
             //abajo1                      
            }
        });  
                               
      }

  function searchYear(){

    $.ajax({
     type: "POST",
     url: base_url()+"admin/searchMeYear",
           data: $("#from_graficaYear").serialize(), // serializes the form's elements.,
           success: function(respuesta) 
           {
             if(respuesta==5)
             {
              swal("Error!", "AÑO NO TIENE DATOS", "error");
              $('#from_graficaYear')[0].reset();
            }

          }
        }) 



    }


  function graficarForYear()
    {
      
      var yea = document.getElementById("yearr").value;

      if (yea === "") {
        swal({
              title: "NECESARIO EL DATO DEL AÑO!",              
              timer: 2000,
              showConfirmButton: false
            });
        return false;
      }

      var y  = $("#yearr").val();
    
      var texto = "ESTADISTIAS DEL AÑO DE:";

      var todo = String(texto+" "+y);

      console.log(todo);

          $.ajax({
           type: "POST",
           url: base_url()+"admin/getEstadisticsForYear",
           data: $("#from_graficaYear").serialize(),
           success: function(respuesta) 
           {

             var verdin;
             var rojin;
             var amarillin;   

             var ver = [];
             var ama = [];
             var llora = [];

            console.log(respuesta);

             var datos = JSON.parse(respuesta);

            console.log(datos[0]); 

            var verde = datos[0];
            var amarillo = datos[1];
            var rojo = datos[2];

            console.log(verde); 

            $.each(verde, function(clave, valor){

                  verdin = Number(valor);
                   console.log(verdin); 
                });
           $.each(amarillo, function(clave2, valor2){

                  amarillin = Number(valor2);
                   console.log(amarillin); 
               });
           $.each(rojo, function(clave3, valor3){

                  rojin = Number(valor3);
                   console.log(valor3); 
               });

           var chart1 = new Highcharts.Chart({

                    chart: {
                       plotBackgroundColor: null,
                       plotBorderWidth: null,
                       plotShadow: false,
                       renderTo: 'graficoFechas',
                       type: 'pie',
                       borderWidth: 2,
                       spacingRight: 20
                    },
                     title: {
                       text: todo,
                       // m,
                       // y                     
                    },
                    tooltip: {                           
                             headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                             pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                    },     
                    plotOptions: {
                          pie: {
                              allowPointSelect: true,
                              cursor: 'pointer',
                              dataLabels: {
                                  enabled: true,
                                  format: '{point.y:.1f}%'
                              },
                              showInLegend: true
                          }
                      },                  
                    series:  [{
                          name: 'PORSENTAJE',
                          colorByPoint: true,
                          data: [{
                              name: 'VERDES',
                              y: verdin ,         
                          }, {
                              name: 'AMARILLOS',
                              y: amarillin,                
                          }, {
                              name: 'ROJOS',
                              y: rojin,                
                              sliced: true,
                              selected: true
                              
                          }]

                        }]                  
                });
             //abajo1                               
          }
        });  
                               
      }

  $(document).ready(function(){

   var chart1 = new Highcharts.Chart({
      chart: {
         plotBackgroundColor: null,
         plotBorderWidth: null,
         plotShadow: false,
         renderTo: 'contenedor_grafico',
         type: 'pie',
         borderWidth: 2,
         spacingRight: 20
      },
       title: {
        text: 'ESTADISTICAS DEL MES ACTUAL <?php  echo $month = date("m-Y");?>'
      },
      tooltip: {
             
               headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
               pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },     
      plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                },
                showInLegend: true
            }
        },
    
      series:  [{
            name: 'PORSENTAJE',
            colorByPoint: true,
            data: [{
                name: 'VERDES',
                y:  <?php foreach($verde->result() as $punto){ echo $punto->resultado;}?>,         
            }, {
                name: 'AMARILLOS',
                y: <?php foreach($amarillo->result() as $punto){ echo $punto->resultado;}?>,                
            }, {
                name: 'ROJOS',
                y: <?php foreach($rojo->result() as $punto){ echo $punto->resultado;}?>,                
                sliced: true,
                selected: true
            }]
          }]
    });

// metodo para mostrar y oculpar los formularios
     $("select").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("id")=="select1"){
                $(".box").not(".select1").hide();
                $(".select1").show();
            }
            else if($(this).attr("id")=="select2"){
                $(".box").not(".select2").hide();
                $(".select2").show();
            }
            else if($(this).attr("id")=="select3"){
                $(".box").not(".select3").hide();
                $(".select3").show();
            }

            else{
                $(".box").hide();
            }
        });
        }).change();
      });
     
  </script>

<div class="container-fluid">
  <div class="row">
   <div class="form-group" >
    <div class="row">
    <div class="col-sm-4">
      <select class="form-control" id="sel1" >
        <option>SELECCIONE OPCIÓN PARA GRAFICAR</option> 
        <option id="select1">POR AÑO</option>
        <option id="select2">POR MES Y AÑO</option>        
      </select>
    </div>
    </div>
   </div>

  <div class="form-group" >
   <div class="row">
    <div class="col-sm-8 select1 box">
    <form action="" id="from_graficaYear" name="nombre_form" class="form-horizontal">
      <label for="">INGRESE AÑO </label>
      <div class="form-group ">
        <div class="col-sm-4">     
          <input type="text" id="yearr" name="year"  class="form-control col-sm-2" placeholder="AÑO" onkeyUp="return checarAA(this);" onblur="searchYear()">
        </div>
        <div class="col-sm-2">
          <button  type="button" id="btn_graficarAyear" class="btn btn-primary" value="GRAFICAR" onclick="graficarForYear()">GRAFICAR</button>
        </div>
        <label id="te"></label>
      </div> 
     </form>
    </div>
   </div>
  </div>

   <div class="form-group" >
    <div class="row">
    <div class="col-sm-8 select2 box">
  	<form action="" id="from_grafica" name="nombre_form" class="form-horizontal">
  		<label for="">INGRESE MES Y AÑO </label>
  		<div class="form-group ">
  			<div class="col-sm-4">
  				<input type="text" id="mes" name="month" class="form-control col-sm-2" placeholder="MES" onkeyUp="return checar(this);">
  			</div>
  			<div class="col-sm-4">		 
  				<input type="text" id="year" name="year"  class="form-control col-sm-2" placeholder="AÑO" onkeyUp="return checarA(this);" >
  			</div>
  			<div class="col-sm-2">
  				<button  type="button" id="btn_graficar" class="btn btn-primary" value="GRAFICAR" onclick="graficar_MA()">GRAFICAR</button>
  			</div>
        <label id="te"></label>
  		</div> 
      </form>
     </div>
    </div>
   </div>

    <div id="graficoYear">
     
    </div><br>

    <div id="graficoFechas">
     
    </div><br>

  	<div id="contenedor_grafico">
  	 
  	</div>

  </div>
</div>

</body>
</html>