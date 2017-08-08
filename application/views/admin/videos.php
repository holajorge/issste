
<div class="container-fluid">	
	<div class="row">
		<div role="tappanel">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">SUBIR VIDEO</a></li>
				<!-- <li role="presentation"><a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">CONSULTAR DOCTOR</a></li> -->
			</ul>
		</div>
	</div>
</div>

<div class="tab-content col-md-12  ">
	<!-- required="OBLIGATORIO" -->
	<!-- seccion tab 1 -->
	<div role="tabpanel" class="tab-pane active" id="seccion1">
		<h2 class="text-center">REGISTRAR VIDEOS SOLO FORMATO <strong>MP4</strong></h2>    
		<div class="">

			<?php echo form_open_multipart('',array('class' => 'form-horizontal inseta', 'id' => 'inseta_video'));?>
     <br><br>
     <div class="form-group">
      <label for="inputPassword3" class="col-md-offset-2 col-sm-2 control-label">SELECIONE VIDEO</label>
      <div class="col-sm-4">
       <?php echo form_upload(array('name' => 'pic', 'id' => 'subir') );?>

     </div>
   </div>

   <div class="form-group">
    <div class="col-sm-offset-4 col-sm-2">
     <button type="button" name="Guardar" class="btn btn-primary btn-lg btn-block" onclick="guardar_video()">GUARDAR</button>
     <!-- <?php echo form_submit('submit','Guardar', 'class="btn btn-primary"'); ?> -->
   </div>
   <div class="col-sm-2">
     <button style="background-color:#87867f; color: white" type="button" onclick="reset_reg_video()" class="btn btn-secundary btn-lg btn-block">CANCELAR</button>
   </div>
 </div>			
</form>
</div>
</div>


<script>
 function reset_reg_video() {
   $('#inseta_video')[0].reset();
 }

 function guardar_video() {
   
  var campo = $('#subir').val();

  if(campo == "") {
    sweetAlert("Oops...","NO HAY VIDEO MP4 CARGADO","error");   
    return false;
  }

  var formData = new FormData($(".inseta")[0]);

  $.ajax({
   type: "POST",
   url: base_url()+"admin/save",
   data: formData,
   cache: false,
   contentType: false,
   processData: false,
   beforeSend: function(){
    swal({
      title: "ANDO SUBIENDO!",                        
      timer: 3000,
      showConfirmButton: false
    });
  },          
  success: function(respuesta) 
  {
   if(respuesta)
   {
    swal({
      title: "YA ESTA!", 
      imageUrl: base_url()+"plantillas/img/logo.jpg",                       
      timer: 2000,
      showConfirmButton: false
    });
    
    setTimeout(function() 
    {
     $('#inseta_video')[0].reset();
   }, 2000);   
    
  }
}
}) 

}

</script>


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
            <form action="<?php echo base_url();?>admin/reportDoctor" method="POST" >
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
                    
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Fin</label>
                  <div class="">
                    <input class="form-control" name="fechaFin" type="date" data-date-format="YYYY-MMMM-DD" id="fechaFin" >
                    
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

            <form action="<?php echo base_url();?>admin/reporte" method="POST">
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
<script src="<?php echo base_url();?>plantillas/js/bootstrap.js"> </script>
<script src="http://code.jquery.com/jquery.js"></script>   

<script >
  
  $('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });

  $('#myModalD').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });

  $('#editarDoctorModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
  });


</script>


</body>
</html>