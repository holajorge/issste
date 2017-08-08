<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Admin extends CI_Controller {

 public function __construct() 
   {
    parent::__construct();
    //para declarar la ruta principal
    $this->load->helper('url');
    //para cargar el form navito de codeigniter
    $this->load->helper('form');  
    //modelo para insert, update, delete (doctore, enfermeros, consultorios y reportes)
    $this->load->model('crudperfiles_model');
    //modelo para realizar consultas para mostrar pacientes en pantalla
    $this->load->model('pantalla_model');
    //libreria para PDF 
    $this->load->library('myfpdf');      
   //libreria para excel
    $this->load->library('export_excel');    
    //libreria para subir arcivos ("videos", "img", "pfd", "exc")
    $this->load->library('upload');

     $this->load->model('pacientes_model');
    $this->load->model('enfermero_model');

    $this->view_data = array();


   }


 /*
  CRUD DOCTOR
  modelo que ocupa para consultas

  usuario_model (insert, get, delete, update)

 */

public function index()
  {
     if($this->session->userdata('tipo')==5){
   $this->doctor();
 }else{
      redirect('login');
    }
  }
   
public function doctor()
  { 
    if($this->session->userdata('tipo')==5){
      //sonsulta para llenar select de consultorios asignados a un doctor
      $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
      //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
      $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
      //LLAMAR TABLA DOCTOR
      $datos['arraydortores'] = $this->crudperfiles_model->get_doctor();
      $datos['nombre'] = $this->session->userdata('nombre');
      $datos['apellido'] = $this->session->userdata('apellido'); 
      
      $this->load->view('admin/header_admin');
      $this->load->view('admin/head', $datos);
      $this->load->view('admin/indexA', $datos);
      $this->load->view('admin/footer_admin');

    }else{
      redirect('login');
    }
  }        

// metodo para agregar un nuevo doctor o medigo general.
public function new_doctor()
  {
  if($this->session->userdata('tipo')==5){
   $doctor = array(
    'nombre' => $this->input->post('nombre'),
    'apellido' => $this->input->post('apellido'),
    'correo' => $this->input->post('correo'),
    'cedula' => $this->input->post('cedula'),
    'id_consultorio' => $this->input->post('id_consultorio'),
    'username' => $this->input->post('usuario'),
    'password' => $this->input->post('password'),
    'tipo_usuario' => 1
    );
   $this->crudperfiles_model->insertDoctor($doctor);
   return true;
   }else{
    redirect('login');
   }
  }

    //metodo para actualizar los datos de un doctor
  public function update_doctor()
    {
    if($this->session->userdata('tipo')==5){
     $id     = $this->input->post('id');
     $nombre = $this->input->post('nombre');
     $apellido = $this->input->post('apellido');
     $correo = $this->input->post('correo');
     $cedula = $this->input->post('cedula');

     $consultorio = $this->input->post('consultorio');
     if($consultorio == null){
       return false;
     }

     $username = $this->input->post('usuario');
     $password = $this->input->post('password');

     $data = array(
      'nombre'   => $nombre,
      'apellido' => $apellido,
      'correo'   => $correo,
      'cedula'   => $cedula,
      'id_consultorio'   => $consultorio,
      'username' => $username,
      'password' => $password

      );

     $actualizar = $this->crudperfiles_model->updateDoctor($id, $data);
      return true;

    }else{
      redirect('login');
    }

  }


//metodo para que no se repitan los nombres de usuarios en la base de datos y asi tener un mejor control de usuarios
  public function buscaUsername()
  {
     if($this->session->userdata('tipo')==5){
    $username= $this->input->post('usuario');
     $respuesta = $this->crudperfiles_model->getUserExist($username);
     if($respuesta){
      echo 1;
     }else{
      echo 0;
     }
    }else{
      redirect('login');
    }

  }

//metodo para eliminar un doctor de la base de datos
  public function deleteDoctor()
    {
       if($this->session->userdata('tipo')==5){
     $id = $this->input->post('id');
     $this->crudperfiles_model->eliminarDoctor($id);
     redirect('admin');
     }else{
      redirect('login');
     }
    }
   
/***************FIN DE LOS METODOS PARA EL DOCTOR******************************/ 
  
/*************INICIO DE LOS METODOS PARA EL MEDICO O DOCTOR URGENCIOLOGO*******/ 

  //SE CARGA LA VISTA DE LA SESSION DEL URGENCIOLOGO
  public function urgenciologo()
      {
        if($this->session->userdata('tipo')==5){
          $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
          $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
          $datos['consultaa'] = $this->crudperfiles_model->get_Urgenciologo();
          $datos['nombre'] = $this->session->userdata('nombre');
          $datos['apellido'] = $this->session->userdata('apellido'); 

          $this->load->view('admin/header_admin');
          $this->load->view('admin/head', $datos);
          $this->load->view('admin/urgenciologo', $datos);
          $this->load->view('admin/footer_admin');
        }else{
          redirect('login');
        }
      }
   //METODO PARA CREAR O AGREGAR LOS DATOS DE UN NUEVO USUARIO URGENCIOLOGO

     public  function new_urgenciologo()
      {
       if($this->session->userdata('tipo')==5){
         $doctor = array(
          'nombre' => $this->input->post('nombre'),
          'apellido' => $this->input->post('apellido'),
          'correo' => $this->input->post('correo'),
          'cedula' => $this->input->post('cedula'),
          'id_consultorio' => $this->input->post('id_consultorio'),
          'username' => $this->input->post('usuario'),
          'password' => $this->input->post('password'),
          'tipo_usuario' => 4
          );
         $this->crudperfiles_model->insertDoctor($doctor);
         return true;
       }else{
        redirect('login');
      }
    }
   //METODO PARA ACTUALIZAR UN LOS DATOS DE UN USUARIO URGENCIOLOGO
  public function updateUrgenciologo()
      {
   if($this->session->userdata('tipo')==5){
       $id     = $this->input->post('id');
       $nombre = $this->input->post('nombre');
       $apellido = $this->input->post('apellido');
       $correo = $this->input->post('correo');
       $cedula = $this->input->post('cedula');
       $consultorio = $this->input->post('consultorio');
       $username = $this->input->post('usuario');
       $password = $this->input->post('password');

       $data = array(
        'nombre'   => $nombre,
        'apellido' => $apellido,
        'correo'   => $correo,
        'cedula'   => $cedula,           
        'id_consultorio'   => $consultorio,           
        'username' => $username,
        'password' => $password        
        );
       $actualizar = $this->crudperfiles_model->update_Urgenciologo($id, $data);
              
        return true;
       
     }else{
      redirect('login');
     }
    }

   //METODO PARA VALIDAR QUE NO SE REPITAN LOS NOMBRES DE USUARIOS EN LA BASE DE DATOS
    public function buscaUsernameU()
    {
     if($this->session->userdata('tipo')==5){
      $username= $this->input->post('usuario');
      $respuesta = $this->crudperfiles_model->getUserExistU($username);
      if($respuesta){
        echo 1;
      }else{
        echo 0;
      }
    }else{
      redirect('login');
     }
   }
 
    //METODO PARA ELIMINAR UN USUARIO URGENCIOLOGO EN LA BASE DE DATOS
    public function eliminarUrgenciologo()
      {
        if($this->session->userdata('tipo')==5){
           $id = $this->input->post('id');
           $this->crudperfiles_model->eliminarUrgenciologo($id);

         redirect('admin/urgenciologo');

        }else{
          redirect('login');
        }
      }

/************************FIN DE LOS METODO PARA EL URGENCIOLOGO*********/ 

/***********************INICIO DE LOS METODO PARA EL ENFERMERO**********/ 

   //SE CARGA LA VISTA DEL INICIO DE SESION DEL ENFERMERO
    public function Enfermero()
      {
        if($this->session->userdata('tipo')==5){
         $data['consulta']  = $this->crudperfiles_model->get_enfermeros();
         $data['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
         $data['nombre'] = $this->session->userdata('nombre');
         $data['apellido'] = $this->session->userdata('apellido'); 
         $this->load->view('admin/header_admin');
         $this->load->view('admin/head', $data);
         $this->load->view('admin/enfermeroA', $data);
         $this->load->view('admin/footer_admin');
       }else{
        redirect('login');
       }
      }
    //METODO PARA AGREGAR UN ENFEMERO EN LA BASE DE DATOS
    public function new_enfermero()
    {  
     if($this->session->userdata('tipo')==5){
      $enfermero = array(
        'nombre' => $this->input->post('nombre'),
        'apellido' => $this->input->post('apellido'),
        'correo' => $this->input->post('correo'),
        'cedula' => $this->input->post('cedula'),
        'username' => $this->input->post('usuario'),
        'password' => $this->input->post('password'),
        'tipo_usuario' =>2
        );
      $this->crudperfiles_model->insertEnfermero($enfermero);
       return true;
      }else{
        redirect('login');
      }
    }
 
  //METODO PARA ACTUALIZAR LOS DATOS DE UN ENFERMERO YA APREVIAMENTE AGREGADO A LA BASE DE DATOS
  public function update_enfermero()
    {
      if($this->session->userdata('tipo')==5){
       $id     = $this->input->post('id');
       $nombre = $this->input->post('nombre');
       $apellido = $this->input->post('apellido');
       $correo = $this->input->post('correo');
       $cedula = $this->input->post('cedula');
       $username = $this->input->post('usuario');
       $password = $this->input->post('password');

       $data = array(

      'nombre'   => $nombre,
      'apellido' => $apellido,
      'correo'   => $correo,
      'cedula'   => $cedula,
      'username' => $username,
      'password' => $password

      );

     $actualizar = $this->crudperfiles_model->updateEnfermero($id, $data);

     if($actualizar)
     {
       redirect('admin/Enfermero');

     }
     else
     {
      return false;
     }
    }else{
      redirect('login');
    }
  }

 //METODO PARA ELEIMINAR UN ENFERMERO DE LA BASE DE DATOS
  public function deleteEnfermero()
    {
    if($this->session->userdata('tipo')==5){
     $id = $this->input->post('id');
     $this->crudperfiles_model->eliminarEnfermero($id);
     redirect('admin/enfermero');
    }else{
     redirect('login');
    }
  }

  //METODO PARA VALIDAR UN SI NO EXISTE UN ENFERMERO CON EL MISMO NOMBRE DE USUARIO CON LA FINALIDAD DE TENER UN MEJOR CONTROL
  public function buscaUsernameEfermero()
  {
     if($this->session->userdata('tipo')==5){
    $username= $this->input->post('usuario');
     $respuesta = $this->crudperfiles_model->getUserExistEnfermero($username);
     if($respuesta){
      echo 1;
     }else{
      echo 5;
     }
   }else{
    redirect('login');
   }
  }

/*********************FIN DE LOS METODOS PARA EL MODULO DE ENFERMERO*************/ 

/*********************INICIO DE LOS METODOS DEL MODULO DE CONSULTORIO************/ 

  //SE CARGA LA VISTA PARA MOSTRAR LOS CONSULTORIOS AGREGADOS A LA BASE DE DATOS.
  public function Consultorio()
    {
     if($this->session->userdata('tipo')==5)
     {
       $data1['consulta1']  = $this->crudperfiles_model->get_consultorio();
       $data1['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
       $data1['nombre'] = $this->session->userdata('nombre');
       $data1['apellido'] = $this->session->userdata('apellido'); 
       $this->load->view('admin/header_admin');
       $this->load->view('admin/head', $data1);
       $this->load->view('admin/consultorioA', $data1);
       $this->load->view('admin/footer_admin');
     }else{
      redirect('login');
     }
    }
 //METODO PARA AGREGAR UN NUEVO CONSULTORIO A LA BASE DE DATOS.
  public function new_consultorio()
    {
       if($this->session->userdata('tipo')==5){
      $consultorio = array(
      'nombre' => $this->input->post('nombre'),
      'ubicacion' => $this->input->post('ubicacion')
      );
      $this->crudperfiles_model->insertConsultorio($consultorio);
      redirect('admin/Consultorio');
    }else{
      redirect('login');
    }
  }
  //METODO PARA VALIDAR QUE NO EXISTAN MAS DE UN CONSULTORIO CON EL MISMO NOMBRE
  public function buscaUsernameC()
  {
     if($this->session->userdata('tipo')==5){
    $nombre= $this->input->post('nombre');
     $respuesta = $this->crudperfiles_model->getUserExistEConsultorio($nombre);
     if($respuesta){
      echo 1;
     }else{
      echo 5;
     }
    }else
    {
        redirect('login');
    } 
  }
   //METODO PARA ACTUALIZAR UN LOS DATOS DE UN CONSULTORIO EN LA BASE DE DATOS
  public function update_consultorio()
    {
         if($this->session->userdata('tipo')==5){
       $id        = $this->input->post('id');
       $nombre    = $this->input->post('nombre');
       $ubicacion = $this->input->post('ubicacion');

       $data = array(
        'nombre'    => $nombre,
        'ubicacion' => $ubicacion
        );

       $update = $this->crudperfiles_model->updateConsultorio($id, $data);

       if($update)
       {
        redirect('admin/Consultorio');
       }
       else
       {
        return false;
       }
      }else{redirect('login');}
    }

 //METODO PARA ELIMINAR UN CONSULTORIO DE LA BASE DE DATOS.
  public function deleteConsultorio()
    {
     if($this->session->userdata('tipo')==5){
      $id = $this->input->post('id');
      $this->crudperfiles_model->eliminarConsultorio($id);
      redirect('admin/Consultorio');
      return truen;
      }else{redirect('login');}
    }


/********************FIN DE LOS METODOS DE MODULO DE CONSULTORIO*************/ 


/*********************INICIO DE LOS METODOS DE REPORTES**********************/ 
  //METODO PARA IMPRIMIR UN REPORTE DE UN RANGO DE FECHAS EN EXCEL
  public function reporte()
      {
         if($this->session->userdata('tipo')==5){
        $fecha1 = $this->input->post('fechaInicio');
        $fecha2 = $this->input->post('fechaFin');

        $dataa['inicio'] = $this->input->post('fechaInicio');
        $dataa['fin'] = $this->input->post('fechaFin');       

        $dataa = $this->crudperfiles_model->obtenerReporteFechas($fecha1, $fecha2);
        $this->export_excel->to_excel($dataa, 'Reporte_de_Derechohabientes');
        //SOR SI QUIEREN IMPRIMIR UN REPORTE CON PDF
        //$this->load->view('admin/rpdf', $dataa);
       }else{redirect('login');}
      }
  //METODO PARA IMPRIMIR UN REPORTE CON UN RANGO DE FECHAS POR DOCTOR
  public function reportDoctor()
      {
         if($this->session->userdata('tipo')==5){
        $date1=$this->input->post('fechaInicio');  
        $date2=$this->input->post('fechaFin');   
        $id_doctor=$this->input->post('id_doctor');    
        $dataa = $this->crudperfiles_model->reporteDoctor($id_doctor,$date1,$date2);
        $this->export_excel->to_excel($dataa, 'Reporte_de_pacientes_por_Medico');
        //SOR SI QUIEREN IMPRIMIR UN REPORTE CON PDF
        //$this->load->view('admin/rpdf_doctor', $dataa);
        }else{redirect('login');}
      }
  //METODO PARA IMPRIMIR LOS DERECHOHABIENTES QUE SON FALTANTES EN UN RANGO DE FECHAS EN FORMATO EXCEL
  public function faltantes()
      {
         if($this->session->userdata('tipo')==5){
        $fecha1 = $this->input->post('fechaInicio');
        $fecha2 = $this->input->post('fechaFin');


        $dataa['inicio'] = $this->input->post('fechaInicio');
        $dataa['fin'] = $this->input->post('fechaFin');       

        $dataa = $this->crudperfiles_model->obtenerReporteFechas_faltantes($fecha1, $fecha2);
        $this->export_excel->to_excell($dataa, 'Reporte_de_Derechohabientes_Faltantes');
        //SOR SI QUIEREN IMPRIMIR UN REPORTE CON PDF
        //$this->load->view('admin/rpdf', $dataa);
       }else{redirect('login');}
      }

/********************FIN DE LOS METODOS PARA REPORTES***********************/ 

/******METODO PORA CARGAR LA VISTA PARA CARGAR O SUBIR UN VIDEO*******/
public function videos()
    {

     if($this->session->userdata('tipo')==5){  
       // $datos['consultaVideos']  = $this->crudperfiles_model->get_videos();
       //sonsulta para llenar select de consultorios asignados a un doctor
      $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
      //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
      $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
      //LLAMAR TABLA DOCTOR
       $datos['nombre'] = $this->session->userdata('nombre');
       $datos['apellido'] = $this->session->userdata('apellido');
       $this->load->view('admin/header_admin');
       $this->load->view('admin/head', $datos);
       $this->load->view('admin/videos', $datos);
       // $this->load->view('admin/footer_admin');
      }else{
       redirect('login');
      }
    }

  /******METODO COMPLEMENTARIO PARA CARGAR EL VIDEO*******/
    public function save()
    {

       $this->do_upload();
       $this->crudperfiles_model->nuevo_video($url);
       
    }

/******METODO QUE RECIBE EL VIDEO*******/
  public function do_upload()
    {

    if($this->session->userdata('tipo')==5)
    {
      $dirname = dirname('uploads/pantalla.mp4');

      $type = explode('.', $_FILES["pic"]["name"]);
      $type = $type[count($type)-1];
      $field_name = "pantalla";

      $url = "./uploads/".$field_name.'.'.$type;
      if(in_array($type, array("mp4", "avi", "flv" , "wmv")))
      if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
        move_uploaded_file($_FILES["pic"]["tmp_name"], $url);
        
      redirect('admin/videos'); 
      return true;

     }else{
      redirect('login');
     }
    }

/******METODO QUE MUESTRA LAS PACIENTES QUE ESTAN EN LA LISTA DE ESPERA PARA CONSULTA EN LA SESION DEL ADMINISTRADOR******/
  Public function espera()
  {
   if($this->session->userdata('tipo')==5)
   {
    //sonsulta para llenar select de consultorios asignados a un doctor
    $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
    //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
    $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
    $datos['consulta'] = $this->pacientes_model->get_pacientesVistaenfermero();
    $datos['base']=base_url();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('admin/header_admin');
    
    $this->load->view('admin/esperaAjax', $datos);
   }else
   {
    redirect('login');
   }
  }
/******METODO QUE MUESTA LOS DOTOS DE LOS PACIENTES *******/
  public function ajax_enfermero()
  {
     if($this->session->userdata('tipo')==5)
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
       
      <th ><label>'.$fila->nombre.'</label></th>                
      <th><label>'.$fila->apellido_paterno.'</label></th>';          
      $global;         
      $tipoP = $fila->go; 
      if ($tipoP == 1 ) {
            $global = " / GO";
          }else{
            $global = "";
          }    
      $html = $html.' <th class="text-center"><label>'.$fila->tipo.$global.'</label></th> ';        
      $clasifica=$fila->clasificacion;
      if($clasifica==1){
      $html= $html.'
      <th style=" text-align: center;">
       <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold;">VERDE</button>
      </th>';
      }elseif($clasifica==2){
      $html= $html.'
      <th style=" text-align: center;">
      <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; width:100px;color:black;font-weight: bold;" ">AMARILLO</button>
      </th>';
      }elseif ($clasifica==3){
      $html= $html.'
      <th style="text-align: center;">
      <button name="clasificacion"  id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold;"  >ROJO</button>
      </th>';
      }
      $html= $html.'
      <th>
      <label class="text-center">'.$fila->descripcion.'</label>
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

     }else{
          redirect('login');
         }

  }


/******METODO QUE MUSTRA LOS DERECHOHABIENTES QUE ESTAN EN CONSULTORIO EN TIEMPO REAL CON LA FINALIDAD DE 
LOCALIZAR UN DERECHOHABIENTE*******/
  Public function enconsultorio()
  {
   if($this->session->userdata('tipo')==5)
   {
    //sonsulta para llenar select de consultorios asignados a un doctor
    $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
    //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
    $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
    $datos['consulta'] = $this->pacientes_model->get_pacientesVistaEnfermero();
    $datos['base']=base_url();
    $datos['nombre'] = $this->session->userdata('nombre');
    $datos['apellido'] = $this->session->userdata('apellido');
    $this->load->view('admin/header_admin');
    $this->load->view('admin/consultorio', $datos);
   }else
   {
    redirect('login');
   }
  }
/******METOD QUE MUESTRA LOS DATOS DE LOS DERECHOHABIENTES QUE ESTAN EN CONSULTORIO EN TIEMPO REAL*******/
  public function consultorio_ajax()
    {
       if($this->session->userdata('tipo')==5)
   {
       $consultaa= $this->pacientes_model->get_pacientesVistaConsulta();
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
        <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">DOCTOR</th>
        <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">CONSULTORIO</th>
        
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
          <input type="hidden" name="tipo_paciente"   id="tipo_paciente'.$fila->id_consulta_paciente.'" value="'.$fila->tipo_paciente.'">
          <input type="hidden" name="clasificacion"   id="clasificacion'.$fila->id_consulta_paciente.'" value="'.$fila->clasificacion.'">
          <input type="hidden" name="descripcion"   id="descripcion'.$fila->id_consulta_paciente.'" value="'.$fila->descripcion.'">
          <input type="hidden" name="hora_llegada"   id="hora_llegada'.$fila->id_consulta_paciente.'" value="'.$fila->doctor.'">  
          <th ><label>'.$fila->nombre.'</label></th>                
          <th ><label>'.$fila->apellido_paterno.'</label></th>';                   
          $tipoP = $fila->tipo_paciente;
          if ($tipoP == 1) {
            $html= $html.'
            <th class="text-center">
              <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\" value=\"niño\">NIÑO</label>
            </th>';
          }elseif($tipoP==2){
            $html= $html.'
            <th class="text-center">
              <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\">JOVEN</label>
            </th>';
             }elseif($tipoP==3){
            $html= $html.'
            <th class="text-center">
              <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\">ADULTO</label>
            </th>';
          }elseif ($tipoP==4) {
            $html= $html.'
            <th class="text-center">
              <label  name=\"tipo_paciente\" id=\"tipo_paciente"'.$fila->id_consulta_paciente.'"\">G-O</label>
            </th>';
          }                
          $clasifica=$fila->clasificacion;
          if($clasifica==1){
            $html= $html.'
            <th class="text-center">
             <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-success" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">VERDE</button>
           </th>';
         }elseif($clasifica==2){
          $html= $html.'
          <th class="text-center">
            <button name=\"clasificacion\" id=\"clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-warning" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">AMARILLO</button>
          </th>';
        }elseif ($clasifica==3){
          $html= $html.'
          <th class="text-center">
            <button name="clasificacion" id="clasificacion"'.$fila->id_consulta_paciente.'"" type="button" disabled class="btn btn-danger" style="margin-right: 8px; width:100px;color:black;font-weight: bold; ">ROJO</button>
          </th>';
        }
        $html= $html.'
        <th >
          <label>'.$fila->descripcion.'</label>
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
   }else{
        redirect('login');
      }
  }

/******METODO QUE MUESTRA LOS DATOS DE LOS DERECHOHABIENTES QUE NO ASISTEN A SU CONSULTA CUANDO SON LLAMADOS POR EL DOCTOR*******/
    Public function no_asistio()
    {
     if($this->session->userdata('tipo')==5)
     {
      //sonsulta para llenar select de consultorios asignados a un doctor
      $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
      //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
      $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
      $datos['consulta'] = $this->pacientes_model->get_pacientesVistaEnfermero();
      $datos['base']=base_url();
      $datos['nombre'] = $this->session->userdata('nombre');
      $datos['apellido'] = $this->session->userdata('apellido');
      $this->load->view('admin/header_admin');
     
      $this->load->view('admin/no_asistio', $datos);
     }else
     {
      redirect('login');
     }
    }

/******METODO PARA MOSTRAR LOS DATOS DE LOS DERECHOHABIENTES EN TIEMPO REAL*******/
    public function ajax_no_asistio()
      {
       
       $consultaa= $this->pacientes_model->get_pacientesNoAsistieron();
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
        <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">RFC</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">HORA LLEGADA</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">HORA BAJA</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">DOCTOR</th>
      <th class="text-center" style="font-family: Areal; background-color: #bfbfbf;">CONSULTORIO</th>
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
            <th class="text-center"><label>'.$fila->tipo_paciente.'</label></th>';                   
             
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

/*****METODO PARA MOSTRAR LOS DATOS DE LOS DERECHOHABIENTES QUE YA FUERON CONSULTADOS POR DIA********/
    public function consultados()
    {
     if($this->session->userdata('tipo')==5){
          //sonsulta para llenar select de consultorios asignados a un doctor
          $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
          //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
          $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
          //LLAMAR TABLA DOCTOR
          $datos['arraydortores'] = $this->crudperfiles_model->get_doctor();
          $datos['nombre'] = $this->session->userdata('nombre');
          $datos['apellido'] = $this->session->userdata('apellido'); 
          
          $this->load->view('admin/header_admin');
          $this->load->view('admin/head', $datos);
          $this->load->view('admin/consultados', $datos);

        }else{
          redirect('login');
        }

    }
/******METODO PARA ELIMINAR A LOS DERECHOHABIENTES DE LA BASE DE DATOS *******/
    public function eliminar()
        {
          if($this->session->userdata('tipo')==5){
          //sonsulta para llenar select de consultorios asignados a un doctor
          $datos['arrConsul'] = $this->crudperfiles_model->get_consultorio_select();
          //LLENAR EL SECT PARA IMPLIMIR REPORTE DOCTOR
          $datos['arrConsulDoctor'] = $this->crudperfiles_model->get_doctor_select();
          //LLAMAR TABLA DOCTOR
          $datos['arraydortores'] = $this->crudperfiles_model->get_doctor();
         
          $datos['nombre'] = $this->session->userdata('nombre');
          $datos['apellido'] = $this->session->userdata('apellido'); 
          $this->load->view('admin/header_admin');
          $this->load->view('admin/eliminar', $datos);
          $this->load->view('admin/footer_admin');

        
          }else{
          redirect('login');
          }
        }


/******METODO PARA MOSTRAR LOS DATOS DE LOS DERECHOHABIENTES DE LA TABLA DE PACIENTES EN LA BASE DE DATOS*******/
  public function mostrar()
   {

      $buscar = $this->input->post("buscar");
      $numeropagina = $this->input->post("nropagina");
      $cantidad = $this->input->post("cantidad");
      
      $inicio = ($numeropagina -1)*$cantidad;
      $data = array(
     
        "clientes" => $this->enfermero_model->buscarEliminar($buscar,$inicio,$cantidad),
        "totalregistros" => count($this->enfermero_model->buscar($buscar)),
        "cantidad" =>$cantidad
        
      );
      
      echo json_encode($data);
   }
   /******METODO PARA ELIMINAR A LOS DERECHOHABIENTES DE LA BASE DE DATOS *******/
   public function eliminarDerechohabiente()
   {
      if($this->session->userdata('tipo')==5){
       $id = $this->input->post('id');
       $this->crudperfiles_model->eliminarDerechohabiente($id);
       //redirect('admin');
       return true;
       }
       else{
        redirect('login');
       }

   }


   public function grafica()
   {

     $series_data['nombre'] = $this->session->userdata('nombre');
     $series_data['apellido'] = $this->session->userdata('apellido'); 


    $year = date("Y");
    $month = date("m");
    
    $series_data['verde'] = $this->crudperfiles_model->test_fecha($year, $month);
    $series_data['amarillo'] = $this->crudperfiles_model->dos_clasificion($year, $month);
    $series_data['rojo'] = $this->crudperfiles_model->tres_clasificion($year, $month);
    // $this->view_data['series_data'] = json_encode($series_data);
 
    $this->load->view('admin/grafica', $series_data);
   }

/*METODO OBTIENE LOS DATOS INGRESADOS POR EL USUARIO Y CONSULTA A LA BASE DE DATOS*/ 
  
  public function get_estadisticas()
  {

    $month = $this->input->post('month');
    $year = $this->input->post('year');

    $series_data =  $this->crudperfiles_model->graficaFechas($year, $month);

    echo json_encode($series_data);
    
  }
  public function searchMeYear(){

    if($this->session->userdata('tipo')==5){

    $yaer= $this->input->post('year');

     $respuesta = $this->crudperfiles_model->getNotExistYear($yaer);
     if($respuesta){
        echo 1;
     }else{
        echo 5;
     }
    }else
    {
        redirect('login');
    } 
  }

  public function getEstadisticsForYear()
  {
    $no = false;

    $year = $this->input->post('year');

    $series_data =  $this->crudperfiles_model->graficAlonYear($year);

    if ($series_data == true) {
      echo json_encode($series_data);
    }else{
      return $no;
    }
    
    
  }

}
?>