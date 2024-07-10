<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../descargar.jpg', 76, 2, 50);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 10);
        // Movernos a la derecha
        $this->Ln(10);
        // Título
        $this->Cell(75);
        $this->Cell(30, 30, 'Registro del movimiento del material de Brigadas', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->cell(35, 10, 'Proyecto', 1, 0, 'c', 0);
        $this->cell(30, 10, 'Escenario', 1, 0, 'c', 0);
        $this->cell(40, 10, 'Encargado', 1, 0, 'c', 0);
        $this->cell(40, 10, 'Salida', 1, 0, 'c', 0);
        $this->cell(40, 10, 'Regreso', 1, 1, 'c', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-30);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);

       

      
      
    }
}

require("../conexion.php");
$consulta = "SELECT * FROM reportlideres";
$resultado = mysqli_query($conexion, $consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 11);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(35, 8, $row['proyecto'], 1, 0, 'c', 0);
    $pdf->Cell(30, 8, $row['escenario'], 1, 0, 'c', 0);
    $pdf->Cell(40, 8, $row['encargado'], 1, 0, 'c', 0);
    $pdf->Cell(40, 8, $row['salida'], 1, 0, 'c', 0);
    $pdf->Cell(40, 8, $row['regreso'], 1, 1, 'c', 0);
}

$pdf->Output();
?>
