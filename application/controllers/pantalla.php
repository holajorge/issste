<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Pantalla extends CI_Controller {
 var $datas=0;
 public function __construct()
 {
  parent::__construct();
  /******CARGAR LOS MODELOS PARA USAR LA BASE DE DATOS*******/
  $this->load->model('pantalla_model');
  $this->load->model('pacientes_model');
}

/******METODO POR DEFECTO QUE CARGA LA VISTA DE LA PANTALLA*******/
public function index()
{

  $this->load->view('admin/pantalla/header_pantalla');
  $this->load->view('admin/pantalla/index');
  $this->load->view('admin/pantalla/footer_pantalla');

}
/******METODO QUE MUESTRA LOS DATOS DE LOS DERECHOHABIENTES EN ESPERA DE CONSULTA*******/
  public function ajax_pantalla()
  {
   $consulta= $this->pantalla_model->consul_pacientes2();

   $li='
   <div class="slider sliderUno">
     <ul class="slides slidesUno">
      <li style="background: white;">
        <table class="bordered" >
          <thead>
           <tr >
            <th class="center-align" style="color: white; background: #0d47a1;">NOMBRE</th>
            <th class="center-align" style="color: white; background: #0d47a1;">APELLIDO</th>
            <th class="center-align" style="color: white; background: #0d47a1;">TRIAGE</th>
          </tr>
        </thead>
        <tbody>';
          $valor=1;
          if ($consulta!= null) {

            foreach ($consulta->result() as $fila):
              if($valor%11==0){
                $li=$li.'
              </tbody>
            </table>
          </li>

          <li style="background: white;">
            <table class="bordered">
             <thead>
              <tr>
               <th class="center-align">NOMBRE</th>
               <th class="center-align">APELLIDO</th>
               <th class="center-align">TRIAGE</th>
             </tr>
           </thead>
           <tbody>';
           }
           if($fila->clasificacion==1){
            $li=$li.'
            <tr class="">
             <td >'.$fila->nombre.'</td>
             <td >'.$fila->apellido_paterno.'</td> 
             <td style="background-color: green; width: 20%;"></td>
           </tr>';
         }elseif ($fila->clasificacion==2) {
          $li=$li.'
          <tr class="">
           <td >'.$fila->nombre.'</td>
           <td >'.$fila->apellido_paterno.'</td>
           <td style="background-color: yellow; width: 20%;"></td>
         </tr>';
       }elseif ($fila->clasificacion==3) {
        $li=$li.'
        <tr class="">
         <td >'.$fila->nombre.'</td>
         <td >'.$fila->apellido_paterno.'</td>
         <td  style="background-color: red; width: 20%;"></td>
       </tr>';
     }

     $valor=$valor+1;
     endforeach;
     $li=$li.'
   </tbody>
  </table>
  </li>
  </ul>
  <script>
    $(document).ready(function(){
      $(".slider").slider();            
      $(".slidesUno").height("80vh");
      $(".slideDos").height("40vh");
      $(".sliderDos").height("40vh");
    });
  </script>';

  echo $li;

  }else{
    $li='';
    $valor=1;
    $li=$li.'
  </tbody>
  </table>
  </ul>
  <table class="bordered" >
    <thead>
      <tr >
       <th class="center-align">NOMBRE</th>
       <th class="center-align">APELLIDO</th>
       <th class="center-align">TRIAGE</th>
     </tr>
   </thead>
   <tbody>';
     '<tr class="">
     <td ></td>
     <td ></td>
     <td style="background-color: green; width: 20%;"></td>
   </tr>';
   '<tr class="">
   <td ></td>
   <td ></td> <td  style="background-color: yellow; width: 20%;"></td>
  </tr>';
  '<tr class="">
  <td ></td>
  <td ></td> <td style="background-color: red; width: 20%;"></td>
  </tr>';
  $li=$li.'
  </tbody>
  </table>
  </ul>
  </li>
  <script>
    $(document).ready(function(){
      $(".slider").slider();            
      $(".slidesUno").height("80vh");
      $(".slideDos").height("40vh");
      $(".sliderDos").height("40vh");
    });
  </script>';
  echo $li;
  }
  }

  /******METODO QUE CAMBIA EL ESTADO DEL DERECHOHABIENTE*******/
  public function change_espera()
  {
    $count= $this->pantalla_model->count();
    echo $count;
  }
  /******METODO QUE ACTULIZA LA TABLA DE DERECHOHABIENTES EN ESPERA*******/
  public function change_espera_derecho()
  {
    $maxid= $this->pantalla_model->count_consulta_paciente();
    echo $maxid;
  }
  /*******METODO QUE MONITOREA LA CANTIDAD O EL TAMAÑA DE LA TABLA PARA ACTUALIZARLA******/
  public function monitorearTotales(){
    echo $this->pantalla_model->monitoreollamadasTotal();
  }
  /*****METODO QUE AVISA EL CAMBIO DE UNA TABLA PARA HACER EL LLAMADO DE UN DERECHOHABIENTE PARA SU CONSULTA********/
  public function getMonitoreoUltimo()
  {

    $datos = $this->pantalla_model->getMonitoreoMaximo();
    echo $datos[0]->nombre.",".$datos[0]->apellido.",CONSULTORIO ".$datos[0]->consultorio;

  }

  /******METODO QUE MONITOREA LA FECHA ACTUAL PARA HACER EL LLAMADO DE UN PACIENTE EN PANTALLA*******/
  public function monitorFecha()
  {
    $fecha = $this->pantalla_model->verificaFecha();
    date_default_timezone_set('America/Cancun');
    $time = time();
    $fechaActual=date("Y-m-d",$time);
    if($fecha==$fechaActual){
      echo "true";
    }else{
      echo "false";
    }
  }
  /******METODO PARA ACTULIZAR LA TABLA EN PANTALLA DE LOS DERECHOHABIENTES QUE YA ESTEN CONSULTADOS*******/
  public function monitoreoPacientesConsultados()
  {
    $numPacientes=$this->pantalla_model->countPacientesConsultados();
    echo $numPacientes;
  }
  /*******METODO PARA ACTULIZAR Y ELIMINAR LA TABLA MONITOREOLLMADAS ******/
  public function truncateMonitor()
  {
    $this->pantalla_model->truncateMonitore();
  }

  /******MOTODO QUE MUESTA LOS DATOS DE LOS DERECHOHABIENTES QUE ESTAN LLEMADOS PARA CONSULTORIO*******/
  public function consultorio_ajax()
  {
   $consultaa= $this->pacientes_model->get_pacientesVistaConsulta();
   $html='

   <div class="slider sliderDos">
    <ul class="slides slideDos">
     <li style="background: white;">      
      <h5 class="center-align" style="background: darkslateblue; color: white; margin-bottom: 0%; ">PASAR A CONSULTAR</h5>  
      <table class="bordered">
        <thead>
          <tr >
           <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">NOMBRE</th>
           <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">APELLIDO</th>
           <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">CONSULTORIO</th>
         </tr>
       </thead>
       <tbody>';
         $valor=1;
         if($consultaa != null){
          foreach ($consultaa->result() as $fila):
            if($valor%4==0){
              $html=$html.'
            </tbody>
          </table>
        </li>
        <li style="background: white;">     
         <h5 class="center-align" style="background: darkslateblue; color: white; margin-bottom: 0%;">PASAR A CONSULTAR</h5>  
         <table class="bordered" >
           <thead>
            <tr >
             <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">NOMBRE</th>
             <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">APELLIDO</th>
             <th class="center-align" class="center-align" style="color: white; background: #0d47a1;">CONSULTORIO</th>
           </tr>
         </thead>
         <tbody>';
         }
         $html= $html.'
         <tr>
          <th class="center"><label style=" font-size: 90%; color: black; ">'.$fila->nombre.'</label></th>
          <th class="center"><label style="font-size: 90%; color: black;">'.$fila->apellido_paterno.'</label></th>
          <th style=" text-align: center; color: black;">
            <label style=" font-size: 90%; color: black;" >'.$fila->consultorio.'</label>
          </th>
        </tr>';

        $valor=$valor+1;
        endforeach;
        $html=$html.'
      </tbody>
    </table>
  </li>
  </ul>
  </div>
  <script>
    $(document).ready(function(){
      $(".slider").slider();            
      $(".slidesUno").height("80vh");
      $(".slideDos").height("40vh");
      $(".sliderDos").height("40vh");
    });
  </script>';

  echo $html;

  }else{

    $valor=1;
    $html=$html.'</tbody>
   </table>
  </li>
  <script>
    $(document).ready(function(){
      $(".slider").slider();            
      $(".slidesUno").height("80vh");
      $(".slideDos").height("40vh");
      $(".sliderDos").height("40vh");
    });
  </script>';

  echo $html;
  }

  }

}
?>
