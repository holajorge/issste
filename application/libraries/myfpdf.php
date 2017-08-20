<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

require('fpdf/fpdf.php');

class Myfpdf  extends Fpdf {

 function __contruct()
	 {
		parent:: __construct();
		$issste =& get_instance();

	 }
}


?>

