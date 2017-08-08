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
   <li><a href="<?php echo base_url();?>admin/espera">EN ESPERA</a></li>
   <li><a href="<?php echo base_url();?>admin/enconsultorio">EN CONSULTA</a></li>
   <li><a href="<?php echo base_url();?>admin/no_asistio">NO ASISTIO</a></li>
   <li class="active"><a href="<?php echo base_url();?>admin/eliminar">ELIMINAR DERECHOHABIENTE</a></li>
   <li ><a href="<?php echo base_url();?>admin/grafica">GRAFICA</a></li>

 </ul>
 <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre." ".$apellido; ?></a></li>
   <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
 </ul>
</nav>

<div class="container-fluid">
 <div class="row">   
    
  <div class="tab-content col-xs-12 text-center">
    
        <br>
        <div class="col-xs-12 col-md-8"></div>
        <div class="col-xs-6 col-md-4">
          <input type="text" class="form-control" id="searchTerm" name="busqueda" placeholder="DERECHOHABIENTE ELIMINAR">
        </div>
      </div>

    </div>
    <br>
    <div class="row">   
      <div class="panel panel-danger">
        
        <div class="panel-heading text-center" style="margin-bottom: 0%; margin-top: 0%;"><h5 style="font-family: Arial; font-size: 16px; margin-bottom: 0%; margin-top: 0%; color: black">ELIMINAR DERECHOHABIENTES</h5></div>          
          
          <p style="display: none">
            <strong >Mostrar: </strong>
            <select  name="cantidad" id="cantidad">
              <option value="7">7</option>
            </select>
          </p>
          
          <table id="tbclientes" class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="font-family: Areal; background-color: #bfbfbf; ">NOMBRE</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">PATERNO</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">MATERNO</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">EDAD</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">SEXO</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf; font-size: 12px;">FECHA NACIMIENTO</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">RFC</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">VIGENCIA</th>
                <th class="text-center"  style="font-family: Areal;  background-color: #bfbfbf;">ACCION</th>
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
</div>
