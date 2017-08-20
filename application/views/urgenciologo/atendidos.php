<nav class="navbar navbar-inverse container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="<?php echo base_url();?>urgenciologo">DERECHOHABIENTE EN ESPERA</a></li>
      <li class="active"><a href="<?php echo base_url();?>urgenciologo/atendidos" style="">DERECHOHABIENTES ATENDIDOS</a></li>
      <li ><a href="<?php echo base_url();?>urgenciologo/atender" style="display: none">ATENDIENDO DERECHOHABIENTE</a></li>
    </ul>
  <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
    <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <div role="tappanel">
      <ul class="nav nav-tabs" role="tablist">
       <!--  <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">ESPERA</a></li> -->
     </ul>
     <div class="tab-content" id="hola">

     <div class="panel panel-primary">
      <div class="panel-heading text-center" style="font-family: Arial;">LISTA DE DERECHOHABIENTES ATENDIOS HOY</div>
      <div class="table-responsive" id="show" >

      </div> 
      
    </div>
  </div>
</div>
</div>
</div>
</div>

<!-- <script src="http://code.jquery.com/jquery.js"></script> -->
<script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>
<script type="text/javascript">
    
    $(document).ready(function() {
      
  function getRandValue()
    {
      
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>urgenciologo/atendidos_ajax",
            
            success: function(data) {
              //se imprime desde la propiedad de jquery html en el id "show" que es un div
                $('#show').html(data);
            }
        }); 
    }
       getRandValue();
       setInterval(getRandValue, 1000);
      
});


</script>