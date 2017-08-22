<?php
class Crudperfiles_model extends CI_Model {
   
  //aqui es donde se hace uso de la base datos "urgencias"
 public  function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

// este metodo funciona para validar si ya existe un usuario con el mismo nombre 
// va dirijido al doctor con la finalidad de que no se petitan nombres 
 public function getUserExist($username)
 {
    $query= $this->db->query("select * from doctor where username='".$username."'");
      
    if ($query -> num_rows() > 0){
      return true;
    }else{
     return false;

    }
 }

 //metodo para comprovar la exisitencia un usuario con el mismo nombre clave para acceder al sistema
 //afendo a la tabla de enfermero

  public function getUserExistEnfermero($username)
 {
      $query= $this->db->query("select * from enfermero where username='".$username."'");
             
    if ($query -> num_rows() > 0){
      return true;
    }else{
     return false;
    }
 }

//metodo para comprovar la exisitencia un usuario con el mismo nombre clave para acceder al sistema
 //afendo a la table de urgenciologo
  public function getUserExistU($username)
 {
      $query= $this->db->query("select * from doctor where username='".$username."'");
             
    if ($query -> num_rows() > 0){
      return true;
    }else{
     return false;
    }
 }

 //metodo para comprovar la exisitencia un usuario con el mismo nombre clave para acceder al sistema
 //afendo al urgenciologo
  public function getUserExistEConsultorio($nombre)
 {
      $query= $this->db->query("select * from consultorio where nombre='".$nombre."'");
             
    if ($query -> num_rows() > 0){
      return true;
    }else{
     return false;
    }
 }


// este metodo compreba la exisistencia del nombre de usuario y contraseña de cada usuairo de sistema

public function autentificarAdmin($username , $password)
  {
     $query = $this->db->query("
        SELECT id_administrador, nombre, apellido, administrador.tipo_usuario 
        from users, administrador 
        where users.tipo_usuario = administrador.tipo_usuario and administrador.username = '".$username."' and  administrador.password = '".$password."' ");

      $consulta = $query;

      $resultado = $consulta->row();
      if($resultado){
        return $resultado;  
    }else{
        return $this->loginDoctor($username,$password);
    }
    
}

// en el codigo enterio ejecuta un salto de metodo si no encontro  los datos en una tabla busca en otras 

public function loginDoctor($username , $password)
{
  $query = $this->db->query("
        SELECT doctor.id_doctor, doctor.nombre, apellido, doctor.tipo_usuario, doctor.id_consultorio 
        from users, doctor , consultorio 
        where users.tipo_usuario = doctor.tipo_usuario and doctor.username = '".$username."' and  doctor.password = '".$password."' and doctor.id_consultorio=consultorio.id_consultorio ");

      $consulta = $query;
  $resultado = $consulta->row();

  if($resultado){
    return $resultado;  
}else{
    return $this->loginEnfermero($username,$password);
}

}

// en el codigo enterio ejecuta un salto de metodo si no encontro  los datos en una tabla busca en otras 
public function loginEnfermero($username , $password)
{
   $query = $this->db->query("
        SELECT id_enfermero, nombre, apellido, enfermero.tipo_usuario 
        from users, enfermero 
        where users.tipo_usuario = enfermero.tipo_usuario and enfermero.username = '".$username."' and  enfermero.password = '".$password."' ");

      $consulta = $query;

  $resultado = $consulta->row();

  if($resultado){
    return $resultado;  
  }else{
      return false;
  }

}

// vista doctor para traer a los doctores registrados en la tabla de doctor para un update o delete
public function get_doctor()
{

 $query= $this->db->query("
    SELECT id_doctor, doctor.nombre as doct , doctor.apellido, correo, cedula,  consultorio.nombre as consultorio, username , password  from doctor, consultorio where doctor.tipo_usuario=1 and doctor.id_consultorio=consultorio.id_consultorio"
    );
       
  return $query;
  
}


/*
	CRUD DE PERFIL DE DOCTOR
*/ 

public function insertDoctor($datos) { 
  $this->db->insert('doctor', $datos);
}

public function updateDoctor($id, $data)
{
  $this->db->where('id_doctor',$id);
  return $this->db->update('doctor', $data);
}

public function eliminarDoctor($id)
{
  $this->db->where('id_doctor', $id);
  return $this->db->delete('doctor'); 

}

public function eliminarDerechohabiente($baja, $id)
{

  $data = array(
    'baja' => $baja,
    );

  $this->db->where('id_paciente', $id);
  return $this->db->update('pacientes', $data); 

}

/*
  FIN CRUD PERFIL DE DOCTOR
*/ 

/*******************************************************
***********************************************************/


/*
CRUD DE PERFIL URGENCIOLOGO

*/ 
public function get_Urgenciologo()
{
   $query= $this->db->query("SELECT id_doctor, doctor.nombre as doct , doctor.apellido, correo, cedula, consultorio.nombre as consultorio, username , password  from doctor, consultorio where doctor.tipo_usuario=4 and doctor.id_consultorio=consultorio.id_consultorio");
       
     return $query;
}

public function inserUrgenciologo($datos) { 
  $this->db->insert('doctor', $datos);
}
public function update_Urgenciologo($id, $data)
{
  $this->db->where('id_doctor',$id);
  return $this->db->update('doctor', $data);
}

public function eliminarUrgenciologo($id)
{
  $this->db->where('id_doctor', $id);
  return $this->db->delete('doctor'); 

}
/*
  FIN CRUD PERFIL DE URGENCIOLOGO
*/ 

/*******************************************************
***********************************************************/

/*
CRUD DE PERFIL ENFERMERO

*/ 
public function get_enfermeros()
{
  $consulta = $this->db->get('enfermero');
  
  if ($consulta -> num_rows() > 0){
    return $consulta;
}else{
 return false;
}

}
public function insertEnfermero($datos) 
{ 

 $this->db->insert('enfermero', $datos);

}

public function updateEnfermero($id, $data)
{
  $this->db->where('id_enfermero',$id);
  return $this->db->update('enfermero', $data);
}

public function eliminarEnfermero($id)
{
  $this->db->where('id_enfermero', $id);
  return $this->db->delete('enfermero'); 

}

/*
  FIN CRUD PERFIL DE ENFERMERO
*/ 

/*******************************************************
***********************************************************/

/*
CRUD DE SECCION CONSULTORIO

*/ 
public function insertConsultorio($data){$this->db->insert('consultorio', $data);}

public  function get_consultorio()
{
  $consulta1 = $this->db->get('consultorio');
  
  if ($consulta1 -> num_rows() > 0){
    return $consulta1;
}else{
 return false;
}
}
public function updateConsultorio($id, $data)
{
   $this->db->where('id_consultorio',$id);
   return $this->db->update('consultorio', $data);
}

public function eliminarConsultorio($id)
{
   $this->db->where('id_consultorio', $id);
   return $this->db->delete('consultorio'); 
}

/*
  FIN CRUD PERFIL DE CONSULTORIO
*/ 

/*******************************************************
***********************************************************/

/*
CRUD DE SECCION VIDEOS

*/ 

public function nuevo_video($video)
{

 $data = array(
          
            'file_name' => $video
        );
        return $this->db->insert('videos', $data);

}

public function get_videos()
{
  $consulta = $this->db->get('videos');
  
  if ($consulta -> num_rows() > 0){
      return $consulta;
  }else
  {
   return false;
  }
}

/*
  FIN CRUD SECCION DE VIDEOS
*/ 

/*******************************************************
***********************************************************/

/*
CONSLTAR TABLA DE CONSULTORIO PARA MOSTRAR A LA VISTA UNA SELECCION 
DE CONSULTORIO PREVIAMENTE REGUISTRADOS POR EL ADMINISTRADOR 
METODO SE PUEDE IMPLEMENTAR EN CUALQUIER OTRA VISTA
VISTA UTILIZADA: REGISTRO DE DOCTO, URGENCIOLOGO Y VISTA DE MODIFICACION UN CONSULTORIO
*/ 

 public function consultorios(){
     $query=$this->db->get('consultorio');
     if($query->num_row() > 0){
       return $query;
     }else{
       return false;
     }
   }

/*
CONSLTAR TABLA DE ENFERMEROS PARA MOSTRAR A LA VISTA DEL ADMINISTRADOR
UNA LISTA DE ENFERMEROS PREVIAMENTE REGISTRADOS POR EL ADMINISTRADOR
VISTA UTILIZADA: VISTA DE MODIFICACION UN ENFERMERO
*/ 
 public function get_consultorio_select()
   {
        // armamos la consulta
    $query = $this->db-> query('SELECT id_consultorio,nombre FROM consultorio');

        // si hay resultados
    if ($query->num_rows() > 0) {
            // almacenamos en una matriz bidimensional
      foreach($query->result() as $row)
       $arrDatos[htmlspecialchars($row->id_consultorio, ENT_QUOTES)] =  htmlspecialchars($row->nombre, ENT_QUOTES);
     
     $query->free_result();
     return $arrDatos;

   }
 }

 /*
CONSLTAR TABLA DE ENFERMEROS PARA MOSTRAR A LA VISTA DEL ADMINISTRADOR
UNA LISTA DE ENFERMEROS PREVIAMENTE REGISTRADOS POR EL ADMINISTRADOR
VISTA UTILIZADA: VISTA DE MODIFICACION UN DOCTOR
*/ 
 public function get_doctor_select()
  {
     $query = $this->db-> query('SELECT id_doctor,nombre, apellido FROM doctor');

        // si hay resultados
    if ($query->num_rows() > 0) {
            // almacenamos en una matriz bidimensional
      foreach($query->result() as $row)
       $arrDatos[htmlspecialchars($row->id_doctor, ENT_QUOTES)] =  htmlspecialchars($row->nombre,ENT_QUOTES);
     //$arrDatos[htmlspecialchars($row->id_doctor, ENT_QUOTES)] =  htmlspecialchars($row->apellido,ENT_QUOTES);
     
     $query->free_result();
     return $arrDatos;
  }
}


    /* 
    METODO PARA REPOSTE POR FECHAS O POR DOCTOR
    Devuelve la lista de alumnos que se encuentran en la tabla personalizada para imprimirlo en EXCEL
    METODO OCUPADO POR EL CONTROLADOR: 
     */

 public function obtenerReporteFechas($data, $data1)
    {       

     $query= $this->db->query("

      SELECT cp.nombre, cp.apellido_paterno, cp.apellido_materno,cp.sexo, cp.rfc,cp.vigencia, tp.tipo, cp.go, cfp.clasificacion, cp.folio, cp.fecha, cp.hora_llegada,pc.tiempo, pc.hora_atendido, d.nombre as doctor,c.nombre as consultorio 

      FROM consulta_paciente AS cp ,pacientes_consultados AS pc,doctor as d, consultorio as c, clasificacion_paciente as cfp,tipo_paciente as tp 

      WHERE cp.id_consulta_paciente = pc.id_consulta_paciente  AND cp.fecha>='".$data."' AND cp.fecha<='".$data1."' AND d.id_doctor=pc.id_doctor and d.id_consultorio=c.id_consultorio and tp.id_tipo_paciente=cp.id_tipo_paciente and cfp.id_clasificacion_paciente=cp.id_clasificacion_paciente

      ");
       
     return $query;
    }
/*****************/
 public function obtenerReporteFechas_faltantes($data, $data1)
    {       

     $query= $this->db->query("
      SELECT ft.nombre, ft.apellido, ft.rfc,  cfp.clasificacion, ft.hora_llegada, ft.hora_baja, ft.fecha, d.nombre as doctor, ct.nombre as consultorio 

      from faltantes ft, doctor d, consultorio ct, clasificacion_paciente as cfp,tipo_paciente as tp

      where ft.id_doctor=d.id_doctor and ft.fecha>='".$data."'  and ft.fecha<='".$data1."'  and d.id_consultorio=ct.id_consultorio and tp.tipo=ft.tipo_paciente and cfp.id_clasificacion_paciente=ft.clasificacion
      ");
       
     return $query;
    }

   /* Devuelve la lista de derechohabientes que un doctor atendio en un determinado rango de fechas */
 public function reporteDoctor($doc,$date1,$date2)
    {
      $query= $this->db->query("

        SELECT cp.nombre, cp.apellido_paterno,cp.apellido_materno, cp.sexo,cp.rfc,cp.vigencia, tp.tipo, cp.go, cfp.clasificacion, cp.folio,cp.fecha, cp.hora_llegada,pc.tiempo, pc.hora_atendido, d.nombre as doctor,c.nombre as consultorio 

        FROM consulta_paciente AS cp ,pacientes_consultados AS pc,doctor as d, consultorio as c, clasificacion_paciente as cfp,tipo_paciente as tp 

        WHERE cp.id_consulta_paciente = pc.id_consulta_paciente  AND cp.fecha>='".$date1."' AND cp.fecha<='".$date2."' AND d.id_doctor=pc.id_doctor and d.id_consultorio=c.id_consultorio and tp.id_tipo_paciente=cp.id_tipo_paciente and cfp.id_clasificacion_paciente=cp.id_clasificacion_paciente and pc.id_doctor=".$doc."
        ");
     return $query;
    }

    /*
    FIN DE METODO DE REPORTES
    */ 

  
  public function get_users()
     {
      $consulta = $this->db->get('consulta_paciente');
      if ($consulta -> num_rows() > 0){
          return $consulta;
        }else{
           return false;
         }
     }


// METODO PARA OBTENER COMPROBAR SI EXISTEN DATOS EN LA FECHA QUE SE ENVIE Y DEBUELVA LOS DATOS NECESARIO PARA GRAFICAR
  public function test_fecha($year, $month)
   {
       
    $query = $this->db->query("
      SELECT ROUND(((select count(*) from consulta_paciente , pacientes_consultados pc where id_clasificacion_paciente=1 and id_estado=3 and  pc.id_consulta_paciente = consulta_paciente.id_consulta_paciente and Month(consulta_paciente.fecha)=".$month." && year(fecha)=".$year." ) * 100 ) / (select count(*)  from consulta_paciente )) as resultado ");

      return $query;
          
    }

  public function dos_clasificion($year, $month)
   {
       
    $query = $this->db->query("
      SELECT ROUND(((select count(*) from consulta_paciente , pacientes_consultados pc where id_clasificacion_paciente=2 and id_estado=3 and  pc.id_consulta_paciente = consulta_paciente.id_consulta_paciente and Month(consulta_paciente.fecha)=".$month." && year(fecha)=".$year." ) * 100 ) / (select count(*)  from consulta_paciente )) as resultado ");

        return $query;
          
    }
  public function tres_clasificion($year, $month)
   {
       
    $query = $this->db->query("
      SELECT ROUND(((select count(*) from consulta_paciente , pacientes_consultados pc where id_clasificacion_paciente=3 and id_estado=3 and  pc.id_consulta_paciente = consulta_paciente.id_consulta_paciente and Month(consulta_paciente.fecha)=".$month." && year(fecha)=".$year." ) * 100 ) / (select count(*)  from consulta_paciente )) as resultado ");

        return $query;
          
    }
  public function  graficaFechas($year, $month)
   {

    $query = $this->db->query("
     SELECT round(((select count(clasificacion))/ (select count(clasificacion) from consulta_paciente))*100 )as porcentaje
     FROM consulta_paciente  
     where estado =3  and clasificacion in('1','2','3') and Month(consulta_paciente.fecha)=".$month." && year(fecha)=".$year."
      group by clasificacion
      order by clasificacion ");

    return $query->result();
   }

  public function getNotExistYear($year)
    {
      $query= $this->db->query('select * from consulta_paciente where year(fecha)="'.$year.'" ');
             
      if ($query -> num_rows() > 0){
        return true;
      }else{
       return false;
      }
   }

  public function  graficAlonYear($year)
   {

    $query = $this->db->query("
     SELECT round(((select count(id_clasificacion_paciente))/ (select count(id_clasificacion_paciente) from consulta_paciente))*100 )as porcentaje
     FROM consulta_paciente  
     where id_estado =3  and id_clasificacion_paciente in('1','2','3') and year(fecha)=".$year."
      group by id_clasificacion_paciente
      order by id_clasificacion_paciente ");

    return $query->result();
   }




 }

 ?>