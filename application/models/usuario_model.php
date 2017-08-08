<?php
class Usuario_model extends CI_Model { 
  
   public function __construct() 
   {
      parent::__construct();
      /*******SE CARGA LA CONEXION A LA BASE DE DATOS PREVIAMENTE CONFIGURADA EN EL ARCHIBO database.php**********/
      $this->load->database();
  }
/********metodo que busca que el nombre de usuario y contraseña ingresados en el login sean correctos*********/
  function usuario_por_usuario_password($username , $password)
  {
      $this->db->select('id_enfermero, nombre,tipo_usuario');
      $this->db->from('enfermero');
      $this->db->where('username', $username);
      $this->db->where('password', $password);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      if($resultado){
        return $resultado;  
    }else{
        return $this->login_doctor($username,$password);
    }
    
}
/********busca el nombre de usuario y la constraseña que se ingresaron en el login de inicio del sistema*********/
function login_doctor($username , $password)
{
  $this->db->select('id_doctor, nombre, id_consultorio, tipo_usuario');
  $this->db->from('doctor');
  $this->db->where('username', $username);
  $this->db->where('password', $password);
  $consulta = $this->db->get();
  $resultado = $consulta->row();

  if($resultado){
    return $resultado;  
}else{
    return $this->login_admin($username,$password);
}

}

/********busca el nombre de usuario y la constraseña que se ingresaron en el login de inicio del sistema*********/
function login_admin($username , $password)
{
  $this->db->select('id_administrador, nombre, tipo_usuario');
  $this->db->from('administrador');
  $this->db->where('username', $username);
  $this->db->where('password', $password);
  $consulta = $this->db->get();
  $resultado = $consulta->row();

  if($resultado){
    return $resultado;  
}else{
    return false;
}
}

/********metodo que obtiene a todos los docter en la tabla de doctores para imprimierlos en una vista*********/
function get_doctor()
{
  $consultaa = $this->db->get('doctor');
  
  if ($consultaa -> num_rows() > 0){
    return $consultaa;
}else{
 return false;
}
}
/********metodo que inserta los datos que son ingrados para crear un nuevo perfil de doctor*********/
public function insertDoctor($datos) { 
  $this->db->insert('doctor', $datos);
}

/********metodo para actualizar los datos de un doctor*********/
public function updateDoctor($id, $data)
{
  $this->db->where('id_doctor',$id);
  return $this->db->update('doctor', $data);
}
/********metodo que elimina de la base de datos un doctor*********/
public function eliminarDoctor($id)
{
  $this->db->where('id_doctor', $id);
  return $this->db->delete('doctor'); 

}

/********metodo que obtiene todos los datos de los urgenciologos*********/
function get_Urgenciologo()
{
  $consultaa = $this->db->get('urgenciologo');
  
  if ($consultaa -> num_rows() > 0){
    return $consultaa;
}else{
 return false;
}
}
/********metodo que recibe los datos enviados del controlador para un nuevo urgenciologo*********/
public function inserUrgenciologo($datos) { 
  $this->db->insert('urgenciologo', $datos);
}
/********metodo actualiza los datos de un urgenciologo*********/
public function updateUrgenciologo($id, $data)
{
  $this->db->where('id_urgenciologo',$id);
  return $this->db->update('urgenciologo', $data);
}
/********metodo un a un urgenciologo de la base de datos*********/
public function eliminarUrgenciologo($id)
{
  $this->db->where('id_urgenciologo', $id);
  return $this->db->delete('urgenciologo'); 

}


/********metodo que obtiene todos los datos de los enfermero ingresados en la tabla de enfermero*********/
function get_enfermeros()
{
  $consulta = $this->db->get('enfermero');
  
  if ($consulta -> num_rows() > 0){
    return $consulta;
}else{
 return false;
}

}
/********metodo inserta un nuevo enfermero en la tabla de enfermero*********/
public function insertEnfermero($datos) {  $this->db->insert('enfermero', $datos);}
/********metodo actualiza los datos un enfermero*********/
public function updateEnfermero($id, $data)
{
  $this->db->where('id_enfermero',$id);
  return $this->db->update('enfermero', $data);
}
/********metodo elimina los datos de un enfermero de la base de datos*********/
public function eliminarEnfermero($id)
{
  $this->db->where('id_enfermero', $id);
  return $this->db->delete('enfermero'); 

}


/********metodo que inserta los datos en la tabla consultorio para crear uno nuevo*********/
function insertConsultorio($data){$this->db->insert('consultorio', $data);}

/********metodo que obtiene los datos de los consultorios para imprimirlos en una vista*********/
public  function get_consultorio()
{
  $consulta1 = $this->db->get('consultorio');
  
  if ($consulta1 -> num_rows() > 0){
    return $consulta1;
}else{
 return false;
}
}
/********metodo para actualizar los datos de un consultorio*********/
public function updateConsultorio($id, $data)
{
   $this->db->where('id_consultorio',$id);
   return $this->db->update('consultorio', $data);
}
/********metodo para eliminar consultorio*********/
public function eliminarConsultorio($id)
{
   $this->db->where('id_consultorio', $id);
   return $this->db->delete('consultorio'); 
}


}