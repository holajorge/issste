
<div class="container-fluid">
  <div class="row">
    <br>
    <div role="tappanel">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">REGISTRAR DOCTOR</a></li>
        <li role="presentation"><a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">EDITAR Y ELIMINAR DOCTOR</a></li>
      </ul>
    </div>

    <div class="tab-content col-md-12  text-center">

      <div role="tabpanel" class="tab-pane active" id="seccion1">
        <h2>REGISTRAR DOCTOR</h2>    
        <div class="row">
         <form  method="POST" id="form_agregaD" class="form-horizontal" >
          <div class="form-group ">

            <label for="inputEmail3" class="col-sm-1 control-label">NOMBRE:</label>
            <div class="col-sm-3">
             <input type="text"  name="nombre" class="form-control" id="nombreValidar"  placeholder="Nombres del Doctor"  onkeypress="return soloLetras(event);" onKeyUp="this.value = this.value.toUpperCase();">

           </div>                      
           <label for="inputEmail3" class="col-sm-1 control-label">APPELLIDO:</label>
           <div class="col-sm-3">
             <input type="text" name="apellido" class="form-control" id="apellidoValidar"  placeholder="Apellidos del Doctor" onkeypress="return soloLetras(event);" onKeyUp="this.value = this.value.toUpperCase();">
           </div>

           <label for="inputEmail3" class="col-sm-1 control-label">CORREO:</label>
           <div class="col-sm-3">
            <input type="email" name="correo" class="form-control" id="correoValidar"   placeholder="Correo Doctor">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-1 control-label">CEDULA:</label>
          <div class="col-sm-2">
            <input type="text" name="cedula" class="form-control" id="cedulaValidar"  placeholder="Cedula del Doctor" onKeyUp="this.value = this.value.toUpperCase();">
          </div>

          <!--CONCUSLTA DE SALAS-->

          <label for="inputEmail3" class="col-sm-1 control-label">Consultorio:</label>
          <div class="col-sm-2">
           <select class="form-control" name="id_consultorio" id="selectConsultorioValida" > 
             <option  selected>Seleccine</option>
             <?php  foreach($arrConsul as $id_consultorio=>$nombre)
             echo '<option  value="',$id_consultorio,'">',$nombre,'</option>';
             ?>
           </select>
         </div>         

         <label for="inputEmail3" class="col-sm-1 control-label ">USUARIO:</label>
         <div class="col-sm-2">
          <input type="text" name="usuario" class="form-control" id="usuarioValidar" onblur="verficUsername()" placeholder="Usuario Doctor">
        </div>

        <label for="inputEmail3"  class="col-sm-1 control-label">Contraseña:</label>
        <div class="col-sm-2">
          <input type="text" name="password" class="form-control" id="passwordValidar" placeholder="Contraseña Doctor" >
        </div>
      </div>

      <div class="form-group">
        <div class=" col-sm-2">
          <button type="button" onclick="insert_doctor()" name="submit" value="save" class="btn btn-primary btn-lg btn-block">GUARDAR</button>
        </div>
          <div class=" col-sm-2">
          <button style="background-color:#87867f; color: white" type="button" onclick="resetear_reg_goctor()" name="submit" value="save" class="btn btn-secundary btn-lg btn-block">CANCELAR</button>
        </div>
      </div>    

    </form>
  </div>
</div>

<!-- seccion tab 1 fin -->
<div role="tabpanel" class="tab-pane " id="seccion2">

 <div class="row">
  <br>
  <div class="col-lg-8"></div>
  <div class="col-lg-4">
    <input type="text" class="form-control" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar Doctor">
  </div>
</div>
<br>
 <div class="row">
<div class="panel panel-primary">
  <div class="panel-heading" style="font-family: Arial; font-size: 18px">LISTA DE DOCTORES</div>
  <div class="table-responsive">
   <table class="table table-bordered" id="datos">
     <thead>
       <tr>            
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >NOMBRE</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >APELLIDOS</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >CORREO</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >CEDULA</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >CONSULTORIO</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >USUARIO</th>
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >CONTRASEÑA</th>                   
        <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >ACCIONES</th>
      </tr>
    </thead>               
    <tbody>
     <?php if($arraydortores!=null){  foreach ($arraydortores->result() as $fila): ?>
      <tr> 
        <th>
          <label id="nombre<?php echo $fila->id_doctor ?>"><?php echo  $fila->doct ?></label>
        </th>
        <th>
          <label id="Apellido<?php echo $fila->id_doctor ?>"><?php echo $fila->apellido?></label>
        </th>
        <th>
          <label id="Correo<?php echo $fila->id_doctor ?>"><?php echo $fila->correo?></label>
        </th>
        <th class="text-center">
          <label id="Cedula<?php echo $fila->id_doctor ?>"><?php echo $fila->cedula?></label>
        </th>
        <th class="text-center">
          <label id="consultorio<?php echo $fila->id_doctor ?>"><?php echo $fila->consultorio?></label>
        </th>
        <th class="text-center">
          <label id="Usuario<?php echo $fila->id_doctor ?>"><?php echo $fila->username?></label>
        </th>
        <th class="text-center">
          <label id="Password<?php echo $fila->id_doctor ?>"><?php echo $fila->password?></label>
        </th>
        <th class="text-center">
          <button class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editarDoctorModal" type="button" onclick="ajaxdoctor('<?php echo $fila->id_doctor ?>');" >          
          </button>
          <button type="button"  class="btn btn-danger glyphicon glyphicon-trash eliminarD" onclick="confirmDeleteD('<?php echo $fila->id_doctor ?>')"></button>

        </th>
      </tr>
   
  <?php endforeach;  } ?>
  </tbody>
</table>

</div>
</div>
</div>
</div>

<!--MODAL PARA EDITAR DOCTOR-->

<div class="modal fade bd-example-modal-sm" id="editarDoctorModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">     
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title text-center">EDITAR DOCTOR</h4>
    </div>

    <form  id="editarDordor" class="text-center"  role="form">

     <input type="hidden" name="id" id="idEditar" value="">

     <div class="form-group">
      <label class="col-lg-2">NOMBRE</label>           
      <input type="text" name="nombre" id="nombreEditar" class="form-control col-sm-2" onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
    </div>
    <div class="form-group">
      <label class="col-lg-2">APPELLIDO</label>
      <input type="text" name="apellido" id="apellidoEditar" class="form-control " onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
    </div>
    <div class="form-group">
      <label class="col-lg-2">CORREO</label>
      <input type="email" name="correo" id="correoEditar" class="form-control ">
    </div>
    <div class="form-group">
      <label class="col-lg-2">CEDULA</label>
      <input type="text" name="cedula" id="cedulaEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();">
    </div>
    <div class="form-group ">
      <label for="inputEmail3" class="control-label col-lg-2">CONSULTORIO</label>
      <select class="form-control" name="consultorio" id="consultorioEditar" > 
       <option selected>Seleccine Consultorio</option>
       <?php  foreach($arrConsul as $id_consultorio=>$nombre)
       echo '<option value="',$id_consultorio,'">',$nombre,'</option>';
       ?>
     </select>
   </div>
   <div class="form-group">
    <label class="col-lg-2">USUARIO</label>
    <input type="text" name="usuario" id="usuarioEditar" class="form-control" onblur="verficUsernameD_Actualizar()" >
  </div>
  <div class="form-group">
    <label class="col-lg-2">CONTRASEÑA</label>
    <input type="text" name="password" id="passwordEditar" class="form-control">
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="button" onclick="Update_doctor()" name="submit" value="save"  class="btn btn-primary" >Guardar</button>
  </div>
</form>
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
             
  <script type="text/javascript" src="<?php echo base_url();?>plantillas/js/bootstrap-datepicker.js"></script>

             <div class="row text-center">
              <div class="col-xs-2 col-xs-offset-1">
                <div class="form-group row">
                  <label for="example-date-input" class="col-2 col-form-label">Fecha Inicio</label>
                  <div class="input-group date" id="datetimepicker6">
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

