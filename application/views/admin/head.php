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
   <li ><a href="<?php echo base_url();?>admin/eliminar">ELIMINAR DERECHOHABIENTE</a></li>
   <li ><a href="<?php echo base_url();?>admin/grafica">GRAFICA</a></li>

 </ul>
 <ul class="nav navbar-nav navbar-right">
   <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre." ".$apellido; ?></a></li>
   <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
 </ul>
</nav>