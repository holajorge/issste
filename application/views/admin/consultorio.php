
<nav class="navbar navbar-inverse container-fluid">

    <div class="navbar-header">
      <a class="navbar-brand pantalla" href="javascript: abrirPantalla()">SUDH</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ALTAS <span class="caret"></span></a>
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
   <li ><a href="<?php echo base_url();?>admin/espera">EN ESPERA</a></li>

   <li class="active"><a href="<?php echo base_url();?>admin/enconsultorio">EN CONSULTA</a></li>
   <li><a href="<?php echo base_url();?>admin/no_asistio">NO ASISTIO</a></li>
   <li><a href="<?php echo base_url();?>admin/eliminar">ELIMINAR DERECHOHABIENTE</a></li>
   <li ><a href="<?php echo base_url();?>admin/grafica">GRAFICA</a></li>
 </ul>
 <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre." ".$apellido; ?></a></li>
   <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
 </ul>
</nav>


<div class="container-fluid">
 
  <div role="tappanel">
    <div class="row">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">DERECHOHABIENTES EN CONSULTA</a></li>
      </ul><br>
    </div>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="seccion1">
        
        <div class="row">
          <div class="panel panel-primary">
            <div class="panel-heading text-center" style="font-family: Arial;">LISTA DERECHOHABIENTES EN CONSULTA</div>
            <div class="table-responsive" id="show">
              
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
  
</div>

<!-- SECCION DE REPORTES POR DOCTOR-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPRIMIR REPORTE DE PACIENTES</h4>
      </div>
      <div class="modal-body text-center">
        <div class="container">
          <div class="row">
            <form action="<?php echo base_url();?>admin/reportDoctor" method="POST">
              <div class="row">
                <div class="form-group col-xs-4 col-xs-offset-1 ">
                  <div class="form-group row text-center ">
                    <label for="inputEmail3" class="control-label text-center">DOCTOR</label>
                    <select class="form-control" name="id_doctor" id="id_doctor" > 
                     <option selected>Seleccine Doctor</option>
                     <?php  foreach($arrConsulDoctor as $id_doctor=>$nombre)
                     echo '<option value="'.$id_doctor.'">'.$nombre.'</option>';
                     ?>
                   </select>
                 </div>
               </div>
             </div>
             <div class="row text-center">
              <div class="col-xs-2 col-xs-offset-1">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Inicio</label>
                  <div class="">
                    <input class="form-control" name="fechaInicio" type="date" data-date-format="YYYY MMMM DD" id="fechaInicio">
                    <input type="hidden" name="fechainicio2" id="fechainicio2">
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Fin</label>
                  <div class="">
                    <input class="form-control" name="fechaFin" type="date" data-date-format="YYYY-MMMM-DD" id="fechaFin" onchange="mydate1();">
                    <input type="hidden" name="fechaFin2" id="fechaFin2">
                  </div>          
                </div>
              </div>
            </div>
            <div class="row col-xs-4 col-xs-offset-1">

              <button  class="btn btn-primary btn-lg btn-block" type="submit" name="imprimir" value="imprimir">Imprimir Reporte</button>   

            </div>
          </form>
        </div>
      </div>

    </div>

  </div>
</div>
</div>



<div class="modal fade" id="myModalD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPRIMIR REPORTE DE PACIENTES</h4>
      </div>
      <div class="modal-body">

        <div class="container">
          <div class="row">

            <form action="<?php echo base_url();?>reporte" method="POST">
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Inicio</label>
                  <div class="">
                    <input class="form-control" name="fechaInicio" type="date" data-date-format="YYYY-MMMM-DD" id="fechaInicio">
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Fin</label>
                  <div class="">
                    <input class="form-control" name="fechaFin" type="date" data-date-format="YYYY-MMMM-DD" id="fechaFin">
                  </div>          
                </div>
              </div>
              <div class="col-xs-2">
                <button style="margin: 10px;"  class="btn btn-primary btn-lg btn-block" type="submit" name="imprimir" value="imprimir">Imprimir Reporte</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModalDFalta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPRIMIR REPORTE DE PACIENTES FALTANTES</h4>
      </div>
      <div class="modal-body">

        <div class="container">
          <div class="row">

            <form action="<?php echo base_url();?>admin/faltantes" method="POST">
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Inicio</label>
                  <div class="">
                    <input class="form-control" name="fechaInicio" type="date" data-date-format="YYYY-MMMM-DD" id="fechaInicio">
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Fin</label>
                  <div class="">
                    <input class="form-control" name="fechaFin" type="date" data-date-format="YYYY-MMMM-DD" id="fechaFin">
                  </div>          
                </div>
              </div>
              <div class="col-xs-2">
                <button style="margin: 10px;"  class="btn btn-primary btn-lg btn-block" type="submit" name="imprimir" value="imprimir">Imprimir Reporte</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- <script src="http://code.jquery.com/jquery.js"></script> -->
<script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>
<script type="text/javascript">
  
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });

  $('#myModalD').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });


  
  $(document).ready(function () {
    setInterval(function(){
      $('#show').load('<?php echo base_url();?>admin/consultorio_ajax')
    },500);
    
  });
</script>
</body>

</html>