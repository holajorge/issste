<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Enfermero extends CI_Controller {

  public function __construct() 
  {
    parent::__construct();
/******SE CARGAN LOS MODELOS A UTULIZAR PARA USAR LA BASE DE DATOS*******/
    $this->load->model('pacientes_model');
    $this->load->model('enfermero_model');
    $this->load->model('crudperfiles_model');

  }
   /**METODO PARA CARGAR LA SESION DEL ENFEMERO EL CUAL NOS LLEVA A OTRO MEDOTO PARA VER LOS DATOS DE LOS DERECHOHABIENTES**/
  public function index()
  {   

   $this->consultass();
  
  }
/******METODO PARA REGISTRAR UN NUEVO DERECHOHABIENTE EN EL SISTEMA*******/
  public function registro()
  {
   if($this->session->userdata('tipo')==2)
   {
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/indexE', $datos);      
     $this->load->view('enfermero/footer_enfermero');
   }else{
    redirect('login');
   }
 }
/******MOSTRAR LOS DATOS DE LOS DERECHOHABIENTES EN TIEMPO REAL*******/
  public function mostrar()
   {

      $buscar = $this->input->post("buscar");
      $numeropagina = $this->input->post("nropagina");
      $cantidad = $this->input->post("cantidad");
      
      $inicio = ($numeropagina -1)*$cantidad;
      $data = array(
     
        "clientes" => $this->enfermero_model->buscar(0, $buscar,$inicio,$cantidad),
        "totalregistros" => count($this->enfermero_model->buscar(0, $buscar)),
        "cantidad" =>$cantidad
        
      );
      echo json_encode($data);
   }
/******METODO PARA EDITAR LOS DATOS DE LOS DERECHOHABIENTES*******/
public function EditarDerechohabiente()
   {

      $buscar = $this->input->post("buscar");
      $numeropagina = $this->input->post("nropagina");
      $cantidad = $this->input->post("cantidad");
      
      $inicio = ($numeropagina -1)*$cantidad;
      $data = array(
     
        "clientes" => $this->enfermero_model->buscar_editar(0,$buscar,$inicio,$cantidad),
        "totalregistros" => count($this->enfermero_model->buscar(0,$buscar)),
        "cantidad" =>$cantidad
        
      );
      echo json_encode($data);
   }


    /******MEDOTO PARA REGISTRAR NUEVO DERECHOHABIENTE EN EL SISTEMA*******/
    public function new_paciente()
    {  

     if($this->session->userdata('tipo')==2)
     {
      $nombre = $this->input->post('nombre');
      $ape_pate = $this->input->post('ape_pate');
      $ape_mate = $this->input->post('ape_mate');
      $sexo = $this->input->post('sexo');
      $fecha_nacimiento = $this->input->post('fecha_nacimiento');
      date_default_timezone_set('America/Cancun');
      $time = time();
      $fecha=date("Y-m-d",$time);

      $edad = $fecha - $fecha_nacimiento;

      $rfc = $this->input->post('rfc');
      $vigencia = $this->input->post('vigencia');

      $data = array(
      'nombre'   => $nombre,
      'ape_pate' => $ape_pate,
      'ape_mate' => $ape_mate,
      'sexo'    => $sexo,
      'fecha_nacimiento'    => $fecha_nacimiento,
      'rfc'      => $rfc,
      'vigencia' => $vigencia,
      'edad'      => $edad
       );
      $this->enfermero_model->insertPaciente($data);
      redirect('enfermero/consultasr');
      return true;
     }else
     {
      redirect('login');
     }
    }

  /******METODO PARA REGUISTAR LA CONSULTA DE UN DERECHOHABIENTE PARA PONERLO EN ESTADO DE ESPERA*******/
  public function insertar_consulta()
  {
   if($this->session->userdata('tipo')==2)
   {
    date_default_timezone_set('America/Cancun');
    $time = time();
    $fecha=date("Y-m-d",$time);
    $hora=date("H:i:s",$time);

    $nombre = $this->input->post('nombre');
    $id= $this->input->post('id');
    $ape_pate = $this->input->post('ape_pate');
    $ape_mate = $this->input->post('ape_mate');
    $rfc = $this->input->post('rfc');
    $sexo = $this->input->post('sexo');
    $edad = $this->input->post('edad');
    $go = $this->input->post('go');
    
    $fecha_nacimiento = $this->input->post('fecha_nacimiento');

    $edad = $fecha - $fecha_nacimiento;

    $vigencia = $this->input->post('vigencia');
    $tipo = $this->input->post('paciente');
     
      
      if ($tipo == "NIÑO") {
        
          $tipo_paciente = "1";
         
         }
      elseif ($tipo == "ADOLECENTE") {
        
          $tipo_paciente = "2";
         
         }
      elseif ($tipo == "JOVEN") {

          $tipo_paciente = "3";
         
         }
      elseif ($tipo == "ADULTO") {
        
          $tipo_paciente = "4";
         
         }
    

    $clasificacion = $this->input->post('clasificacion');
    $folio = $this->input->post('folio');
    // $id_doctor = $this->input->post('id_doctor');
    $descripcion = $this->input->post('descripcion');        
    $estado=1;

    $data = array(
      'nombre'       => $nombre,
      'apellido_paterno'     => $ape_pate,
      'apellido_materno'     => $ape_mate,
      'rfc'          => $rfc,
      'sexo'         => $sexo,
      'edad'         => $edad,
      'vigencia'      => $vigencia,
      'id_tipo_paciente' => $tipo_paciente,
      'go' => $go,
      'id_clasificacion_paciente' => $clasificacion ,
      'folio'         => $folio,
      'descripcion'   => $descripcion,
      'fecha'         => $fecha,
      'hora_llegada'  => $hora,
      'id_estado'        =>$estado,    
      'id_paciente'   =>$id,
      // 'id_doctor'   =>$id_doctor

      );

    $update_Paciente = array(
      
      'nombre'       => $nombre,
      'ape_pate'     => $ape_pate,
      'ape_mate'     => $ape_mate,
      'sexo'         => $sexo,
      'fecha_nacimiento'   => $fecha_nacimiento,
      'edad'         => $edad,
       'rfc'          => $rfc,
      'vigencia'      => $vigencia        
      );

    $this->enfermero_model->insertarUpdatePaciente($id,$update_Paciente);

    $actualizar = $this->enfermero_model->insertarPacienteCita($data);
    if($actualizar)
    {
     redirect('enfermero/consultass');

     return true;
    }
    else
    {
     return false;
    }
   }else{
    redirect('login');
   }
  }

    /******METODO PARA ACTUALIZAR LOS DATOS DE UN DERECHOHABIENTE EN LA BASE DE DATOS*******/
  public function update_paciente()
    {
      if($this->session->userdata('tipo')==2)
       {
      $id       = $this->input->post('id');
      $nombre   = $this->input->post('nombre');
      $paterno = $this->input->post('ape_pate');
      $materno = $this->input->post('ape_mate');
      $edad = $this->input->post('edad');
      $rfc      = $this->input->post('rfc');
      $sexo    = $this->input->post('sexo');    
      $fecha = $this->input->post('fecha_nacimiento');
      $vigencia    = $this->input->post('vigencia'); 

      $data = array(
      'nombre'   => $nombre,
      'ape_pate' => $paterno,
      'ape_mate' => $materno,
      'sexo'     => $sexo,
      'rfc'      => $rfc,
      'fecha_nacimiento'     => $fecha,
      'edad'     => $edad,
      'vigencia'     => $vigencia
     
      );

     $actualizar = $this->enfermero_model->updatePaciente($id, $data);

     if($actualizar)
     {
      redirect('enfermero/registro');
      return true;
     }else{        
      return false;
     }
    }else{
      redirect('login');
    }
  }

  /******ELIMINAR UN DERECHOHABIENTE DE LA CONSULTA*******/
  public function deletePaciente()
   {
    if($this->session->userdata('tipo')==2){
    $id = $this->input->post('id');
    $this->enfermero_model->eliminarPaciente($id);
    redirect('enfermero');

    }else{redirect('login');}
  }

    // CARGA VISTA CONSULTA EN ESTE CASO SE CARGA EL UNA VISTA QUE NOS LLEVA A OTRO METODO QUE SOLO TIENE LA FUNCION DE AGENDAR UN CONSULTA PARA EL DERECHOHABIENTE
  public function consultass()
   {
    if($this->session->userdata('tipo')==2)
    {     
     $this->consultas(2);
    }else
    {
     redirect('login');
    }
   }
  /******METODO QUE RECIBE LOS DATOS DE UN DERECHOHABIENTE REGUISTRADO PARA CARGAN EN OTRA VISTA*******/
  public function consultasr()
  {
    if($this->session->userdata('tipo')==2){
       $this->consultas(1);
    }else
    {
     redirect('login');
    }
  }
  /******METODO QUE DETEMINA SI HAY QUE CARGAR UNA VISTA CON DATOS DE UN DERECHOHABIENTE O SOLO ES OBTENERLOS DE LA VISTA YA PREVIAMENTE CARGADA EL INICIO DE LA SESSION DEL ENFERMERO*******/
  public function consultas($var)
  {  
   if($var==1)
   {
   if($this->session->userdata('tipo')==2)
   {

    $datos['consulta'] = $this->enfermero_model->get_paciente();
    $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
    $datos['query']=$this->enfermero_model->get_paciente_id();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/consultas', $datos);
     $this->load->view('enfermero/footer_enfermero');
   }else{
    redirect('login');
   }
  }else
  {
   if($this->session->userdata('tipo')==2)
   {

    $datos['consulta'] = $this->enfermero_model->get_paciente();
    $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
    $datos['query']=null;
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/consultas', $datos);
    $this->load->view('enfermero/footer_enfermero');
   }else
   {
    redirect('login');
   }
  }
  }

  /*******ELIMINAR UN DERECHOHABIENTE DE LA BASE DE DATOS******/
  public function eliminar()
   {
    if($this->session->userdata('tipo')==2){
    $id = $this->input->post('id');
    $this->pacientes_model->eliminarCitaPaciente($id);
    redirect('enfermero/espera');
    }else{redirect('login');}

   }

  /******METODO PARA CARGAR LA VISTA DE LOS DERECHOHABIENTES EN ESPERA O LOS QUE ESTEN PENDIENTES POR COSULTAR*******/
  Public function espera()
  {
   if($this->session->userdata('tipo')==2)
   {
    $datos['consulta'] = $this->pacientes_model->get_pacientesVistaEnfermero();
    $datos['base']=base_url();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/esperaAjax', $datos);
    
   }else
   {
    redirect('login');
   }
  }
/*****METODO PARA CARGAR LOS DATOS DE LOS DERECHOHABIENTES EN ESTADO DE ESPERA EN TIEMPO REAL********/
  public function ajax_Enfermero()
  {
   $consultaa= $this->pacientes_model->get_pacientesVistaEnfermero();
   $html=" ";
  if($consultaa != null):
  $html='

  <table class="table table-bordered">

  <thead>
   <tr>
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;" >NOMBRE</th>
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;" >APELLIDO</th>
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;" >TIPO PACIENTE</th>
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">CLASIFICACIÓN</th>
   
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">DESCRIPCIÓN</th>
    <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">TIEMPO ESPERA</th>
    
   </tr>
  </thead>

  <tbody>';
  $base=base_url();
  foreach ($consultaa->result() as $fila):
  $html= $html.'

   <tr>                                              
    <input type="hidden" name="id_doctor" id="id_doctor" value="'.$this->session->userdata("id_doctor").'">                 
    <input type="hidden" name="nombre"   id="nombre'.$fila->id_consulta_paciente.'" value="'.$fila->nombre.'">
    <input type="hidden" name="apellido"   id="apellido'.$fila->id_consulta_paciente.'" value="'.$fila->apellido_paterno.'">
    <input type="hidden" name="tipo_paciente"   id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">
    <input type="hidden" name="clasificacion"   id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
    <input type="hidden" name="descripcion"   id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
     
    <th><label>'.$fila->nombre.'</label></th>                
    <th><label>'.$fila->apellido_paterno.'</label></th>';

    $hola;
    $clasifica=$fila->go;
    
    if($clasifica==1){
      $hola = "/G-O";
    }else {
      $hola = " ";
    }
    $html= $html.'
    <th style=" text-align: center;">
    <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\" >'.$fila->tipo.' '.$hola.'</label>
    </th>';
    
                 
    $clasifica=$fila->clasificacion;
    if($clasifica==1){
    $html= $html.'
    <th style=" text-align: center;">
     <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold;" >VERDE</button>
    </th>';
    }elseif($clasifica==2){
    $html= $html.'
    <th style=" text-align: center;">
    <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; width:100px;color:black;font-weight: bold;" >AMARILLO</button>
    </th>';
    }elseif ($clasifica==3){
    $html= $html.'
    <th style=" text-align: center;">
    <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold;" >ROJO</button>
    </th>';
    }
    $html= $html.'
    <th >
    <label>'.$fila->descripcion.'</label>
    </th>                
    
    <th style=" text-align: center;">';
    date_default_timezone_set('America/Cancun');
    $horaini=$fila->hora_llegada;
    $horai=substr($horaini,0,2);
    $mini=substr($horaini,3,2);
    $segi=substr($horaini,6,2);
    $hoy= date('H:i:s', strtotime('- '.$horai.' hours - '.$mini.' minutes - '.$segi.' seconds'));
    $html= $html . $hoy.'
    </th>                         
   </tr>                  
  ';                     
  endforeach; 
  $html= $html . '
  </tbody> 
  </table>';
  endif;
  echo $html;
  }


/*****METODO PARA CARGAR LA VISTA DE LOS DERECHOHABIENTES QUE ESTEN EN CONSULTORIO********/
  Public function consultorio()
  {
   if($this->session->userdata('tipo')==2)
   {
    $datos['consulta'] = $this->pacientes_model->get_pacientesVistaEnfermero();
    $datos['base']=base_url();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/consultorio', $datos);
   }else
   {
    redirect('login');
   }
  }
/******METODO PARA CARGAR LOS DATOS DE LOS DERECHOHABIENTES QUE ESTEN CONSULTORIO EN TIEMPO REAL*******/
  public function consultorio_ajax()
    {
       $consultaa= $this->pacientes_model->get_pacientesVistaConsulta();
       $html=" ";
       if($consultaa != null):
        $html='

      <table class="table table-bordered">

        <thead>
           <tr>
            <th class="doctor_tabla" >NOMBRE</th>
            <th class="doctor_tabla" >APELLIDO</th>
            <th class="doctor_tabla" >TIPO PACIENTE</th>
            <th class="doctor_tabla" >CLASIFICACIÓN</th>
            <th class="doctor_tabla" >DESCRIPCIÓN</th>
            <th class="doctor_tabla" >DOCTOR</th>
            <th class="doctor_tabla" >CONSULTORIO</th>
           </tr>
          </thead>

    <tbody>';
        $base=base_url();
        foreach ($consultaa->result() as $fila):
          $html= $html.'     
         <tr>                                              
          <input type="hidden" name="id_doctor" id="id_doctor" value="'.$this->session->userdata("id_doctor").'">                 
          <input type="hidden" name="nombre"   id="nombre'.$fila->id_consulta_paciente.'" value="'.$fila->nombre.'">
          <input type="hidden" name="apellido"   id="apellido'.$fila->id_consulta_paciente.'" value="'.$fila->apellido_paterno.'">
          <input type="hidden" name="tipo_paciente"   id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo.'">
          <input type="hidden" name="clasificacion"   id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
          <input type="hidden" name="descripcion"   id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
          <input type="hidden" name="hora_llegada"   id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->doctor.'">  
          <th><label>'.$fila->nombre.'</label></th>                
          <th><label>'.$fila->apellido_paterno.'</label></th>';                   
          $hola;
          $tipo_pa=$fila->go;
        
          if($tipo_pa==1){
              $hola = "/G-O";
            }else {
              $hola = " ";
            }
        $html= $html.'
        <th style=" text-align: center;">
        <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\" >'.$fila->tipo.' '.$hola.'</label>
        </th>';   
          $clasifica=$fila->clasificacion;
          if($clasifica==1){
            $html= $html.'
            <th style=" text-align: center;">
             <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style=" margin-right: 8px">VERDE</button>
           </th>';
         }elseif($clasifica==2){
          $html= $html.'
          <th style=" text-align: center;">
            <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px">AMARILLO</button>
          </th>';
        }elseif ($clasifica==3){
          $html= $html.'
          <th style=" text-align: center;"> 
            <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="with:100%;">ROJO</button>
          </th>';
        }
        $html= $html.'
        <th>
          <label>'.$fila->descripcion.'</label>
        </th>                
        <th style=" text-align: center;">
          <label >'.$fila->doctor.'</label>
        </th>
        <th style=" text-align: center;">
          <label >'.$fila->consultorio.'</label>
        </th>               
      </tr>';                     
    endforeach; 
    $html= $html . '
  </tbody> 
  </table>';
  endif;
  echo $html;

  }


/******SE CARGA LA VISTA PARA VER LOS DERECHOHABIENTES FALTANTES*******/
  Public function no_asistio()
  {
   if($this->session->userdata('tipo')==2)
   {
    //sonsulta para llenar select de consultorios asignados a un doctor
    $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
    //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
    $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
    $datos['consulta'] = $this->pacientes_model->get_pacientesVistaEnfermero();
    $datos['base']=base_url();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('enfermero/header_enfermero');
    $this->load->view('enfermero/no_asistio', $datos);
   }else
   {
    redirect('login');
   }
  }

/******METODO PARA CARGAR LOS DATOS DE LOS DERECHOHABIENTES QUE FALTARON AL LLAMADO PARA SU CONSULTA EN TIEMPO REAL*******/
  public function ajax_no_asistio()
    {
     
     $consultaa= $this->pacientes_model->get_pacientesNoAsistieron();
     $html=" ";
    if($consultaa != null):
    $html='
    <table class="table table-bordered">
    
    <thead>
     <tr>
      <th class="doctor_tabla" >NOMBRE</th>
      <th class="doctor_tabla" >APELLIDO</th>
      <th class="doctor_tabla" >TIPO PACIENTE</th>
      <th class="doctor_tabla" >CLASIFICACIÓN</th>
      <th class="doctor_tabla" >RFC</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf; font-size: 12px; color: green">HORA LLEGADA</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf; font-size: 12px; color: red">HORA BAJA</th>
      <th class="doctor_tabla" >DOCTOR</th>
      <th class="doctor_tabla" >CONSULTORIO</th>
     </tr>
    </thead>

    <tbody>';
    $base=base_url();
    foreach ($consultaa->result() as $fila):
    $html= $html.'

     <tr>                                              
      <input type="hidden" name="id_doctor" id="id_doctor" value="'.$this->session->userdata("id_doctor").'">                 
          <input type="hidden" name="nombre"   id="nombre'.$fila->id_falta.'" value="'.$fila->nombre.'">
          <input type="hidden" name="apellido"   id="apellido'.$fila->id_falta.'" value="'.$fila->apellido.'">
          <input type="hidden" name="tipo_paciente"   id="tipo_paciente'.$fila->id_falta.'" value="'.$fila->tipo_paciente.'">
          <input type="hidden" name="clasificacion"   id="clasificacion'.$fila->id_falta.'" value="'.$fila->clasificacion.'">
          <input type="hidden" name="descripcion"   id="descripcion'.$fila->id_falta.'" value="'.$fila->rfc.'">
          <input type="hidden" name="hora_llegada"   id="hora_llegada'.$fila->id_falta.'" value="'.$fila->hora_llegada.'">  
          <th ><label>'.$fila->nombre.'</label></th>                
          <th ><label>'.$fila->apellido.'</label></th>
          <th ><label>'.$fila->tipo_paciente.'</label></th>
          ';                   
              
          $clasifica=$fila->clasificacion;
          if($clasifica==1){
            $html= $html.'
            <th class="text-center">
             <button name="clasificacion" id="clasificacion"'.$fila->id_falta.'"" type="button" disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">VERDE</button>
           </th>';
         }elseif($clasifica==2){
          $html= $html.'
          <th class="text-center">
            <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_falta.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">AMARILLO</button>
          </th>';
        }elseif ($clasifica==3){
          $html= $html.'
          <th class="text-center">
            <button name="clasificacion" id="clasificacion"'.$fila->id_falta.'"" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">ROJO</button>
          </th>';
        }
        $html= $html.'
        <th class="text-center">
          <label>'.$fila->rfc.'</label>
        </th>                
        <th class="text-center">
          <label >'.$fila->hora_llegada.'</label>
        </th>
        <th class="text-center">
          <label >'.$fila->hora_baja.'</label>
        </th>
        <th class="text-center">
          <label >'.$fila->doctor.'</label>
        </th>
        <th class="text-center">
          <label >'.$fila->consultorio.'</label>
        </th>               
      </tr>';
    endforeach; 
    $html= $html . '
    </tbody> 
    </table>';
    endif;
    echo $html;
            
    }





}
?>