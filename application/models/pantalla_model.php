<?php
class Pantalla_model extends CI_Model {
   
    function __construct()
    {
        parent::__construct();
        /*******SE CARGA LA CONEXION A LA BASE DE DATOS PREVIAMENTE CONFIGURADA EN EL ARCHIBO database.php**********/
        $this->load->database();
    }
    /*******metodo obtiene los datos de la tabal consulta_paciente para mostrarlos en pantalla**********/
    public function consul_pacientes()
    {
       $query = $this->db->query('SELECT nombre,apellido_paterno,tipo_paciente from consulta_paciente where estado=1 order by tipo_paciente desc');

      if ($query -> num_rows() > 0){
          return $query;
      }else{
       return false;
      }
    }
/*******metodo monitorea el tamaña de una tabla**********/
     public function getMonitoreoMaximo()
    {
//select * from monitoreollamadas where id=(SELECT max(id) from monitoreollamadas)
       $query = $this->db->query('SELECT monitoreollamadas.nombre, monitoreollamadas.apellido, consultorio.nombre as consultorio from monitoreollamadas, consultorio where monitoreollamadas.consultorio=consultorio.id_consultorio   and   id=(SELECT max(id)  from monitoreollamadas) ');

      if ($query -> num_rows() > 0){
          return $query->result();
      }else{
       return false;
      }
    }
    /*******metodo verifica la fecha de la tabla con la finalidad de estas actualizando la tabla**********/
    public function verificaFecha()
    {
      $query = $this->db->query('select fecha from monitoreollamadas where id=(select max(id) from monitoreollamadas)');

        if ($query -> num_rows() > 0){
          return $query->result()[0]->fecha;
        }else{
         return false;
        }
    }
    /*******metodo si la tabla tiene una fecha diferente del dia de ejecucion entonces se elimina todo**********/
    public function truncateMonitore()
    {
      return $this->db->query("truncate table monitoreollamadas ");
  
    }
    /*******metodo **********/
     public function consul_pacientes2()
      {
         $query = $this->db->query('SELECT nombre,apellido_paterno,clasificacion from consulta_paciente where estado=1 order by clasificacion desc , hora_llegada asc');

        if ($query -> num_rows() > 0){
            return $query;
        }else{
         return false;
        }
      }
  /*******metodo se imprime todo los datos de los pacientes que esten en espera**********/
    public function paciente_espera()
      {
         $query = $this->db->query('SELECT nombre,apellido_paterno,tipo_paciente from consulta_paciente where estado=1 order by tipo_paciente desc');

        if ($query -> num_rows() > 0){
            return $query;
        }else{
         return false;
        }
      }
  /*******metodo monitorea el tamaño de la tabla para imprimir en pantalla**********/
  public function monitoreollamadasTotal()
  {
    $query = $this->db->query('SELECT * from monitoreollamadas');

          if ($query -> num_rows() > 0){
              return $query -> num_rows();
          }else{
           return 0;
          }
  }
  /*******metodo actualiza los datos de los pacientes que son llamados en pantalla**********/
    public function count()
      {
        $query = $this->db->query('SELECT * from paciente_espera');

        if ($query -> num_rows() > 0){
            return $query -> num_rows();
        }else{
         return 0;
        }
      }

      //VER QUE NO SUENE PARA CUENDO LO CONSULTEN
      public function countPacientesConsultados()
      {
        $query = $this->db->query('SELECT * from pacientes_consultados');

        if ($query -> num_rows() > 0){
            return $query -> num_rows();
        }else{
         return 0;
        }
      }
   /*******metodo que imprime los datos del ultimo paciente que se inserto en estado de espera**********/
      public function count_consulta_paciente()
      {
        $query = $this->db->query('SELECT MAX(id_consulta_paciente) id from consulta_paciente');

        if ($query -> num_rows() > 0){
          return $query->result()[0]->id;
        }else{
         return false;
        }
      }
//id_espera = (SELECT MAX(id_espera) FROM paciente_espera)
    public function muestra_consulta()
    {
      $query = $this->db->query('SELECT consulta_paciente.nombre,consulta_paciente.apellido_paterno, consultorio.nombre as consultorio  FROM paciente_espera, consultorio, consulta_paciente, doctor WHERE consulta_paciente.estado=2 and paciente_espera.id_consulta_paciente=consulta_paciente.id_consulta_paciente and doctor.id_doctor = paciente_espera.id_doctor and doctor.id_doctor=consultorio.id_consultorio and id_espera = (SELECT MAX(id_espera) FROM paciente_espera)');

      if ($query -> num_rows() > 0){
          return $query;
      }else{
       return false;
      }
    }

}
?>