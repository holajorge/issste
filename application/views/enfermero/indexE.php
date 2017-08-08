
  <nav class="navbar navbar-inverse container-fluid">

    <div class="navbar-header">
      <a class="navbar-brand pantalla" href="javascript: OpenInNewTab()">SUDH</a>
    </div>
      <ul class="nav navbar-nav">             
       <li ><a href="<?php echo base_url();?>enfermero">EXISTENTE</a></li>
       <li class="active"><a href="<?php echo base_url();?>enfermero/registro">REGISTRAR DERECHOHABIENTE</a></li>   
       <li ><a href="<?php echo base_url();?>enfermero/espera">EN ESPERA </a></li>
       <li ><a href="<?php echo base_url();?>enfermero/consultorio">EN CONSULTA</a></li>
       <li ><a href="<?php echo base_url();?>enfermero/no_asistio">FALTANTES</a></li>
     </ul>
     <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
      <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
    </ul>

  </nav>

  <div class="container-fluid text-center">
   <br>
   <div class="row">
    <div role="tappanel">

      <ul class="nav nav-tabs" role="tablist">
       <li role="presentation" class="active"><a href="#seccion1" aria-controls="" data-toggle="tab" role="tab">REGISTRAR DERECHOHABIENTE</a></li>
       <li role="presentation" ><a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">EDITAR DERECHOHABIENTE</a></li>        
      </ul>

      <div class="tab-content col-xs-12 text-center">

        <div role="tabpanel" class="tab-pane active text-center" id="seccion1">
          <h3>DATOS DEL DERECHOHABIENTE</h3>  <br>       
          <form  method="POST" id="form_agregaDERECHO"  class="form-horizontal">
            <div class="form-group ">
              <label for="inputEmail3" class="col-sm-4 control-label">NOMBRE:</label>
              <div class="col-sm-4">
                <input type="text" name="nombre" class="form-control" id="nombreValidar" placeholder="NOMBRE DE DERECHOHABIENTE" onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">APELLIDO PATERNO:</label>
              <div class="col-sm-4">
                <input type="text" name="ape_pate" class="form-control" id="apellidoValidar" placeholder="APELLIDO PATERNO DE DERECHOHABIENTE" onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">APELLIDO MATERNO:</label>
              <div class="col-sm-4">
                <input type="text" name="ape_mate" class="form-control" id="apellidoValidarM" placeholder="APELLIDO MATERNO DE DERECHOHABIENTE" onKeyUp="this.value = this.value.toUpperCase();" onkeypress="return soloLetras(event);">
              </div>
            </div>           
            <div class="form-group">
               <label for="inputEmail3" class="col-sm-4 control-label">SEXO:</label>
              <div class="col-sm-4">
                <select name="sexo" class="form-control" id="sexoValida"> 
                 <option selected>SELECCIONE SEXO</option>
                 <option value="MASCULINO">MASCULINO</option>
                 <option value="FEMENINO">FEMENINO</option>                 
               </select>
             </div>
            </div>
             <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">FECHA DE NACIMIENTO:</label>
              <div class="col-sm-4">
               <input class="form-control" type="date" name="fecha_nacimiento" id="nacimiento" onblur="validarFecha();">
              </div>
            </div>        
             <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label" >RFC:</label>
              <div class="col-sm-4">
                <input type="text" name="rfc" class="form-control" id="rfcValida" placeholder="RFC DE DERECHOHABIENTE" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" onblur="validaRFC()">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">VIGENCIA:</label>
              <div class="col-sm-4">
                <select name="vigencia" class="form-control" id="vigenciaValida" > 
                 <option selected>SELECCIONE TIPO VIGENCIA</option>
                 <option value="TRABAJADOR">TRABAJADOR</option>
                 <option value="TRABAJADORA">TRABAJADORA</option>
                 <option value="ESPOSA">ESPOSA</option>
                 <option value="ESPOSO">ESPOSO</option>
                 <option value="CONCUBINA">CONCUBINA</option>
                 <option value="CONCUBINO">CONCUBINO</option>
                 <option value="PADRE">PADRE</option>
                 <option value="MADRE">MADRE</option>
                 <option value="ABUELO">ABUELO</option>
                 <option value="ABUELA">ABUELA</option>
                 <option value="HIJO">HIJO</option>
                 <option value="HIJA">HIJA</option>
                 <option value="HIJO DE CONYUGE">HIJO DE CONYUGE</option>              
                 <option value="HIJA DE CONYUGE">HIJA DE CONYUGE</option>
                 <option value="PENSIONADO">PENSIONADO</option>
                 <option value="PENSIONADA">PENSIONADA</option>
                 <option value="MUJER DE TRABAJADOR">MUJER DE TRABAJADOR</option>
                 <option value="FAMILIAR PENSIONADO">FAMILIAR PENSIONADO</option>
                 <option value="NO DERECHOHABIENTE">NO DERECHOHABIENTE</option>
               </select>
             </div>
           </div>               
           <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
              <button type="button" onclick="insert_pacienteR()" name="submit" value="save" class="btn btn-primary btn-lg btn-block">Guardar</button>
            </div>
          </div>
         </form>      
        </div>
  
        <div role="tabpanel" class="tab-pane " id="seccion2">
                   
             <div class="row">
              <br>
              <div class="col-xs-12 col-md-8"></div>
               <div class="col-lg-4">
               <input type="text" class="form-control" id="searchTerm" name="busqueda" placeholder="BUSCAR DERECHOHABIENTE">
               </div>
             </div>                

              <br>            
            <div class="row">   
              <div class="panel panel-primary">                
                  <div class="panel-heading text-center"  style="font-family: arial;">LISTA DE DERECHOHABIENTES</div>
                  
                    <p style="display: none">
                      <strong>Mostrar: </strong>
                      <select name="cantidad" id="cantidad">
                        <option value="7">7</option>               
                      </select>
                    </p>
                    <table id="tbPacientes" class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="text-center" style="font-family: Areal; background-color: #bfbfbf; ">NOMBRE</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">APE PATERNO</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">APE MATERNO</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">EDAD</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">SEXO</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">FECHA NACIMIENTO</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">RFC</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">VIGENCIA</th>
                          <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">ACCION</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                    <div class="text-center paginacionn" >
                    </div>
                  </div>
                </div>
               </div>       
             </div>
            </div>
           </div>
          </div>


   <div class="modal fade bd-example-modal-sm" id="editarPacienteM" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
         <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title text-center" id="myModalLabel" style="color: #b38600 ">EDITAR DERECHOHABIENTE</h4>
          </div>
          <form class="text-center" id="update_derechohabienteDatos" method="POST" role="form">
            <input type="hidden" name="id" id="idEditar" value="">
            <input type="hidden" name="edad" id="edadEditar" value="">
            <div class="form-group">
              <label>NOMBRE</label>
              <input type="text" name="nombre" value="" id="nombreEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();" value="">
            </div>
            <div class="form-group">
              <label>APPELLIDO PATERNO</label>
              <input type="text" name="ape_pate" id="apellidoEditar1" class="form-control" onKeyUp="this.value = this.value.toUpperCase();" value="">
            </div>
            <div class="form-group">
              <label>APPELLIDO MATERNO</label>
              <input type="text" name="ape_mate" id="apellidoEditar2" class="form-control" onKeyUp="this.value = this.value.toUpperCase();" value="">
            </div>
              <div class="form-group">
              <label>SEXO</label>
             <!--  <input type="text" name="sexo" id="sexoEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();"> -->
               <select name="sexo" class="form-control" id="sexoEditar"> 
                 
                 <option value="MASCULINO">MASCULINO</option>
                 <option value="FEMENINO">FEMENINO</option>                 
               </select>
            </div>
             
            <div class="form-group">
              <label >FECHA DE NACIMIENTO</label>              
              <input class="form-control" type="date" name="fecha_nacimiento" id="fecha_nacimientoC" onblur="validarFecha_Update();" value="">
            </div> 
            <div class="form-group">
              <label>RFC</label>
              <input type="text" name="rfc" id="rfcEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();" maxlength="10" onblur="validaRFC_UPDATE()" value="">
            </div>
            <div class="form-group" >
              <label>VIGENCIA</label>
             <!--  <input type="text" name="vigencia" id="vigenciaEditar" class="form-control" onKeyUp="this.value = this.value.toUpperCase();"> -->
               <select name="vigencia" class="form-control" id="vigenciaEditaRr" value=""> 
                 <option selected>SELECCIONE TIPO VIGENCIA</option>
                 <option value="TRABAJADOR">TRABAJADOR</option>
                 <option value="TRABAJADORA">TRABAJADORA</option>
                 <option value="ESPOSA">ESPOSA</option>
                 <option value="ESPOSO">ESPOSO</option>
                 <option value="CONCUBINA">CONCUBINA</option>
                 <option value="CONCUBINO">CONCUBINO</option>
                 <option value="PADRE">PADRE</option>
                 <option value="MADRE">MADRE</option>
                 <option value="ABUELO">ABUELO</option>
                 <option value="ABUELA">ABUELA</option>
                 <option value="HIJO">HIJO</option>
                 <option value="HIJA">HIJA</option>
                 <option value="HIJO DE CONYUGE">HIJO DE CONYUGE</option>              
                 <option value="HIJA DE CONYUGE">HIJA DE CONYUGE</option>
                 <option value="PENSIONADO">PENSIONADO</option>
                 <option value="PENSIONADA">PENSIONADA</option>
                 <option value="MUJER DE TRABAJADOR">MUJER DE TRABAJADOR</option>
                 <option value="FAMILIAR PENSIONADO">FAMILIAR PENSIONADO</option>
                 <option value="NO DERECHOHABIENTE">NO DERECHOHABIENTE</option>
               </select>

            </div>          
            <div class="modal-footer">              
              <button type="button" class="btn btn-secondary" style="background-color: #e6e6ff " data-dismiss="modal">CERRAR</button>
              <button type="submit" name="guardar" id="guardar" class="btn btn-primary " data-dismiss="modal" onclick="update_derechohabiente()">GUARDAR CAMBIOS</button>
            </div>

          </form>
        </div>
      </div>
      </div>

