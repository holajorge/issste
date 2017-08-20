<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RPDF extends FPDF
{
    // Cabecera de página
 function Header()
 {
        // Logo
  $this->Image(base_url().'plantillas/img/issste.jpg',15,15,60);

        // Arial bold 15
  $this->SetFont('Arial','B',15);
        // Movernos a la derecha
  $this->Cell(66);
        // Título
  $this->Cell(20,20,'SISTEMA DE URGENCIAS TRIAGE PARA EL DERECHOHABIENTE',3,3);
  $this->Cell(5,5,'LISTA DE PACIENTES POR FECHAS',3,3,'L');
  
        // Salto de línea
  $this->Ln(5);
}

        // Pie de página
function Footer()
{
        // Posición: a 1,5 cm del final
  $this->SetY(-15);
        // Arial italic 8
  $this->SetFont('Arial','I',8);
        // Número de página
  $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
  
}
}


// Tabla simple

        // Creación del objeto de la clase heredada
$this->myfpdf = new RPDF('L');

        //[string orientacion[,mixed formato]]
$this->myfpdf->AddPage('L');
$this->myfpdf->AliasNbPages();

$this->myfpdf->SetTitle('LISTA DE PACIENTES POR FECHAS');
$this->myfpdf->SetLeftMargin(18);
$this->myfpdf->SetRightMargin(15);
        //Colores, ancho de línea y fuente en negrita
$this->myfpdf->SetFillColor(200,130,130);
$this->myfpdf->setTextColor(10);
        //para poner color a los bordes
$this->myfpdf->SetDrawColor(0,0,0);
$this->myfpdf->setLineWidth(.3);
        //SetFont(string familia[, string estilo [, float size]]);
$this->myfpdf->SetFont('Arial','B',9);


// intrucciones del CELL
//Cell(float w [, float h [, string texto [, mixed borde [, int ln [, string align [, boolean fill [, mixed link]]]]]]])

// w: ancho de la celda. Si ponemos 0 la celda se extiende hasta el margen derecho.
// H: alto de la celda.
// Texto: el texto que le vamos a añadir.
// Borde: nos dice si van a ser visibles o no. si es 0 no serán visibles, si es 1 se verán los bordes.
// Ln: nos dice donde se empezara a escribir después de llamar a esta función. Siendo 0 a la derecha, 1 al comienzo de la siguiente línea, 2 debajo.
// Align: para alinear el texto. L alineado a la izquierda, C centrado y R alineado a la derecha.
// Fill: nos dice si el fondo de la celda va a ir con color o no. los valores son True o False

$this->myfpdf->Cell(30,7,'NOMBRE','TBL',0,'C','1');
$this->myfpdf->Cell(30,7,'APELLIDO','TBL',0,'C','1');
        // $this->myfpdf->Cell(15,7,'RFC','TBL',0,'C','1');
$this->myfpdf->Cell(20,7,'FOLIO','TBL',0,'C','1');
$this->myfpdf->Cell(15,7,'Vigencia','TBL',0,'C','1');        
$this->myfpdf->Cell(15,7,'TIPO','TBL',0,'C','1');
$this->myfpdf->Cell(26,7,'CLASIFICACION','TBL',0,'C','1');       
        // $this->myfpdf->Cell(30,7,'Descripcion','TBL',0,'C','1');
$this->myfpdf->Cell(20,7,'FECHA','TBL',0,'C','1');
$this->myfpdf->Cell(25,7,'H LLEGADA','TBL',0,'C','1');  
$this->myfpdf->Cell(25,7,'H FIN','TBL',0,'C','1');      
$this->myfpdf->Cell(22,7,'DOCTOR','TBL',0,'C','1');
$this->myfpdf->Cell(25,7,'CONSULTORIO','BLR',0,'C','1');

$this->myfpdf->Ln(7);

foreach ($txt->result() as $pacientes) 
{
             // $this->myfpdf->Cell(15,5,$x++,'BL',0,'C',0);
              // Se imprimen los datos de cada alumno        
  $this->myfpdf->Cell(30,10,$pacientes->nombre,'BL',0,'L',0);
  $this->myfpdf->Cell(30,10,$pacientes->apellido,'BL',0,'L',0);
          // $this->myfpdf->Cell(15,10,$pacientes->rfc,'BL',0,'L',0);
  $this->myfpdf->Cell(20,10,$pacientes->folio,'BL',0,'C',0);
  $this->myfpdf->Cell(15,10,$pacientes->vigencia,'BL',0,'C',0);
  $this->myfpdf->Cell(15,10,$pacientes->tipo,'BL',0,'C',0);
  $this->myfpdf->Cell(26,10,$pacientes->clasificacion,'BL',0,'C',0);
          // $this->myfpdf->Cell(30,5,$pacientes->descripcion,'BL',0,'C',0);
  $this->myfpdf->Cell(20,10,$pacientes->fecha,'BL',0,'C',0);
  $this->myfpdf->Cell(25,10,$pacientes->hora_llegada,'BL',0,'C',0);   
  $this->myfpdf->Cell(25,10,$pacientes->hora_atendido,'BL',0,'C',0);   
  $this->myfpdf->Cell(22,10,$pacientes->doctor,'BL',0,'C',0);
  $this->myfpdf->Cell(25,10,$pacientes->consultorio,'BLR',0,'C',0);

  
          //Se agrega un salto de linea
  $this->myfpdf->Ln(10);

}

          // $this->myfpdf->Cell(15,7,'Imprimiendo línea número '.$txt,0,1);
$this->myfpdf->Output("Lista de pacientes.pdf", 'I');

$this->myfpdf->Output();



?>