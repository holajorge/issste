
<div class="container-fluid">
  <br>
  <div class="row">

    <div role="tappanel">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">REGISTRAR COSULTORIOS</a></li>
        <li role="presentation"><a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">EDITAR Y ELIMINAR COSULTORIO</a></li>
      </ul>
      <div class="tab-content col-xs-12 text-center">
        <div role="tabpanel" class="tab-pane active" id="seccion1">
          <h2>REGISTRAR CONSULTORIO</h2>
          <div class="row">
            <form method="POST" id="form_agregaC" class="form-horizontal">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">NOMBRE:</label>
                <div class="col-sm-4">
                  <input type="text" name="nombre"  onblur="verficUsernameC_Registro()" class="form-control" id="nombreValidar" placeholder="Ingrese Nombres del Consultorio" onKeyUp="this.value = this.value.toUpperCase();">
                </div>

                <label for="inputEmail3" class="col-sm-1 control-label">UBICACION:</label>
                <div class="col-sm-4">
                 <input type="text" name="ubicacion" class="form-control" id="ubicacionValidar" placeholder="Ingrese la Ubicacion del Consultorio" onKeyUp="this.value = this.value.toUpperCase();">
               </div>
             </div>

             <div class="form-group">
              <div class="col-sm-offset-1 col-sm-2">
                <button type="button" onclick="insert_consultorio()" name="submit" class="btn btn-primary btn-lg btn-block">GUARDAR</button>
              </div>
              <div class="col-sm-2">
                <button type="button" onclick="cancelarRegistro()" name="submit" class="btn btn-secundary btn-lg">CANCELAR</button>                
              </div>
            </div>
          </form>
        </div>
      </div>


      <div role="tabpanel" class="tab-pane " id="seccion2">
        <div class="row">
          <br>
          <div class="col-lg-8"></div>
          <div class="col-lg-4">
           <input type="text" class="form-control" id="searchTerm" onkeyup="doSearch()" placeholder="Buscar Sala">
         </div>
       </div>


       <div class="row">
        <br>
        <div class="col-sm-8">
          <div class="panel panel-primary ">
            <div class="panel-heading" style="font-family: Arial; font-size: 18px">LISTA CONSULTORIO</div>

            <div class="table-responsive">
              <table class="table table-bordered" id="datos">
                <thead>
                  <tr>
                   <!--      <th class="text-center">#</th> -->
                   <th class="text-center" style="font-family: Arial; background-color: #bfbfbf" >NOMBRE</th>
                   <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">UBICACION</th>
                   <th class="text-center" style="font-family: Arial; background-color: #bfbfbf">ACCIONES</th>
                 </tr>
               </thead>

               <tbody>

                <?php if($consulta1!=null){  foreach ($consulta1->result() as $fila): ?>
                  <tr class="text-center">
                    <th style="text-align: left;">
                      <label  id="nombre<?php echo $fila->id_consultorio ?>"><?php echo  $fila->nombre ?></label></th>
                      <th class="text-center">
                        <label id="ubicacion<?php echo $fila->id_consultorio ?>"><?php echo $fila->ubicacion?></label></th>
                        <th class="text-center">
                          <button type="button" onclick="ajaxConsultorio('<?php echo $fila->id_consultorio ?>');" class="btn btn-primary glyphicon glyphicon-pencil " >
                          </button>
                          <button type="button" class="btn btn-danger glyphicon glyphicon-trash " onclick="confirmDeleteC('<?php echo $fila->id_consultorio?>')" ></button>

                        </th>
                      </tr>

                    <?php endforeach; }?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- CONSULTA DE MOSTAR Y EDITAR -->
          <div class="col-sm-4">
            <div class="panel panel-success">
              <div class="panel-heading">EDITAR CONSULTORIO</div>
              <div class="panel-body">
                <form class="form-horizontal" id="actualiza_consultorio" role="form" >
                  <input type="hidden" name="id" id="idEditar" value="">
                  <div class="form-group">
                    <label style="font-family: Arial">Nombre</label>
                    <input type="text" name="nombre" value="" id="nombreEditar" onblur="verficUsernameC()" class="form-control" onKeyUp="this.value = this.value.toUpperCase();">
                  </div>
                  <div class="form-group">
                    <label style="font-family: Arial">Ubicacion</label>
                    <input type="text" name="ubicacion" id="ubicacionEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();">
                  </div>

                  <div class="modal-footer">
                    <div class="form-group col-sm-6">
                      <button type="button" onclick="update_consul()" name="submit" value="save" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <div class="form-group col-sm-6">     
                      <button type="button" class="btn btn-secundary" onclick="resetear()">Cancelar</button>
                    </div> 
                  </div>
                </form>
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

