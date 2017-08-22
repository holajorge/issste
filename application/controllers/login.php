<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Login extends CI_Controller {

   public function __construct() 
   {
    parent::__construct();
    /******SE CARGA EL MODELO PARA HACER USO DE LA BASE DE DATOS*******/
    $this->load->model('crudperfiles_model');
  }

  /******METODO QUE CARGA LA VISTA DEL LOGIN DEL SISTEMA (AQUI INICIA TODO)*******/
  public function index()
  {

    $data['error'] = $this->session->flashdata('error');
    $this->load->view('login/headerLogin');
    $this->load->view('login/index', $data);

  }

  /******METODO PARA ERRORES EN CASO DE QUE EL USUARIO SE CONFUNDA O INTENTE INGRESAR A OTRA DIRECCION DE SISTEMA*******/
  public function error()
  {

    if ($this->session->userdata('tipo')==5) {
      redirect('admin');
    }
    if ($this->session->userdata('tipo')==1) {
      redirect('doctor');
    }
    if ($this->session->userdata('tipo')==2) {
      redirect('enfermero');
    }
    if ($this->session->userdata('tipo')==4) {
      redirect('urgenciologo');
    }

  }

  /******METODO QUE AUTENTIFICA O VALIDA SI UN USUARIO ESTA DADO DE ALTA EN EL SISTEMA*******/
  public function autentificarUser() 
  {

    if ($this->input->post()) 
    {
      $username = $this->input->post('usuario');
      $password = $this->input->post('password');
      
      $fila =  $this->crudperfiles_model->autentificarAdmin($username, $password);

      if($fila)
      {     
        $tipo=$fila->tipo_usuario;
        
        if($tipo==2){

          $data = array(
            'id_enfermero'   =>  $fila->id_enfermero,
            'nombre'   =>  $fila->nombre,
            'apellido'   =>  $fila->apellido,
            'logueado' =>TRUE,
            'tipo'=>2
            );
          $this->session->set_userdata($data);
          redirect('login/logueadoEnfermero');

        }else if($tipo==1){
          $data = array(
            'id_doctor'   =>  $fila->id_doctor,
            'nombre'   =>  $fila->nombre,
            'apellido'   =>  $fila->apellido,
            'id_consultorio' =>  $fila->id_consultorio,
            'logueado' =>TRUE,
            'tipo'=>1
            );
          $this->session->set_userdata($data);
          redirect('login/logueadoDoctor');
          
        }else if($tipo==5){
          $data = array(
            'id_administrador'   =>  $fila->id_administrador,
            'nombre'   =>  $fila->nombre,
            'apellido'   =>  $fila->apellido,
            'logueado' =>TRUE,
            'tipo'=>5
            );
          $this->session->set_userdata($data);
          redirect('login/logueadoAdmin');
        }else if($tipo==4){
          $data = array(
            'id_doctor'   =>  $fila->id_doctor,
            'nombre'   =>  $fila->nombre,
            'apellido'   =>  $fila->apellido,
            'id_consultorio' =>  $fila->id_consultorio,
            'logueado' =>TRUE,
            'tipo'=>4
            );
          $this->session->set_userdata($data);
          redirect('login/logueadoUrgenciologo');
        }

      } 
      else{     
       $this->session->set_flashdata('error', '<strong>Usuario o Contraseña Incorrecto</strong> *');
       redirect('login');
     }
   }else
   {

     redirect('login');              
   } 
  }

  /******METODO PARA MADAR O CARGAR DATOS DEL USUARIO A SU RESPECTIVO CONTROLADOR*******/
  public function logueadoAdmin()
  {
    if($this->session->userdata('logueado'))
    {
     
     $data['nombre'] = $this->session->userdata('nombre');
     $data['apellido'] = $this->session->userdata('apellido'); 
     redirect('admin', $data);

     
   }else{
    redirect('login');
  }
  }
  /******METODO PARA MADAR O CARGAR DATOS DEL USUARIO A SU RESPECTIVO CONTROLADOR*******/
  public function logueadoUrgenciologo()
  {
    if($this->session->userdata('logueado'))
    {       
     $data['nombre'] = $this->session->userdata('nombre');
     $data['apellido'] = $this->session->userdata('apellido'); 
     redirect('urgenciologo', $data);

   }else{
    redirect('login');
  }
  }

  /******METODO PARA MADAR O CARGAR DATOS DEL USUARIO A SU RESPECTIVO CONTROLADOR*******/
  public function logueadoDoctor()
  {
    if($this->session->userdata('logueado'))
    {
      $data['nombre'] = $this->session->userdata('nombre');
      $data['apellido'] = $this->session->userdata('apellido');  
      redirect('doctor', $data);

    }else{
      redirect('login');
    }
  }
  /******METODO PARA MADAR O CARGAR DATOS DEL USUARIO A SU RESPECTIVO CONTROLADOR*******/
  public function logueadoEnfermero()
  {
    if($this->session->userdata('logueado')){

     $data['nombre'] = $this->session->userdata('nombre');
     $data['apellido'] = $this->session->userdata('apellido'); 
     redirect('enfermero', $data);

   }else{
    redirect('login');
  }
  }
  /******METODO PARA CERRAR LA SESION DEL USUARIO CON UNA SESION INICIADA*******/
  public function cerrar_sesion() 
  {
   $this->session->sess_destroy();
   redirect('login');
  }
}
?>