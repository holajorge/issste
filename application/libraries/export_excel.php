<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  

class export_excel{

  function to_excel($array, $filename) 
  { 
    header('Content-Disposition: attachment; filename='.$filename.'.xls');
    header('Content-type: application/force-download');
    header('Content-Transfer-Encoding: binary');
    header('Pragma: public');
    echo '<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />';
    
        // print "\UTF-8"; // 
        $h = array();
        foreach($array->result_array() as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                    $h[] = $key;   
                }
            }
        }
        echo '<table class="text-center">
         <tr>';
           foreach($h as $key) 
            {
              $key = ucwords($key);

         echo '<th style="border:1px #000000 solid;background-color:#bfbfbf;color:black; font-family:Areal;">'.$key.'</th>';
            }
         echo '</tr>';

           foreach($array->result_array() as $row)
           {
         echo '<tr>';
           foreach($row as $val)

               $this->writeRow($val);   
           }
         echo '</tr>';
         echo '</table>';

  }

    function to_excell($array, $filename) 
  { 
    header('Content-Disposition: attachment; filename='.$filename.'.xls');
    header('Content-type: application/force-download');
    header('Content-Transfer-Encoding: binary');
    header('Pragma: public');
    echo '<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />';
    
  

        // print "\UTF-8"; // 
        $h = array();
        foreach($array->result_array() as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                    $h[] = $key;   
                }
            }
        }
        echo '<table class="text-center">
         <tr>';
           foreach($h as $key) 
            {
              $key = ucwords($key);

         echo '<th style="border:1px #000000 solid;background-color:#bfbfbf;color:black; font-family:Areal;">'.$key.'</th>';
            }
         echo '</tr>';

           foreach($array->result_array() as $row)
           {
         echo '<tr>';
           foreach($row as $val)

               $this->writeRow($val);   
           }
         echo '</tr>';
         echo '</table>';

  }

   function writeRow($val) {
        echo '<td style="border:1px #000000 solid;color:#000000;">'.$val.'</td>';
        //echo '<table class="text-center"><tr><td>'.$inicio.'</td><td>'.$fin.'</td></tr></table>';              
    }
//echo '<table class="text-center"><tr><td>'.$inicio.'</td><td>'.$fin.'</td></tr></table>'; 
}
?>