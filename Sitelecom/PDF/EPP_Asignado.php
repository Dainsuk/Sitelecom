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
        $this->Cell(30, 30, 'EPP Asignado', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
        //tabla 1
        $this->Cell(122, 10, 'Descripcion de Material', 1, 0, 'c', 0);
        $this->Cell(25, 10, 'Cantidades', 1, 0, 'c', 0);
        $this->Cell(50, 10, 'Team Lider', 1, 1, 'c', 0); // Agrega un espacio entre las tablas

    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-30);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 10);

        // Línea para firmar y leyenda "Entrega"
        // Leyenda "Entrega"
        $this->Line(10, $this->GetY(), 80, $this->GetY());
        $this->Cell(65, 10, 'Entrega', 0, 0, 'C'); // Cambiado 'L' a 'C' para centrar el texto

        // Leyenda "Recibe"
        $this->SetX(-80);
        $this->Line($this->GetPageWidth() - 80, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());
        $this->Cell(0, 10, 'Recibe', 0, 1, 'C'); // Cambiado 'L' a 'C' para centrar el texto
        
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

require("../conexion.php");

$encargado = isset($_GET['encargado']) ? urldecode($_GET['encargado']) : '';

$consulta = "SELECT * FROM asig_epp where encargado='$encargado'";
$resultado = mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10); // Use a font that supports UTF-8 characters

// Resultados de tabla1
while ($row = $resultado->fetch_assoc()) {
    // Verifica si hay suficiente espacio en la página
    if ($pdf->GetY() + 8 > $pdf->GetPageHeight() - 55) {
        // No hay suficiente espacio, agrega una nueva página
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 11);
    }

    $pdf->Cell(122, 8, utf8_decode($row['Descri_EPP']), 1, 0, 'c', 0);
    $pdf->Cell(25, 8, utf8_decode($row['cantidad_EPP']), 1, 0, 'c', 0);
    $pdf->Cell(50, 8, utf8_decode($row['encargado']), 1, 1, 'c', 0);
}

$pdf->Output();
?>
