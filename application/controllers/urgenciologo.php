<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

  class Urgenciologo extends CI_Controller {
   
  public function __construct() 
   {
      parent::__construct();

    /******SE CARGAN LOS MODELOS PARA HACER USO DE LA BASE DE DATOS*******/
      $this->load->model('pantalla_model');
      $this->load->library('myfpdf');      
      $this->load->library('export_excel');
      $this->load->model('pacientes_model');
      $this->load->model('enfermero_model');
      $this->load->model('crudperfiles_model');

  }
/******MODOTO QUE SE CARGA POR DEFECTO QUE ADEMAS NOS LLEVA A OTRO METODO EL CUAL MUESTRA LOS DERECHOHABIENTES QUE ESTAN EN ESPERA*******/
 public function index()
  {
    $this->mostarUrgenciologo();
  }
/******MUSTRA LOS DATOS DE LOS DERECHOHABIENTES QUE ESTAN EN LA LISTA DE ESPERA*******/
 public function mostarUrgenciologo()
  {
   if($this->session->userdata('tipo')==4)
   {
     $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
     $datos['consultaa'] = $this->crudperfiles_model->get_doctor();
     $datos['nombre'] = $this->session->userdata('nombre');
     $datos['apellido'] = $this->session->userdata('apellido');
     $this->load->view('urgenciologo/header_urgenciologo');
     $this->load->view('urgenciologo/index', $datos);
     $this->load->view('urgenciologo/footer_urgenciologo');
   }else{
     redirect('login');
   }
  }
 
  /******METODO QUE CARGA LOS DATOS DE LOS DERECHOHABIENTES EN TIEMPO REAL*******/
   public  function ajax_Urgenciologo()
    {
   if($this->session->userdata('tipo')==4)
     {
     $consultaa= $this->pacientes_model->get_pacientesRojo();
     
     $html=" ";
     $base=base_url();
     if($consultaa != null):
     $html= '
      <table class="table table-bordered">
      <thead>
       <tr>
        <th class="doctor_tabla">NOMBRE</th>
        <th class="doctor_tabla">APELLIDO</th>
        <th class="doctor_tabla">TIPO PACIENTE</th>
        <th class="doctor_tabla">CLASIFICACIÓN</th>
        <th class="doctor_tabla">DESCRIPCIÓN</th>
        <th class="doctor_tabla">TIEMPO ESPERA</th>
        <th class="doctor_tabla">CONSULTAR</th>
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
    <input type="hidden" name="rfc" id="rfc'.$fila->id_consulta_paciente.'" value="'.$fila->rfc.'">
    <input type="hidden" name="folio" id="folio'.$fila->id_consulta_paciente.'" value="'.$fila->folio.'">
    <input type="hidden" name="edad" id="edad'.$fila->id_consulta_paciente.'" value="'.$fila->edad.'">
    <input type="hidden" name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">
    <input type="hidden" name="go" id="go'.$fila->id_consulta_paciente.'" value="'.$fila->go.'">
    <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
    <input type="hidden" name="descripcion" id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
    <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'">                          
    
    <th><label>'.$fila->nombre.'</label></th>       
    <th><label>'.$fila->apellido_paterno.'</label></th>';   

    $goGlobal;

    $tipoP = $fila->go;

    if ($tipoP==1) {
     $goGlobal = "/ G-O";
    }else{
      $goGlobal = " ";
    }

    $html= $html. '
    <th style=" text-align: center;">
     <label name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'"\" >'.$fila->tipo.' '.$goGlobal.'</label>
    </th>';
   
    $clasifica=$fila->clasificacion;
    if($clasifica==1){
    $html= $html. '
    <th style=" text-align: center;">
     <button type="button" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'"disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">VERDE</button>
    </th>';
    }elseif($clasifica==2){
    $html= $html. '
    <th style=" text-align: center;">
    <button type="button" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'"  disabled class="btn btn-warning" style="margin-right: 8px;width:100px;color:black;font-weight: bold; ">AMARILLO</button>
    </th>';
    }elseif ($clasifica==3) {
    $html= $html. '
    <th style=" text-align: center;">
    <button name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">ROJO</button>
    </th>';
    }
    $html= $html. '
    <th><label>'.$fila->descripcion.'</label></th>';
      date_default_timezone_set('America/Cancun');
      $horaini=$fila->hora_llegada;
      $horai=substr($horaini,0,2);
      $mini=substr($horaini,3,2);
      $segi=substr($horaini,6,2);

      $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
                
      $html=$html.'
      <th style=" text-align: center;"><label>'.$hoy.'</label></th>             
      <th style=" text-align: center;">
        <input type="hidden" name="id_consulta_paciente" value="'.$fila->id_consulta_paciente.'"></input>
        <button type="button" onclick="atender('.$fila->id_consulta_paciente.');" class="btn btn-primary glyphicon glyphicon-heart">ATENDER</button>
      </th>
    </tr> ';   
    
    endforeach; 
    $html= $html. '
    </tbody>
  </table> ';
  endif;
  echo $html;
  }else{redirect('login');}
  }  



public function pendientes_ajax()
  {

   $doct =$this->session->userdata('nombre');

     $consultaa= $this->pacientes_model->get_pacientesRecuperarConsultaUR($doct);
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
      <input type="hidden" name="edad" id="edad'.$fila->id_consulta_paciente.'" value="'.$fila->edad.'">
      <input type="hidden" name="go" id="go'.$fila->id_consulta_paciente.'" value="'.$fila->go.'">
      <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
      <input type="hidden" name="descripcion" id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
      <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'"> 

        <th><label style="color: black">'.$fila->nombre.'</label></th>                
        <th><label style="color: black">'.$fila->apellido_paterno.'</label></th>';      
        $global;
        $tipoP = $fila->go;
        if ($tipoP == 1) {
            $global = " / G-O";
          }
          else
          {
            $global = "";
          }
          $html= $html.'
          <th style=" text-align: center;">
            <label style="color: black" name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\" >'.$fila->tipo.''.$global.'</label>
          </th>';        

        $clasifica=$fila->clasificacion;
        if($clasifica==1){
          $html= $html.'
          <th style=" text-align: center;">
           <button  name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style=" margin-right: 8px; color: black; font-weight: bold">VERDE</button>
         </th>';
       }elseif($clasifica==2){
        $html= $html.'
        <th style=" text-align: center;">
          <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">AMARILLO</button>
        </th>';
      }elseif ($clasifica==3){
        $html= $html.'
        <th style=" text-align: center;"> 
          <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">ROJO</button>
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

/******METODO QUE PARA LLAMAR A UN PACIENTE EN PANTALLA PARA QUE PASE A CONSULTORIO*******/
  public function atender()
    {
     if($this->session->userdata('tipo')==4){
          $id_doctor     = $this->input->post('id_doctor');
          $nombre = $this->input->post('nombre');
          $apellido = $this->input->post('apellido');
          $rfc = $this->input->post('rfc'); 
          $folio = $this->input->post('folio'); 
          $edad = $this->input->post('edad'); 
          $go = $this->input->post('go');       
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
              'edad' => $edad,
              'go' => $go,
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
          $getDate= $this->pacientes_model->getDate();
          if($getDate==$fecha_actual){
            
            $this->enfermero_model->paciente_espera($consul);        
          }else{

            $this->pacientes_model->truncate();
            
            $this->enfermero_model->paciente_espera($consul);
          }     

          $datos['nombre'] = $this->session->userdata('nombre');
          $datos['apellido'] = $this->session->userdata('apellido');
          $this->load->view('urgenciologo/header_urgenciologo');
          $this->load->view('urgenciologo/paciente_atendiendo', $datos);
          $this->load->view('urgenciologo/footer_urgenciologo');
          }else{
              redirect('login');
          }
      }

/******METODO PARA TERMINAR DE ATENDER A UN PACIENTE*******/
  public function atender_faltantes()
  {
   if($this->session->userdata('tipo')==4){
        $id_doctor     = $this->input->post('id_doctor');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');  
        $rfc = $this->input->post('rfc');  
        $folio = $this->input->post('folio');  
        $go = $this->input->post('go');  
        $edad = $this->input->post('edad');  
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
            'edad' => $edad,
            'go' => $go,
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
        $this->load->view('urgenciologo/header_urgenciologo');
        $this->load->view('urgenciologo/paciente_atendiendo', $datos);
        $this->load->view('urgenciologo/footer_urgenciologo');
        
        }else{
            redirect('login');
        }
    }
/******METODO PARA TERMINAR DE CONSULTAR A UN PACIENTE*******/
  public   function alta_pacienteU()
    {
        if($this->session->userdata('tipo')==4){
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
        redirect('urgenciologo');
        return true;
      }else{
        redirect('login');
      }
    }

/*****METODO PARA VOLVER A AGREGAR A UN PACIENTE EN PANTALLA DE ESPERA********/
public function Cambiar_estadoVolverPantalla()
    {
       if($this->session->userdata('tipo')==4){

        $id_consulta_paciente= $this->input->post('id_consulta_paciete');
        $this->pacientes_model->Cambiar_estado_volver_Pantalla(1,$id_consulta_paciente);

        $this->pacientes_model->delectPAcienteEspera($id_consulta_paciente);
        
        // $id = $this->input->post('id');
        // $this->pacientes_model->eliminarConsultaEspera($id);
    
          redirect('urgenciologo');
    }else{
            redirect('login');
        }
}
/*****METODO PARA ELIMINAR A UN PACIENTE POR COMPLETO DEL PROCESO DE CONSULTA********/
public function eliminar()
    {
       if($this->session->userdata('tipo')==4){

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
          'clasificacion'          => $this->input->post('clasificacion'),
          'hora_llegada'           => $this->input->post('horaFalta'),          
          'hora_baja'              => $hora,
          'fecha'                  => $fecha,
          'id_doctor'              => $this->input->post('id_doctor')

          );

          $this->pacientes_model->insertConsultaFaltantes($faltantes);

         $this->pacientes_model->eliminarConsultaEspera($id);
    
          redirect('urgenciologo');
          return true;
    }else{
            redirect('login');
        }
}

/******METODO PARA CARGAR UNA VISTA CON LOS PACIENTES YA CONSULTADOS POR DIA*******/
  public function atendidos()
  {
      if($this->session->userdata('tipo')==4){
        $datos['nombre'] = $this->session->userdata('nombre');
        $datos['apellido'] = $this->session->userdata('apellido');
        $this->load->view('urgenciologo/header_urgenciologo');
        $this->load->view('urgenciologo/atendidos', $datos);
        $this->load->view('urgenciologo/footer_urgenciologo');
        
        }else{
            redirect('login');
        }

  }
  /******METODO PARA LLAMAR EN PANTALLA A UN PACIENTE*******/
  public function volverAllamar()
  {
            $nombre= $this->input->post('nombre');
            $apellido=$this->input->post('apellido');
            $consultorio = $this->session->userdata('consultorio');
            $time = time();
          $fechaActual=date("Y-m-d",$time);
            $this->pacientes_model->monitoreollamadaInsert($nombre,$apellido,$consultorio,$fechaActual);
  }

/******METODO PARA CARGAR LOS DATOS QUE LOS PACIENTES QUE YA ESTAN ATENDIDOS POR DIA*******/
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
        <th class="doctor_tabla" >CLASIFICACION</th>
        <th class="doctor_tabla" >H LLEGADA</th>
        <th class="doctor_tabla" >H ESPERA</th>
        <th class="doctor_tabla" >H ATENDIDO</th>
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
     <input type="hidden" name="tipo_paciente" id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->go.'">
    <input type="hidden" name="clasificacion" id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
    <input type="hidden" name="hora_llegada" id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->hora_llegada.'"> 

          <th><label style="color: black;">'.$fila->nombre.'</label></th>                
          <th><label style="color: black">'.$fila->apellido_paterno.'</label></th>
          <th class="text-center"><label style="color: black">'.$fila->sexo.'</label></th> '; 

          $goGlobal;

          $tipoP = $fila->go;

          if ($tipoP==1) {
           $goGlobal = "/ G-O";
          }else{
            $goGlobal = " ";
          }

          $html= $html.'<th class="text-center"><label style="color: black;">'.$fila->tipo.' '.$goGlobal.'</label></th>';
             
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
        <th class="text-center"><label>'.$fila->hora_llegada.'</label></th>
        <th class="text-center"><label>'.$fila->tiempo.'</label></th>
        <th class="text-center"><label>'.$fila->hora_atendido.'</label></th>
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


}