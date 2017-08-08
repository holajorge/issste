<nav class="navbar navbar-inverse container">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand pantalla" href="#">SUDH</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url();?>admin/doctor">Doctor</a></li>
      <li ><a href="<?php echo base_url();?>admin/mostarEnfermero">Enfermero</a></li>
      <li ><a href="<?php echo base_url();?>admin/mostarConsultorios">Consultorio</a></li>
      <li><a class="btn " data-toggle="modal" data-target="#myModal">REPORTES</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span>jorge</a></li>
      <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
    </ul>
  </div>
</nav>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">IMPREMIR REPORTE DE PACIENTES</h4>
      </div>
      <div class="modal-body">

        <div class="container">
          <div class="row">

            <form action="<?php base_url();?>reportes/reporte" method="POST">
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Date</label>
                  <div class="">
                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Date</label>
                  <div class="">
                    <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                  </div>          
                </div>
              </div>
              <div class="col-xs-2">
                <button  class="btn btn-primary btn-lg btn-block" type="submit" name="imprimir" value="imprimir">Imprimir Reporte</button>
              </div>
            </form>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>

<script >
  
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  })

</script>

