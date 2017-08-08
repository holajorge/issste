<?php
class Pacientes_model extends CI_Model { 

 public function __construct() 
 {
  parent::__construct();
  $this->load->database();
}
/*******metodo que obtiene los pacientes que esten en espera para ser llamados a consultorio**********/
function get_pacientesVistaEnfermero()
{  
  $query = $this->db-> query('SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno, cp.apellido_materno, tp.tipo ,cp.clasificacion, cp.go, cp.descripcion, cp.hora_llegada 
      FROM consulta_paciente cp, tipo_paciente tp 
      WHERE cp.tipo_paciente=tp.id_tipo_paciente and estado=1  
      ORDER BY cp.clasificacion DESC, cp.hora_llegada ASC');
 
  if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }
}

/********metodo que obtiene los pacientes que esten en consultorio siendo atendidos por un doctor*********/
function get_pacientesVistaConsulta()
{  
  $query = $this->db-> query('
    SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno,cp.tipo_paciente,cp.go, tp.tipo, cp.clasificacion, cp.descripcion, dc.nombre doctor, ct.nombre consultorio 
    from consulta_paciente cp, paciente_espera pe, doctor dc, consultorio ct , tipo_paciente tp
    where pe.id_consulta_paciente=cp.id_consulta_paciente and cp.tipo_paciente=tp.id_tipo_paciente and pe.id_doctor=dc.id_doctor and dc.id_consultorio=ct.id_consultorio and cp.estado=2 

    ');
 
  if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }
}

/********metodo que obtiene los datos de los pacientes que no se terminaron de consultar, esto es en el caso de que se corte la energia electrica en la clinica*********/
function get_pacientesRecuperarConsulta($doct)
{  
  $query = $this->db-> query('
    SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno,tp.tipo, cp.folio,  cp.clasificacion, cp.descripcion,cp.hora_llegada,cp.rfc, dc.nombre doctor, ct.nombre consultorio from consulta_paciente cp, paciente_espera pe, doctor dc, consultorio ct, tipo_paciente tp where pe.id_consulta_paciente=cp.id_consulta_paciente and pe.id_doctor=dc.id_doctor and dc.id_consultorio=ct.id_consultorio and cp.tipo_paciente=tp.id_tipo_paciente and cp.estado=2 and dc.nombre="'.$doct.'"

    ');
 
  if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }

}
/********se obtienen los datos para llamar a un paciente en pantalla*********/
public function monitoreollamadaInsert($nombre,$apellido,$consultorio,$fecha)
{
   $query = $this->db->query("INSERT INTO `urgencias`.`monitoreollamadas` (`nombre`, `apellido`, `consultorio`, `fecha`) VALUES ('".$nombre."', '".$apellido."', '".$consultorio."','".$fecha."');");
}
/*******metodo que obtiene los datos de los pacientes que fueron atendidos por dia**********/
public function get_consultados_hoy($doct, $hoy)
{
    $query= $this->db->query('SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno, cp.sexo,cp.go, tp.tipo, cp.clasificacion, cp.hora_llegada,pc.tiempo, pc.hora_atendido  FROM consulta_paciente AS cp ,pacientes_consultados AS pc, clasificacion_paciente as cfp,tipo_paciente as tp WHERE cp.id_consulta_paciente = pc.id_consulta_paciete  and tp.id_tipo_paciente=cp.tipo_paciente and cfp.id_clasificacion_paciente=cp.clasificacion and pc.id_doctor="'.$doct.'"  AND cp.fecha>="'.$hoy.'"');
     return $query;

}

/********obtiene los datos para imprimirlos en la sesion del urgenciologo esto si un doctor no termina de atender un paciente y ocurre un percanse como el corte de la energia electrica*********/
function get_pacientesRecuperarConsultaUR($doct)
{  
  $query = $this->db-> query('
     SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno,cp.folio, tp.tipo,cp.edad, cp.go, cp.clasificacion, cp.descripcion,cp.hora_llegada,cp.rfc, dc.nombre doctor, ct.nombre consultorio from consulta_paciente cp, paciente_espera pe, doctor dc, consultorio ct, tipo_paciente tp where  cp.tipo_paciente=tp.id_tipo_paciente  and pe.id_consulta_paciente=cp.id_consulta_paciente and pe.id_doctor=dc.id_doctor and dc.id_consultorio=ct.id_consultorio and cp.estado=2 and dc.nombre="'.$doct.'"
                          ');
 
  if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }
}
/*******metodo que obtiene los datos de los pacientes que estan en la lista de espera para ser consultados **********/
function get_pacientesVistaDoctor()
{  
  $query = $this->db-> query("
          SELECT cp.id_consulta_paciente, cp.nombre, cp.apellido_paterno, cp.rfc, cp.folio , tp.tipo, cp.go, cp.clasificacion, cp.descripcion, cp.hora_llegada  
          FROM consulta_paciente cp, tipo_paciente tp 
          WHERE  cp.tipo_paciente=tp.id_tipo_paciente and  estado = 1 and cp.clasificacion<3 ORDER BY cp.hora_llegada ASC");
 
  if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }
}

/*******metodo que obtiene los datos de los pacientes de estado de urgencia estos solo se imprime en la vista de pacientes**********/
function get_pacientesRojo()
{

 $query = $this->db-> query("SELECT cp.nombre, cp.apellido_paterno, pt.tipo,cp.folio, cp.go, cp.clasificacion, cp.rfc, cp.descripcion, cp.hora_llegada, cp.id_consulta_paciente, cp.edad  
          FROM  consulta_paciente cp, tipo_paciente pt
          WHERE  cp.tipo_paciente=pt.id_tipo_paciente  and estado = 1 and cp.clasificacion > 1
          ORDER BY cp.clasificacion=3 DESC, cp.hora_llegada ASC
          ");

 if ($query -> num_rows() > 0){
  return $query;
}else{
 return false;
}
}

/********metodo que elimina por completo al paciente en caso de que no asista al consultorio cuando sera llamado por el doctor*********/
function eliminarConsultaEsperaD($id)
{
  $this->db->where('id_consulta_paciente', $id);
  return $this->db->delete('consulta_paciente'); 
}
/*******metodo que obtiene la fecha mas actual de la tabla de paciente_espera con el objetivo de segui actualizando esta tabla en caso de que no sea la fecha mas actual o del dia de ejecucion entonces se elimina los datos de esta tabla**********/
public function getDate()
{
  $query = $this->db-> query("SELECT max(fecha) fecha from paciente_espera ");

 if ($query -> num_rows() > 0){
  return $query->result()[0]->fecha;
}else{
 return false;
}

}
/********eleimina los datos que esten en la tabla de paciente_espera en caso de que no esten en el dia de ejecucion*********/
public function truncate()
    {
      return $this->db->query("truncate table paciente_espera ");
    } 
/********eleimina a los pacientes que esten en estado de espera si el dia de ejecucion es distinto al dia en que se agendo al paciente en estado de espera*********/
public function truncate_estado_espera($fecha_actual)
    {
         return $this->db->query("DELETE  from consulta_paciente where consulta_paciente.estado=1 and consulta_paciente.fecha<'".$fecha_actual."' ");
  
    }

/********se elimina el paciente del proceso de atencion*********/
function eliminarCitaPaciente($id)
{

  $this->db->where('id_consulta_paciente', $id);
  return $this->db->delete('consulta_paciente'); 
}
/********inserta el nuevo paciente en la tabla de pacientes_cosultados al finalizar exitosamente el proceso de atencion*********/
function pacienteAtendido($alta)
{

 $this->db->insert('pacientes_consultados', $alta);

}
/*******metodo que actualizar unicamente el estado  del paciente y pasa a otro estado de atendiendo**********/
function Cambiar_estado($estado, $id)
{

	$data = array(
    'estado' => $estado,
    );

  $this->db->where('id_consulta_paciente', $id);
  return $this->db->update('consulta_paciente', $data);

}
/********se elimina el paciente del proceso de atencion*********/
public function delectPAcienteEspera($idConsultaPaciente)
{
  $this->db->where('id_consulta_paciente', $idConsultaPaciente);
  return $this->db->delete('paciente_espera'); 
}
/********metodo que se ocupa si un doctor determina que el paciente debe volver a la lista de espera, para ser atendido por otro doctor o el mismo*********/
function Cambiar_estado_volver_Pantalla($estado, $id)
{

  $data = array(
    'estado' => $estado,
    );

  $this->db->where('id_consulta_paciente', $id);
  return $this->db->update('consulta_paciente', $data);
  
}
/*******metodo que otiene los datos de los pacientes que no asistieron a su consulta programada y fuero eliminado del proceso**********/
function insertConsultaFaltantes($data)
{
   $this->db->insert('faltantes', $data);

}
/*******metodo que elimina a un paciente del proceso de espera o atencion**********/
function eliminarConsultaEspera($id)
{

  $this->db->where('id_consulta_paciente', $id);
  return $this->db->delete('consulta_paciente'); 

}
/********obtiene los datos de la tabla faltantes de los pacientes que no asistieron a su consulta y son imprimidos en una vista de la sesion del enfermero*********/
function get_pacientesNoAsistieron()
{
   date_default_timezone_set('America/Cancun');
        $time = time();
        $fecha=date("Y-m-d",$time);
        $hora=date("H:i:s",$time);

   $query = $this->db->query("
    SELECT f.id_falta, f.nombre, f.apellido, f.rfc, f.tipo_paciente, f.clasificacion, f.hora_llegada, f.hora_baja, f.fecha, d.nombre as doctor, c.nombre as consultorio 
    from faltantes f, doctor d, consultorio c 
    where f.id_doctor=d.id_doctor and d.id_consultorio=c.id_consultorio and f.fecha='".$fecha."'");

   if ($query -> num_rows() > 0){
    return $query;
  }else{
   return false;
 }
}


}

?>