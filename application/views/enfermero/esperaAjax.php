<nav class="navbar navbar-inverse container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand pantalla" href="javascript: OpenInNewTab()">SUDH</a>
    </div>
    <ul class="nav navbar-nav">             
      <li><a href="<?php echo base_url();?>enfermero">EXISTENTE</a></li>
      <li><a href="<?php echo base_url();?>enfermero/registro">REGISTRAR DERECHOHABIENTE</a></li>   
      <li class="active"><a href="<?php echo base_url();?>enfermero/espera">EN ESPERA</a></li>
      <li><a href="<?php echo base_url();?>enfermero/consultorio">EN CONSULTA</a></li>
      <li ><a href="<?php echo base_url();?>enfermero/no_asistio">FALTANTES</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
      <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
    </ul>
  </div>
</nav>
<div class="container-fluid">

  <div role="tappanel">
    <div class="row">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">DERECHOHABIENTES EN ESPERA</a></li>
      </ul>
    </div><br>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="seccion1">
        <div class="row">
          <div class="panel panel-primary">
            <div class="panel-heading text-center"  style="font-family: Arial">LISTA DERECHOHABIENTES EN ESPERA</div>
            <div class="table-responsive" id="show">
              
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>
<script type="text/javascript">
  
  $(document).ready(function () {
    setInterval(function(){
      $('#show').load('<?php echo base_url();?>enfermero/ajax_Enfermero')
    },500);
    
  });

  function OpenInNewTab()  
  {

    var url = '<?php echo base_url();?>pantalla';
    
    var nuevaVentana = (window.open(url, '','fullscreen=yes'));
    if (nuevaVentana ) {
      nuevaVentana.focus();
    }

  } 
</script>
</body>

</html>