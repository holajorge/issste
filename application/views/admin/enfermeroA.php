
<div class="container-fluid">
  <div class="row">
   <br>
   <div role="tappanel">
     <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
       <a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">REGISTRAR ENFERMERO</a>
     </li>
     <li role="presentation">
       <a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">EDITAR Y ELIMINAR ENFERMERO</a>
     </li>
   </ul>

   <div class="tab-content col-md-12 text-center">

     <div role="tabpanel" class="tab-pane active" id="seccion1">
      <div class="row">
        <h2>REGISTRAR ENFERMERO</h2>
        <form method="POST" id="form_agregaE" class="form-horizontal">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-1 control-label">NOMBRE:</label>
            <div class="col-sm-3">
              <input type="text" name="nombre" class="form-control"  id="nombreValidar" placeholder="Ingrese Nombres del Enfemero" onkeypress="return soloLetras(event);" onKeyUp="this.value = this.value.toUpperCase();" >
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">APELLIDO:</label>
            <div class="col-sm-3">
             <input type="text" name="apellido" class="form-control" id="apellidoValidar" placeholder="Ingrese Apellidos del Enfemero" onkeypress="return soloLetras(event);" onKeyUp="this.value = this.value.toUpperCase();">
           </div>
           <label for="inputEmail3" class="col-sm-1 control-label">CORREO:</label>
           <div class="col-sm-3">
            <input type="text" name="correo" class="form-control"  id="correoValidar" placeholder="Ingrese Correo del Enfemero" >
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">CEDULA:</label>
          <div class="col-sm-3">
            <input type="text" name="cedula" class="form-control"  id="cedulaValidar" placeholder="Ingrese Cedula del Enfemero"  onKeyUp="this.value = this.value.toUpperCase();">
          </div>
          <label for="inputEmail3"  class="col-sm-1 control-label">USUARIO:</label>
          <div class="col-sm-3">
            <input type="text" name="usuario" class="form-control"  id="usuarioValidar" onblur="buscaUsernameE()" placeholder="Nombre de Usuario para Enfemero">
          </div>
          <label for="inputEmail3" class="col-sm-1 control-label">Contraseña:</label>
          <div class="col-sm-3">
            <input type="text" name="password" class="form-control" id="passwordValidar" placeholder="Contraseña para el Enfemero"  onKeyUp="this.value = this.value.toUpperCase();">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-8 col-sm-2">
            <button type="button" onclick="insert_Enfemero()" class="btn btn-primary btn-lg btn-block">GUARDAR</button>
          </div>
          <div class=" col-sm-2">
            <button style="background-color:#87867f; color: white" type="button" onclick="reset_reg_enfermero()" class="btn btn-secundary btn-lg btn-block">CANCELAR</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <div role="tabpanel" class="tab-pane " id="seccion2">

   <div class="row">  
    <br>            
    <div class="col-md-8"></div>
    <div class="col-md-4">
      <input type="text" class="form-control" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar Enfermero">
    </div>
  </div>
  <br>
  <!-- MOSTAR TABLA DE ENFERMEROS -->
  <div class="row">
  <div class="panel panel-primary ">
    <div class="panel-heading" style="font-family: Arial; font-size: 18px">LISTA DE ENFERMEROS</div>
    <div class="table-responsive">
      <table class="table table-bordered " id="datos">
        <thead>
         <tr>
          <!-- <th class="text-center">#</th> -->
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">NOMBREe</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">APELLIDO</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf"">CORREO</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">CEDULA</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">USUARIO</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">CONTRASEÑA</th>
          <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">ACCIONES</th>
        </tr>
      </thead>

      <tbody>
        <?php if($consulta!=null){  foreach ($consulta->result() as $fila): ?>
         <tr>
           
          <th >
            <label id="Nombre<?php echo $fila->id_enfermero ?>"><?php echo  $fila->nombre ?>
            </label>
          </th>
          <th >
            <label id="Apellido<?php echo $fila->id_enfermero ?>"><?php echo $fila->apellido?>
            </label>
          </th>
          <th >
            <label id="Correo<?php echo $fila->id_enfermero ?>"><?php echo $fila->correo?>            
            </label>
          </th>
          <th class="text-center">
            <label id="Cedula<?php echo $fila->id_enfermero ?>"><?php echo $fila->cedula?>
            </label>
          </th>
          <th class="text-center">
            <label id="Usuario<?php echo $fila->id_enfermero ?>"><?php echo $fila->username?> </label>
          </th>
          <th class="text-center">
            <label id="Contraseña<?php echo $fila->id_enfermero ?>"><?php echo $fila->password?>
            </label>
          </th >
          <th class="text-center">
           <button type="button" onclick="ajaxEnfermero('<?php echo $fila->id_enfermero ?>');" class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#editarEnfermeroModal">            
           </button>
           <button type="button"  class="btn btn-danger glyphicon glyphicon-trash eliminarD" onclick="confirmDeleteE('<?php echo $fila->id_enfermero ?>')"></button>
         </th>
       </tr>
     <?php endforeach; }?>
   </tbody>
 </table>
</div>
</div>
</div>
</div>
<!-- CONSULTA DE MOSTAR Y EDITAR -->



<div class="modal fade bd-example-modal-sm" id="editarEnfermeroModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">  

     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title text-center">EDITAR ENFERMERO</h4>
    </div>

    <form  id="updateEnfermero" class="text-center"  role="form">

     <input type="hidden" name="id" id="idEditar" value="">

     <div class="form-group">
      <label class="col-lg-2">NOMBRE</label>           
      <input type="text" name="nombre" id="nombreEditar" class="form-control col-sm-2" onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
    </div>
    <div class="form-group">
      <label class="col-lg-2">APPELLIDOS</label>
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
    
    <div class="form-group">
      <label class="col-lg-2">USUARIO</label>
      <input type="text" name="usuario" id="usuarioEditar" class="form-control" onblur="buscaUsernameE_Actualizar()">
    </div>
    <div class="form-group">
      <label class="col-lg-2">CONTRASEÑA</label>
      <input type="text" name="password" id="passwordEditar" class="form-control">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      <button type="button" onclick="ActulaizarEnefemero()" name="submit" value="save"  class="btn btn-primary" >Guardar</button>
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