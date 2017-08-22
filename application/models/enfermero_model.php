  <?php
 class Enfermero_model extends CI_Model { 
    
   public function __construct() 
   {
    parent::__construct();
    /*********se carga la conexion con la base de datos para su uso********/
    $this->load->database();
        
  }

/********metodo para insertar los datos que son enviador del controlador para insertarlos a la tabla de pacientes*********/
  function insertPaciente($paciente)
  {
    $this->db->insert('pacientes', $paciente);
  }
/********metodo para insertar datos de los pacientes que estan en espera a la tabla de pacientes en espera*********/
  function paciente_espera($id_paciente_espera)
  {
    $this->db->insert('paciente_espera', $id_paciente_espera);
  }
  /********metodo que recibe el id de un derechohabiente en espera que que se elimina del procesos de atencion esto en caso de que se llame varia veces a consultorio pero no asiste*********/
  function paciente_espera_delete($id)
  {
    $this->db->where('id_consulta_paciente', $id);
    return $this->db->delete('paciente_espera'); 
  }
  /********metodo para actualizar los datos de los derechohabientes en caso de que el enfermero lo determine*********/
  function updatePaciente($id, $data)
  {
    $this->db->where('id_paciente',$id);
    return $this->db->update('pacientes', $data);
    
  }
/********este metodo se repetio por alguna razon que no recuerdo*********/
  function eliminarPaciente($id)
  {
    $this->db->where('id_paciente', $id);
    return $this->db->delete('pacientes'); 

  }
/********metodo que obtiee el total de pacientes que estan en la tabla de pacientes para imprimirlo en una vista del enfermero*********/
  function get_paciente()
  { 
    $consulta = $this->db-> query('SELECT * from pacientes');
    
    if ($consulta -> num_rows() > 0){
      return $consulta;
    }else{
     return false;
   }
  }

/*********metodo que busca los derechohabientes para editar sus datos********/
  public function buscar_editar($baja, $buscar,$inicio = FALSE, $cantidadregistro = FALSE)
  {
    $this->db->select('id_paciente, nombre,ape_pate, ape_mate, edad, sexo, fecha_nacimiento, rfc, vigencia');
    $this->db->from('pacientes');
    $this->db->where('baja', $baja);
    $this->db->like("rfc",$buscar);

    if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
      $this->db->limit($cantidadregistro,$inicio);
    }
    $consulta = $this->db->get();
    return $consulta->result();
  }
/********meto que busca un derechohabiente en la tabla de pacientes depende que como lo requiera el enfermero*********/
  public function buscar($baja, $buscar, $inicio = FALSE, $cantidadregistro = FALSE)
  {
     
    $this->db->select('id_paciente, nombre,ape_pate, ape_mate, edad, sexo, fecha_nacimiento, rfc, vigencia');
    $this->db->from('pacientes');
    $this->db->where('baja', $baja);
    $this->db->like('rfc', $buscar); 

    if ($inicio !== FALSE && $cantidadregistro !== FALSE) {
      $this->db->limit($cantidadregistro,$inicio);
    }
    $consulta = $this->db->get();
    return $consulta->result();
  }

/********busca los derechohabientes para eliminarlos de la tabla de pacientes*********/

  public function buscarEliminar($baja, $buscar,$inicio = FALSE, $cantidadregistro = FALSE)
  {
   
    $this->db->select('id_paciente, nombre,ape_pate, ape_mate, edad, sexo, fecha_nacimiento, rfc, vigencia');
    $this->db->from('pacientes');
    $this->db->like('rfc',$buscar ); 
    $this->db->where('baja', $baja);

    if ($inicio !== FALSE && $cantidadregistro !== FALSE) {      
        $this->db->limit($cantidadregistro,$inicio);
    }

    $consulta = $this->db->get();
     // $consulta = $this->db->query("SELECT * from pacientes where nombre like '%".$buscar."%' or ape_pate like '%".$buscar."%' or ape_mate like '%".$buscar."%' or rfc like '%".$buscar."%'");
    return $consulta->result();
  }

  public function num_paciente()
  {
    $this->db->query("SELECT count(*) as number from pacientes")->row()->number;
    return intval($number);
  }
/********metodo para hacer la paginacion por la cantidad de los derechohabientes*********/
  public function get_paginacion($number_por_pagina)
  {
    $this->db->get('rfc', $number_por_pagina, $this->uri->segment(3));
  }

/********metodo que obtiene el ultimo derechohabiente insertado en la tabla de pacientes para llevarlo a una vista*********/
  function get_paciente_id(){
    $query = $this->db-> query('SELECT * FROM pacientes WHERE pacientes.id_paciente = (SELECT MAX(id_paciente) FROM pacientes)');
    if ($query -> num_rows() > 0){
      return $query;
    }else{
     return false;
   }
  }
/********inserta los datos de un nuevo paciente para ingresarlo en la tabla de espera*********/
  function insertarPacienteCita($datos)
  {

    return $this->db->insert('consulta_paciente', $datos);
   //$query = $this->db-> query('INSERT concat(tipo_paciente,' ', ape_pate) as nombre  FROM consultas_paciente WHERE  ');

  }
/*********metodo para actualizar un derechohabiente o paciente********/
  function insertarUpdatePaciente($id,$datos)
  {
    $this->db->where('id_paciente',$id);
    return $this->db->update('pacientes', $datos);
  }

}