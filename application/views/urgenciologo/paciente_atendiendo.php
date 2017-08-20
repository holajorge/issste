
<nav class="navbar navbar-inverse container-fluid">
    <ul class="nav navbar-nav">
        <li><a href="<?php base_url();?>urgenciologo"  style="display: none">DERECHOHABIENTE EN ESPERA</a></li>
        <li class="active"><a href="<?php base_url();?>atender">DERECHOHABIENTE EN CONSULTORIO</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo " ".$nombre.' '.$apellido; ?></a></li>
        <li><a href="<?php echo base_url();?>login/cerrar_sesion"><span class="glyphicon glyphicon-log-in"></span>Salir</a></li>
    </ul>
</nav>

<div class="container-fluid">

   <form method="POST" id="form_agregaD">

     <input type="hidden" name="id_consulta_paciete"   id="id_consulta_paciente<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['id_consulta_paciente'] ?>">
     
     <input type="hidden" name="id_doctor" id="id_doctor<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['id_doctor'] ?>">
     
     <input type="hidden" name="nombre"   id="nombre<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['nombre'] ?>">
     <input type="hidden" name="apellido"   id="apellido<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['apellido'] ?>">
     <input type="hidden" name="rfc"   id="rfc<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['rfc'] ?>">
     <input type="hidden" name="tipo_paciente"   id="tipo_paciente<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['tipo_paciente'] ?>">
      <input type="hidden" name="edad"   id="edad<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['edad'] ?>">
     <input type="hidden" name="go"   id="go<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['go'] ?>">
     <input type="hidden" name="clasificacion"   id="clasificacion<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['clasificacion'] ?>">
     <input type="hidden" name="descripcionn"   id="descripcion<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['descripcion'] ?>">
     <input type="hidden" name="hora_llegada"   id="hora_llegada<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['hora_llegada'] ?>">
      <input type="hidden" name="horaFalta"   id="horaFalta<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['horaFalta'] ?>">
       <input type="hidden" name="folio"   id="folio<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo  $data['folio'] ?>">
    
    <h1 class="text-center" style="color: black">DATOS DEL DERECHOHABIENTE Y AGREGE UNA DESCRIPCIÓN </h1>
    <div class="contentform">
      <div class="leftcontact">
       <div class="form-group">
          <p><strong>FOLIO</strong> </p>
          <input disabled type="text" id="folio<?php echo $data['id_consulta_paciente']?>"  value="<?php echo $data['folio']?>" readonly />
        </div> 
        <div class="form-group">
          <p><strong>NOMBRE</strong> </p>
          <input disabled type="text" id="nombre<?php echo $data['id_consulta_paciente']?>"  value="<?php echo $data['nombre']?>" readonly />
        </div> 
        <div class="form-group">
          <p><strong>APELLIDO</strong> </p>
          <input disabled type="text" id="apellido<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo $data['apellido']?>"/>
          <div class="validation"></div>
        </div>

       <div  class="form-group">
          <strong>TIPO PACIENTE </strong> 
       <?php 
          $goGlobal;

          $tipoP = $data['go'];

          if ($tipoP==1) {
           $goGlobal = " / G-O";
          }else{
            $goGlobal = " ";
          }
       ?>
        <input disabled type="text" id="tipo_paciente<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo$data['tipo_paciente'].$goGlobal?>"/> 
        <div class="validation"></div>
          
        </div>      
               
        <div  class="form-group">
          <strong>CLASIFICACION </strong>  
          <?php if($data['clasificacion']==1){
            ?>
            <input style="background-color: green; color: white; font-weight: bold; font-family: bold;text-align: center;border-radius: 13px;" disabled type="text" id="clasificacion<?php echo $data['id_consulta_paciente'] ?>" value="VERDE" />
          <div class="validation"></div>
            <?php
          }elseif ($data['clasificacion']==2) {
              ?>
            <input style="background-color: yellow;font-weight: bold; font-family: bold;text-align: center;border-radius: 13px;" disabled type="text" id="clasificacion<?php echo $data['id_consulta_paciente'] ?>" value="AMARILLO" />
          <div class="validation"></div>
              <?php
            } elseif ($data['clasificacion']==3) {
              ?>  
                <input style="background-color: red;color: white; font-weight: bold; font-family: bold;text-align: center; border-radius: 13px;" disabled type="text" id="clasificacion<?php echo $data['id_consulta_paciente'] ?>" value="ROJO" />
          <div class="validation"></div>
              <?php
            }?>              
        </div>

        <div class="form-group">
          <strong>DESCRIPCION </strong>
          <input disabled type="text" id="descripcion<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo $data['descripcion']?>"/>
          <div class="validation"></div>
        </div>

        <div class="form-group">
          <strong>HORA EN ESPERA </strong>
          <input disabled type="text"  id="hora_llegada<?php echo $data['id_consulta_paciente'] ?>" value="<?php echo $data['hora_llegada']?>" />
          <div class="validation"></div>
        </div>

   </div>
  <div class="rightcontact" >

    <button type="button" style="background-color: #3377ff" class="col-xs-12 col-ms-4 btn btn-primary btn-lg" onclick="volverallamar()">VOLVER A LLAMAR PACIENTE</button><br><br>&nbsp;
      <div class="form-group col-sm-12">
        <strong>DESCRIPCION DEL DOCTOR: </strong>
        <textarea class="col-sm-12" name="descripcion" id="descripcion" type="text" rows="16" placeholder="INGRESE UNA DESCRIPCION"></textarea>
        <div class="validation"></div>
        
      </div> 
      
       <button type="button"  onclick="insert_Final()"  name="submit" value="save" class="col-xs-12 col-ms-4 bouton-contact  ">ATENDIDO</button>
      <!--    -->
     <button type="button" onclick="noPresento()"  name="submit" value="save" class=" col-xs-12 col-ms-4 bouton-contact2">ELIMINAR </button>
      <p><br></p><br>&nbsp;
      <button type="button" onclick="confirmPantalla()"  style="background-color: #86592d; " class="col-xs-12 col-ms-4 btn btn-primary btn-lg">MANDAR A PANTALLA</button>

    </div>
  
   </div>
  </form> 
</div>
