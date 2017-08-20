
<nav class="navbar navbar-inverse container-fluid">

   <div class="navbar-header">
    <a class="navbar-brand pantalla" href="javascript: OpenInNewTab()">SUDH</a>
  </div>
  <ul class="nav navbar-nav">
    <li class="active"><a href="<?php echo base_url();?>enfermero">EXISTENTE</a></li>
    <li><a href="<?php echo base_url();?>enfermero/registro">REGISTRAR DERECHOHABIENTE</a></li>            
    <li><a href="<?php echo base_url();?>enfermero/espera">EN ESPERA</a></li>
    <li ><a href="<?php echo base_url();?>enfermero/consultorio"> CONSULTA</a></li>
    <li ><a href="<?php echo base_url();?>enfermero/no_asistio">FALTANTES</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
   <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
 </ul>

</nav>

<div class="container-fluid">
 <br>
 <div class="row">   
   <div role="tappanel">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation"  class="active">
        <a href="#seccion1" aria-controls=""  data-toggle="tab" role="tab">BUSCAR DERECHOHABIENTE</a>
      </li><li role="presentation"><a href="#seccion2" aria-controls="" data-toggle="tab" role="tab">PROGRAMAR URGENCIA</a></li>
    </ul>       

    <div class="tab-content col-xs-12 text-center">

      <?php if($query != null){
        foreach ($query->result() as $a) {
         ?>  <?php    }    ?>

         <div role="tabpanel" class="tab-pane active" id="seccion2">
          <h3>DATOS DEL DERECHOHABIENTE</h3>
          <div class="row">  
           <form method="POST" id="insertar_consulta" class="form-horizontal">
            <input type="hidden" name="id" id="idEditar" value="<?php echo $a->id_paciente;?>">
            <input type="hidden" name="fecha_nacimiento" id="fecha" value="<?php echo $a->fecha_nacimiento;?>">
          
            <input type="hidden" value="<?php echo $a->edad;?>" readonly  name="edad" class="form-control">
            <div class="form-group">
             <label for="inputEmail3" class="col-sm-1 control-label">NOMBRE:</label>
             <div class="col-sm-3">                   
              <input type="text" value="<?php echo $a->nombre;?>" readonly name="nombre"  class="form-control" id="nombreEditar" onKeyUp="this.value = this.value.toUpperCase();">
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">PATERNO:</label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $a->ape_pate;?>" readonly name="ape_pate" class="form-control" id="apellidoEditar" onKeyUp="this.value = this.value.toUpperCase();">
            </div>
            <label for="inputEmail3" class="col-sm-1 control-label">MATERNO:</label>
            <div class="col-sm-3">
              <input type="text" value="<?php echo $a->ape_mate;?>" readonly name="ape_mate" class="form-control" id="apellidoEditar1" onKeyUp="this.value = this.value.toUpperCase();">
            </div> 
          </div>          
          <div class="form-group">
           <label for="inputEmail3" class="col-sm-1 control-label">RFC:</label>
           <div class="col-sm-3">
            <input type="text" value="<?php echo $a->rfc;?>" readonly name="rfc" class="form-control" id="rfcEditar" maxlength="10" onKeyUp="this.value = this.value.toUpperCase();">
          </div>   
          <label for="inputEmail3" class="col-sm-1 control-label">SEXO:</label>
          <div class="col-sm-3" >
           <select name="sexo" class="form-control" readonly id="sexoEditar"> 
            <option selected ><?php echo $a->sexo;?></option>                
            <option value="MASCULINO">MASCULINO</option>
            <option value="FEMENINO">FEMENINO</option>                 
          </select>
        </div> 
        <label for="inputEmail3" class="col-sm-1 control-label">VIGENCIA:</label>
        <div class="col-sm-3">
         <select name="vigencia" readonly class="form-control" id="vigenciaEditar"  >
           <option selected ><?php echo $a->vigencia;?></option>
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
      <div class="col-sm-offset-10 col-sm-2">
        <button type="button" class="btn btn-success btn-lg btn-block" onclick="quitarReadOnlyP()">EDITAR</button>
      </div>
    </div>

    <div class="form-group col-sm-12">
     <h3 class="text-center">DATOS NECESARIOS</h3>
   </div>

   <div class="form-group">
    <label for="inputEmail3" class="col-sm-1 control-label">PACIENTE:</label>
    <div class="col-sm-2">

      <?php 
      $edad = $a->edad;
      if ($edad <= 8) { ?>
      <input type="text" value="NIÑO" readonly name="paciente" class="form-control" id="edadEditar">
      <style>
        #noverr{
          display: none;
        }
      </style>  
      <?php
    }elseif($edad >= 9 && $edad <=18 ){ ?>
      <input type="text" value="ADOLECENTE" readonly name="paciente" class="form-control" id="edadEditar">
    
    <?php
    }elseif($edad >= 19 && $edad <=32){ ?>
      
      <input type="text" value="JOVEN" readonly name="paciente" class="form-control" id="edadEditar">        

      <?php
    }elseif ($edad >= 33) { ?>

      <input type="text" value="ADULTO" readonly name="paciente" class="form-control" id="edadEditar">        

    <?php  } ?>      

    </div>  

<div class="col-sm-2 btn-group" id="noverr">
  <label class="btn btn-info"> <h8 style="color: black">G-O</h8>
    <input type="checkbox" id="goValidarr" name="go" autocomplete="off" value="1"> 
    <span class="glyphicon glyphicon-ok"></span>
  </label>
</div>     
<label for="inputEmail3" class="col-sm-1 control-label">Clasificación:</label>
<div class="col-sm-3">
  <select name="clasificacion" id="clasificacionValidar" class="form-control"> 
   <option selected>Seleccione Clasificacion</option>
   <option value="1">VERDE</option>
   <option value="2">AMARILLO</option>
   <option value="3">ROJO</option>
 </select>
</div>

<script>
   $("#sexoEditar").prop('disabled', true);
    $("#vigenciaEditar").prop('disabled', true);
  var checked = document.getElementById("goValidarr");
  var option = document.querySelector("#clasificacionValidar");

  checked.addEventListener("change", function(e){
    if (this.checked) {
      option.selectedIndex = "3";
      $("#clasificacionValidar").prop('disabled', true);
    }
    else {
      option.selectedIndex = "0";
      document.getElementById("clasificacionValidar").disabled = false;
    } 
    
  });
</script>

<label for="inputEmail3" class="col-sm-1 control-label">FOLIO:</label>
<di class="col-sm-2">
  <input onKeyUp="this.value = this.value.toUpperCase();" type="text" name="folio" class="form-control" id="folioValidar" placeholder="Ingrese Folio TRIAGE" maxlength="8">
</di>

</div>
<div class="form-group">      
  <label class="col-sm-3 control-label" for="exampleTextarea">DESCRIPCION DE ESTADO DE SALUD:</label>
  <di class="col-sm-4">
   <textarea name="descripcion" class="form-control" id="descripcionValidar" onKeyUp="this.value = this.value.toUpperCase();" placeholder="ejemplo peso, presión"></textarea>
 </di>
</div>

<div class="form-group">
  <div class="col-sm-offset-10 col-sm-2">
    <button type="button" onclick="insert_paciente()" name="submit" value="save" class="btn btn-primary btn-lg btn-block">Guardar</button>
  </div>
</div>
</form>
</div>

<?php 
}  else{
  ?>  

  <div role="tabpanel" class="tab-pane" id="seccion2">
   <h3>DATOS DEL DERECHOHABIENTE</h3>
   <div class="row">
    <form method="POST" id="insertar_consultaPrevia" class="form-horizontal">

      <input type="hidden" name="id" id="idEditar" value="">
      <input type="hidden" readonly name="edad" class="form-control" id="edadValidarC" >
      <input type="hidden"  name="fecha_nacimiento" class="form-control" id="fecha_nacimientoC" >
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-1 control-label" >NOMBRE:</label>
        <div class="col-sm-3">                
          <input type="text" readonly name="nombre" class="form-control" id="nombreEditar" onKeyUp="this.value = this.value.toUpperCase();" >
        </div>
          <label for="inputEmail3" class="col-sm-1 control-label">PATERNO:</label>
          <div class="col-sm-3">
            <input type="text" readonly name="ape_pate" class="form-control" id="apellidoEditar1" onKeyUp="this.value = this.value.toUpperCase();" >
          </div>
          <label for="inputEmail3" class="col-sm-1 control-label">MATERNO:</label>
          <div class="col-sm-3">
            <input type="text" readonly name="ape_mate" class="form-control" id="apellidoEditar2" onKeyUp="this.value = this.value.toUpperCase();" >
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-1 control-label">RFC:</label>
          <div class="col-sm-3">
            <input type="text" readonly name="rfc" class="form-control" id="rfcEditar" maxlength="10" onKeyUp="this.value = this.value.toUpperCase();">
          </div>

          <label for="inputEmail3" class="col-sm-1 control-label">SEXO:</label>
          <div class="col-sm-3">           
            <select name="sexo" class="form-control" readonly id="sexoEditar">                 
             <option value="MASCULINO">MASCULINO</option>
             <option value="FEMENINO">FEMENINO</option>                 
           </select>
         </div> 

         <label for="inputEmail3" class="col-sm-1 control-label">VIGENCIA:</label>
         <div class="col-sm-3">
           <select name="vigencia" readonly class="form-control" id="vigenciaEditar" > 

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
         <div class="col-sm-offset-10 col-sm-2">
          <button style="margin-top: 0%; margin-bottom: 0%;" type="button" class="btn btn-success btn-lg btn-block" onclick="quitarReadOnly()">
            <h5 style="font-size: 20px; margin-top: 0%; margin-bottom: 0%">EDITAR</h5>
          </button>
        </div>
      </div>
      
      <div class="form-group col-sm-12">
        <h3>DATOS NECESARIOS</h3>
      </div>
      <div class="form-group" > 
        <label for="inputEmail3" class="col-sm-1 control-label">PACIENTE:</label>
        <div class="col-sm-2">
         <input type="text" readonly="" name="paciente" class="form-control" id="edadValidar"> 
       </div>
       
       <div class="col-sm-2 btn-group" id="nover">
        <label class="btn btn-info"> <h8 style="color: black">G-O</h8>
          <input type="checkbox" id="goValidar" name="go"  autocomplete="off" value="1"> 
          <span class="glyphicon glyphicon-ok"></span>
        </label>
      </div>        

      <label for="inputEmail3" class="col-sm-1 control-label">Clasificación:</label>
      <div class="col-sm-3">
        <select name="clasificacion" id="clasificacionValidar1" class="form-control" > 
         <option selected>Seleccione Clasificacion</option>
         <option value="1">VERDE</option>
         <option value="2">AMARILLO</option>
         <option value="3">ROJO</option>
       </select>
     </div>

     <script>

       document.getElementById("vigenciaEditar").disabled = true;
       document.getElementById("sexoEditar").disabled = true;
       var checked = document.getElementById("goValidar");
       var option = document.querySelector("#clasificacionValidar1");

       checked.addEventListener("change", function(e){
        if (this.checked) {
          option.selectedIndex = "3";
          document.getElementById("clasificacionValidar1").disabled = true;
        }
        else {
          option.selectedIndex = "0";
          document.getElementById("clasificacionValidar1").disabled = false;
        }
        
        
      });
    </script>


    <label for="inputEmail3" class="col-sm-1 control-label">FOLIO:</label>
    <div class="col-sm-2">
     <input type="text" name="folio" class="form-control" id="folioValidar1" placeholder="Ingrese Folio del Paciente" onKeyUp="this.value = this.value.toUpperCase();" maxlength="8">

   </div>
 </div>
 <div class="form-group">

  <label class="col-sm-3 control-label" for="exampleTextarea">DESCRIPCION DE ESTADO DE SALUD:</label>
  <di class="col-sm-4">
    <textarea name="descripcion" class="form-control" id="descripcionValidar1" onKeyUp="this.value = this.value.toUpperCase();" placeholder="ejemplo peso, presión"></textarea>
  </di>
  

</div>
<div class="form-group">
  <div class="col-sm-offset-10 col-sm-2">
    <button type="button" onclick="insert_pacientePrevia()" name="submit" value="save" class="btn btn-primary btn-lg btn-block">Guardar</button>
  </div>
</div>
</form>
</div>

<?php
}?>

</div>

<?php if($query!=null){
  ?>
  <div role="tabpanel" class="tab-pane "  id="seccion1"> <?php
  }else{
    ?> 
    <div role="tabpanel" class="tab-pane active" id="seccion1"> <?php
    }
    ?>
    <div role="tabpanel" class="tab-pane active" id="seccion1">

        <div class="row">
          <br>
          <div class="col-xs-12 col-md-8">
              <div class="col-md-7">            
              </div>          
            <button style=" color: black;" class="col-md-5 btn btn-primary glyphicon glyphicon-plus" onclick="registar_nuevo();"> NUEVO DERECHOHABIENTE</button>
          </div>
          <div class="col-xs-6 col-md-4">         
            <input type="text" class="form-control" id="searchTerm" name="busqueda" placeholder="BUSCAR DERECHOHABIENTE">
          </div>
        </div>
      </div>
      <br>
      <div class="row">   
        <div class="panel panel-primary">
          <div class="panel-heading text-center"  style="font-family: Arial; font-size: 14px">LISTA DE DERECHOHABIENTES</div>
          
            <p style="display: none">
              <strong>Mostrar: </strong>
              <select name="cantidad" id="cantidad">
                <option value="7">7</option>               
              </select>
            </p>
            <table id="tbclientes" class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center" style="font-family: Arial; background-color: #bfbfbf; ">NOMBRE</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">PATERNO</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;"> MATERNO</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">EDAD</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">SEXO</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf; font-size: 12px">FECHA NACIMIENTO</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">RFC</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">VIGENCIA</th>
                  <th class="text-center"  style="font-family: Arial;  background-color: #bfbfbf;">ACCIÓN</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <div class="text-center paginacion" >

            </div>
        </div>
        
      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>
</div>
</div>

