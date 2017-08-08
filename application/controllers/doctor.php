<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Doctor extends CI_Controller {

   public function __construct() 
   {
    parent::__construct();
    /******SE CARGAN LOS MODELOS A UTULIZAR PARA USAR LA BASE DE DATOS*******/
    $this->load->model('pacientes_model');
    $this->load->model('enfermero_model');
    $this->load->model('crudperfiles_model');
  }

/******METODO PARA CARGAR LA SESION DEL DOCTOR O MEDICO GENERAL*******/
  public function index()
  { 
   $this->Doctor();
  }
/*******METODO PARA CARGAR LOS DATOS PARA SESSION DEL DOCTOR******/
  public function Doctor()
  {
   if($this->session->userdata('tipo')==1)
   {
      
     $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
     $datos['consultaa'] = $this->crudperfiles_model->get_doctor();
     $datos['nombre'] = $this->session->userdata('nombre');
     $datos['apellido'] = $this->session->userdata('apellido');
     $this->load->view('doctor/header_doctor');
     $this->load->view('doctor/doctorIndex', $datos);
     $this->load->view('doctor/footer_doctor');
   }else{
     redirect('login');
   }
  }
/*******METODO PARA CARGAR LOS DATOS DE LOS DERECHOHABIENTES EN LA LISTA DE ESPERA******/
  public function ajax_doctor()
  {

    if($this->session->userdata('tipo')==1){

     $consultaa= $this->pacientes_model->get_pacientesVistaDoctor();

     $html=" ";
     $base=base_url();
     if($consultaa != null):
       $html= '<table class="table table-bordered">
     <thead>
      <tr>
        <th class="doctor_tabla" >NOMBRE</th>
        <th class="doctor_tabla" >APELLIDO</th>
        <th class="doctor_tabla" >TIPO PACIENTE</th>
        <th class="doctor_tabla" >CLASIFICAIÓN</th>
        <th class="doctor_tabla" >DESCRIPCIÓN</th>
        <th class="doctor_tabla" >TIEMPO ESPERA</th>
        <th class="doctor_tabla" >CONSULTAR</th>
      </tr>
    </thead>
    <tbody>';
      foreach ($consultaa->result() as $fila):
        $html=$html. '
      <tr>
        <input type="hidden" name="id_doctor" id="id_doctor'.$fila->id_consulta_paciente.'" value="'.$this->session->userdata("id_doctor").'">       
        <input type="hidden" name="id_consulta_paciente" id="id_consulta_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->id_consulta_paciente.'">          
        <input type="hidden" name="nombre" id="nombre'.$fila->id_consulta_paciente.'" value="'.$fila->nombre.'">
        <input type="hidden" name="apellido" id="apellido'.$fila->id_consulta_paciente.'" value="'.$fila->apellido_paterno.'">
        <input type="hidden" name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">
        <input type="hidden" name="rfc" id="rfc'.$fila->id_consulta_paciente.'" value="'.$fila->rfc.'">
        <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
        <input type="hidden" name="folio" id="folio'.$fila->id_consulta_paciente.'" value="'.$fila->folio.'">
        <input type="hidden" name="descripcion" id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
        <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'"> 
        <th><label>'.$fila->nombre.'</label></th>       
        <th><label>'.$fila->apellido_paterno.'</label></th>';   
        $goGlobla;          
        $tipoP = $fila->go;
        if ($tipoP == 1) {
          $goGlobla = " / G-O";
        }else{
          $goGlobla = "";
        }
        $html= $html. '
        <th style="text-align: center;">
         <label name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" ">'.$fila->tipo.''.$goGlobla.'</label>
       </th >';
       $clasifica=$fila->clasificacion;
       if($clasifica==1){
        $html= $html. '
        <th style="text-align: center;">
          <button type="button" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'"disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">VERDE</button>
        </th>';
      }elseif($clasifica==2){
        $html= $html. '
        <th style="text-align: center;">
          <button type="button" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'"  disabled class="btn btn-warning" style="margin-right: 8px;width:100px;color:black;font-weight: bold; ">AMARILLO</button>
        </th>';
      }elseif ($clasifica==3) {
       $html= $html. '
       <th style="text-align: center;">
         <button name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" type="button" disabled class="btn btn-danger " style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">ROJO</button>
       </th>';
     }
     $html= $html. '
     <th ><label>'.$fila->descripcion.'</label></th>';
     date_default_timezone_set('America/Cancun');
     $horaini=$fila->hora_llegada;
     $horai=substr($horaini,0,2);
     $mini=substr($horaini,3,2);
     $segi=substr($horaini,6,2);

     $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
     $html=$html.'<th style="text-align: center;"><label>'.$hoy.'</label></th>

     <th style="text-align: center;">
       <input type="hidden" name="id_consulta_paciente" value="'.$fila->id_consulta_paciente.'"></input>
       <button type="button" onclick="atenderPaciente('.$fila->id_consulta_paciente.');" class="btn btn-primary glyphicon glyphicon-heart">ATENDER</button>
     </th>

   </tr> ';   
   endforeach; 
   $html= $html. '
  </tbody>
  </table> ';
  endif;
  echo $html;

  }else{
    redirect('login');
  }

  }

  /******METODO PARA CARGAR O RECUPERAR LOS DATOS DE LOS DERECHOHABIENTES EN CONSULTORIO EN CASO DE NO TERMINAR DE CONSULTAR*******/
  public function pendientes_doctor_ajax()
  {

   $doct =$this->session->userdata('nombre');

   $consultaa= $this->pacientes_model->get_pacientesRecuperarConsulta($doct);
   $html=" ";
   if($consultaa != null){

    $html='
    <div class="panel panel-danger ">
     <div class="panel-heading text-center" style="font-family: Areal;">PRIORIDAD TERMINAR DE ATENDER</div>
     <table class="table table-bordered">

      <thead>
       <tr>
        <th class="doctor_tabla" >NOMBRE</th>
        <th class="doctor_tabla" >APELLIDO</th>
        <th class="doctor_tabla" >TIPO PACIENTE</th>
        <th class="doctor_tabla" >CLASIFICACIÓN</th>     
        <th class="doctor_tabla" >DESCRIPCIÓN</th>
        <th class="doctor_tabla" >TIEMPO ESPERA</th>
        <th class="doctor_tabla" >CONSULTAR</th>
      </tr>
    </thead>

    <tbody>';
      $base=base_url();
      foreach ($consultaa->result() as $fila):
        $html= $html.'     
      <tr>                                              
       <input type="hidden" name="id_doctor" id="id_doctor'.$fila->id_consulta_paciente.'" value="'.$this->session->userdata("id_doctor").'">       
       <input type="hidden" name="id_consulta_paciente" id="id_consulta_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->id_consulta_paciente.'">          
       <input type="hidden" name="nombre" id="nombre'.$fila->id_consulta_paciente.'" value="'.$fila->nombre.'">
       <input type="hidden" name="apellido" id="apellido'.$fila->id_consulta_paciente.'" value="'.$fila->apellido_paterno.'">
       <input type="hidden" name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">
       <input type="hidden" name="rfc" id="rfc'.$fila->id_consulta_paciente.'" value="'.$fila->rfc.'">
       <input type="hidden" name="folio" id="folio'.$fila->id_consulta_paciente.'" value="'.$fila->folio.'">
       <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
       <input type="hidden" name="descripcion" id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
       <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'"> 
       <th><label style="color: black">'.$fila->nombre.'</label></th>                
       <th><label style="color: black">'.$fila->apellido_paterno.'</label></th>                                    
     
        <th style="text-align: center;">
         <label name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" ">'.$fila->tipo.'</label>
       </th>  
      ';    
      $clasifica=$fila->clasificacion;
      if($clasifica==1){
        $html= $html.'
        <th style=" text-align: center;">
         <button  name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style=" margin-right: 8px; color: black; font-weight: bold">VERDE</button>
       </th>';
     }elseif($clasifica==2){
      $html= $html.'
      <th style=" text-align: center;">
        <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; color: black; font-weight: bold">AMARILLO</button>
      </th>';
    }elseif ($clasifica==3){
      $html= $html.'
      <th style=" text-align: center;"> 
        <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="with:100%; color:black; font-weight: bold">ROJO</button>
      </th>';
    }
    $html= $html.'
    <th ><label>'.$fila->descripcion.'</label></th>';
    date_default_timezone_set('America/Cancun');
    $horaini=$fila->hora_llegada;
    $horai=substr($horaini,0,2);
    $mini=substr($horaini,3,2);
    $segi=substr($horaini,6,2);

    $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
    $html=$html.'<th style="text-align: center;"><label>'.$hoy.'</label></th>

    <th style=" text-align: center;">
     <input type="hidden" name="id_consulta_paciente" value="'.$fila->id_consulta_paciente.'"></input>
     <button type="button" onclick="atender_prioridad('.$fila->id_consulta_paciente.');" class="btn btn-primary glyphicon glyphicon-heart">ATENDER</button>
   </th>   

  </tr>';                     
  endforeach; 
  $html= $html . '
  </tbody> 
  </table></div>';
  }else{


  }
  echo $html;

  }

  /******METODO PARA ATENDER A UN DERECHOHABIENTE*******/

  public function atender()
  {
   if($this->session->userdata('tipo')==1){
    $id_doctor     = $this->input->post('id_doctor');
    $nombre = $this->input->post('nombre');
    $apellido = $this->input->post('apellido');  
    $rfc = $this->input->post('rfc');  
    $folio = $this->input->post('folio');  
    $tipo_paciente = $this->input->post('tipo_paciente');
    $clasificacion = $this->input->post('clasificacion');
    $descripcion = $this->input->post('descripcion');
    $hora_llegada = $this->input->post('hora_llegada');

    date_default_timezone_set('America/Cancun');
    $horaini=$hora_llegada;
    $horai=substr($horaini,0,2);
    $mini=substr($horaini,3,2);
    $segi=substr($horaini,6,2);

    $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
    $fecha_actual = date("Y-m-d");  
    $id_consulta_paciente  = $this->input->post('id_consulta_paciente');
    $descripcionDoctor = $this->input->post('descripcionDoctor');

    $datos['data'] = array(

      'id_doctor'   => $id_doctor,    
      'nombre'   => $nombre,
      'apellido' => $apellido,
      'rfc' => $rfc,
      'folio' => $folio,
      'tipo_paciente'   => $tipo_paciente,
      'clasificacion' => $clasificacion,
      'descripcion' => $descripcion,
      'hora_llegada' => $hoy, 
      'horaFalta' => $this->input->post('hora_llegada'),
      'id_consulta_paciente'   => $id_consulta_paciente

      );
    $consul = array(
      'id_consulta_paciente'   => $id_consulta_paciente ,
      'id_doctor' => $id_doctor,  
      'fecha' => $fecha_actual  
      );

    $datos['base']=array(

      'url'   => base_url()

      );

    $this->pacientes_model->Cambiar_estado(2,$id_consulta_paciente);
          //obtiene la fecha maxima de la tabla paciente_espera para comparar
    $getDate= $this->pacientes_model->getDate();

    if($getDate==$fecha_actual){
            //se imprime el nombre del paciente en pantalla
      $this->enfermero_model->paciente_espera($consul);

    }else{
            //se elimina los registros de la tabla paciente_espera
      $this->pacientes_model->truncate();
      $this->enfermero_model->paciente_espera($consul);
    }

    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('doctor/header_doctor');
    $this->load->view('doctor/paciente_atendiendo', $datos);
    $this->load->view('doctor/footer_doctor');

  }else{
    redirect('login');
  }
  }

  /******METODO PARA MOSTRAR LOS DATOS DEL DERECHOHABIENTE FALTANTE POR ATENDER*******/
  public function atender_faltantes()
  {
   if($this->session->userdata('tipo')==1){
    $id_doctor     = $this->input->post('id_doctor');
    $nombre = $this->input->post('nombre');
    $apellido = $this->input->post('apellido');  
    $rfc = $this->input->post('rfc');  
    $folio = $this->input->post('folio'); 
    $tipo_paciente = $this->input->post('tipo_paciente');
    $clasificacion = $this->input->post('clasificacion');
    $descripcion = $this->input->post('descripcion');
    $hora_llegada = $this->input->post('hora_llegada');

    date_default_timezone_set('America/Cancun');
    $horaini=$hora_llegada;
    $horai=substr($horaini,0,2);
    $mini=substr($horaini,3,2);
    $segi=substr($horaini,6,2);

    $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
    $fecha_actual = date("Y-m-d");  
    $id_consulta_paciente  = $this->input->post('id_consulta_paciente');
    $descripcionDoctor = $this->input->post('descripcionDoctor');

    $datos['data'] = array(

      'id_doctor'   => $id_doctor,    
      'nombre'   => $nombre,
      'apellido' => $apellido,
      'rfc' => $rfc,
      'folio' => $folio,
      'tipo_paciente'   => $tipo_paciente,
      'clasificacion' => $clasificacion,
      'descripcion' => $descripcion,
      'hora_llegada' => $hoy, 
      'horaFalta' => $this->input->post('hora_llegada'),
      'id_consulta_paciente'   => $id_consulta_paciente

      );

    $datos['base']=array(

      'url'   => base_url()

      );        

    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('doctor/header_doctor');
    $this->load->view('doctor/paciente_atendiendo', $datos);
    $this->load->view('doctor/footer_doctor');

  }else{
    redirect('login');
  }
  }

  /******METODO PARA TERMINAR LA CONSULTA DEL DERECHOHABIENTE*******/
  public function alta_paciente()
  {
   if($this->session->userdata('tipo')==1)
   {
    date_default_timezone_set('America/Cancun');
    $time = time();
    $fecha=date("Y-m-d",$time);
    $hora=date("H:i:s",$time);
    $id_consulta_paciente= $this->input->post('id_consulta_paciete');
    $data = array(
      'id_doctor'   => $this->input->post('id_doctor'), 
      'id_consulta_paciete'   => $this->input->post('id_consulta_paciete'),
      'descripcion' => $this->input->post('descripcion'),
      'hora_atendido' => $hora,
      'tiempo' => $this->input->post('hora_llegada')
      );
    $this->pacientes_model->Cambiar_estado(3,$id_consulta_paciente);
     //$this->enfermero_model->paciente_espera_delete($id_consulta_paciente);
    $this->pacientes_model->pacienteAtendido($data);
    redirect('doctor');
    return true;
  }else{
    redirect('login');
  }
  }
/******METODO PARA DE VOLVER AL DERECHOHABIENTE EN LA LISTA DE ESPERA EN PANTALLA (OTRA OPORTUNIDAD)*******/
  public function Cambiar_estadoVolverPantalla()
  {
   if($this->session->userdata('tipo')==1){

    $id_consulta_paciente= $this->input->post('id_consulta_paciete');
    $this->pacientes_model->Cambiar_estado_volver_Pantalla(1,$id_consulta_paciente);
    $this->pacientes_model->delectPAcienteEspera($id_consulta_paciente);

    redirect('doctor');
    return true;
  }else{
    redirect('login');
  }
  }


  public function eliminar()
  {
   if($this->session->userdata('tipo')==1){

     $id = $this->input->post('id_consulta_paciete');

     date_default_timezone_set('America/Cancun');
     $time = time();
     $fecha=date("Y-m-d",$time);
     $hora=date("H:i:s",$time);

     $faltantes = array(
            // 'id_consulta_paciente'   => $this->input->post('id_consulta_paciente'),
      'nombre'                 => $this->input->post('nombre'),
      'apellido'               => $this->input->post('apellido'),     
      'rfc'                    => $this->input->post('rfc'),     
      'tipo_paciente'          => $this->input->post('tipo_paciente'),
      'clasificacion'         => $this->input->post('clasificacion'),
      'hora_llegada'           => $this->input->post('horaFalta'),
      'hora_baja'              => $hora,
      'fecha'                  => $fecha,
      'id_doctor'              => $this->input->post('id_doctor')

      );

     $this->pacientes_model->insertConsultaFaltantes($faltantes);

     $this->pacientes_model->eliminarConsultaEspera($id);

     redirect('doctor');
     return true;
   }else{
    redirect('login');
  }
  }

/******ELIMINAR DEREHOHABIENTE EN LA LISTA DE ESPERA*******/
  public function eliminarPaciente()
  {
   if($this->session->userdata('tipo')==1){
     $id = $this->input->post('id');
     $this->pacientes_model->eliminarConsultaEsperaD($id);    
     redirect('doctor');
   }else{redirect('login');}
  }

/*******METODO PARA CARGAR LOS DATOS DE LOS DERECHOHABIENTES QUE ESTAN ATENDIDOS EN EL DIA ACTUAL******/
  public function atendidos()
  {
    if($this->session->userdata('tipo')==1){
      $datos['nombre'] = $this->session->userdata('nombre');
      $datos['apellido'] = $this->session->userdata('apellido');
      $this->load->view('doctor/header_doctor');
      $this->load->view('doctor/atendidos', $datos);
      $this->load->view('doctor/footer_doctor');

    }else{
      redirect('login');
    }

  }

  /******CARGAR LOS DATOS DE LOS DERECHOHABIENTES ATENDIDOS POR DOCTOR EN EL DIA*******/
  public function atendidos_ajax()
  {

   $doct =$this->session->userdata('id_doctor');

   date_default_timezone_set('America/Cancun');
   $time = time();
   $fecha=date("Y-m-d",$time);
   $hora=date("H:i:s",$time);

   $consultaa= $this->pacientes_model->get_consultados_hoy($doct, $fecha);


   $html=" ";
   if($consultaa != null){

    $html='

    <table class="table table-bordered">

      <thead>
       <tr>
        <th class="doctor_tabla" >NOMBRE</th>
        <th class="doctor_tabla" >APELLIDO</th>
        <th class="doctor_tabla" >SEXO</th>
        <th class="doctor_tabla" >TIPO</th>     
        <th class="doctor_tabla" >CLASIFICACIÓN</th>
        <th class="doctor_tabla" >HORA LLEGADA</th>
        <th class="doctor_tabla" >TIEMPO ESPERA</th>
        <th class="doctor_tabla" >HORA ATENDIDO</th>
      </tr>
    </thead>

    <tbody>';
      $base=base_url();
      foreach ($consultaa->result() as $fila):
        $html= $html.'     
      <tr>                                              
       <input type="hidden" name="id_doctor" id="id_doctor'.$fila->id_consulta_paciente.'" value="'.$this->session->userdata("id_doctor").'">       
       <input type="hidden" name="id_consulta_paciente" id="id_consulta_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->id_consulta_paciente.'">          
       <input type="hidden" name="nombre" id="nombre'.$fila->id_consulta_paciente.'" value="'.$fila->nombre.'">
       <input type="hidden" name="apellido" id="apellido'.$fila->id_consulta_paciente.'" value="'.$fila->apellido_paterno.'">
       <input type="hidden" name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">

       <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">

       <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'"> 

       <th><label style="color: black">'.$fila->nombre.'</label></th>                
       <th><label style="color: black">'.$fila->apellido_paterno.'</label></th>
       <th style="text-align: center;"><label style="color: black">'.$fila->sexo.'</label></th>
       ';                   
       $goGlobla;          
        $tipoP = $fila->go;
        if ($tipoP == 1) {
          $goGlobla = " / G-O";
        }else{
          $goGlobla = "";
        }
        $html= $html. '
        <th style="text-align: center;">
         <label name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" ">'.$fila->tipo.''.$goGlobla.'</label>
       </th >';   
      $clasifica=$fila->clasificacion;
      if($clasifica==1){
        $html= $html.'
        <th style=" text-align: center;">
         <button  name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style=" margin-right: 8px; color: black; font-weight: bold">VERDE</button>
       </th>';
     }elseif($clasifica==2){
      $html= $html.'
      <th style=" text-align: center;">
        <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; color: black; font-weight: bold">AMARILLO</button>
      </th>';
    }elseif ($clasifica==3){
      $html= $html.'
      <th style=" text-align: center;"> 
        <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="with:100%; color:black; font-weight: bold">ROJO</button>
      </th>';
    }
    $html= $html.'
    <th style=" text-align: center;"><label>'.$fila->hora_llegada.'</label></th>
    <th style=" text-align: center;"><label>'.$fila->tiempo.'</label></th>
    <th style=" text-align: center;"><label>'.$fila->hora_atendido.'</label></th>
    ';'

  </tr>';                     
  endforeach; 
  $html= $html . '
  </tbody> 
  </table></div>';
  }else{


  }
  echo $html;


  }

/******METODO PARA VOLVER A LLAMAR AL UN DERECHOHABIENTE EN PANTALLA*******/
  public function volverAllamar()
  {
    $nombre= $this->input->post('nombre');
    $apellido=$this->input->post('apellido');
    $consultorio = $this->session->userdata('consultorio');
    $time = time();
    $fechaActual=date("Y-m-d",$time);
    $this->pacientes_model->monitoreollamadaInsert($nombre,$apellido,$consultorio,$fechaActual);
  }



}
?>