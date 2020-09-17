<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/ventas/assets/libs/php/fpdf17/fpdf.php';

$nro = $_POST['nro'];
$localidad = $_POST['localidad'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tel = $_POST['telefono'];
$domi = $_POST['domicilio'];
$saldo = $_POST['saldo'];

class PDF extends FPDF {

    function Header() {

        global $nro,$localidad,$nombre,$apellido,$tel,$domi,$saldo;

        $this->SetMargins(20, 10);

        //$this->Image('../../../public/img/skills_logo_recibo.png',30,8,50);

        $this->Cell(10,5,utf8_decode(''),0,0,'C');

        //$this->Image('../../../public/img/skills_logo_recibo.png',130,8,50);

        $this->SetMargins(40, 10);

        // $this->Image('../../../public/img/skills_logo.png',10,8,50);

        $this->SetMargins(20, 10);

        $this->Ln(18);

        $this->SetFont('Arial','I',8);

        $this->Cell(150,5,utf8_decode('CLIENTE Nº: '.$nro),0,0,'R');

        $this->Ln(5);

        $this->SetFont('Arial','B',18);

        $this->Cell(170,12,utf8_decode($localidad),1,0,'C');
        $this->Ln(20);

        $this->SetFont('Arial','I',14);
        $this->Cell(90,8,utf8_decode('NOMBRE: '.$apellido.', '.$nombre),0,0,'L');

        $this->Ln(8);

        $this->Cell(90,8,utf8_decode('TELÉFONO: '.$tel),0,0,'L');

        $this->Ln(8);

        $this->Cell(90,8,utf8_decode('DIRECCIÓN: '.$domi),0,0,'L');

        $this->Ln(10);

        $this->SetFont('Arial','B',12);
        $this->Cell(50,8,utf8_decode('SALDO: $ '.$saldo),1,0,'L');
       
        $this->Ln(20);

        $this->SetFont('Arial','B',12);
        $this->Cell(170,8,utf8_decode('JENZO Distribuciones'),0,0,'R');
        $this->Ln(4);
        $this->SetFont('Arial','I',9);
        $this->Cell(169,8,utf8_decode('jenzoproductos@hotmail.com'),0,0,'R');

    }

//     function Footer() {
// //           // Go to 1.5 cm from bottom
//         $this->SetY(-15);
//     // Select Arial italic 8
//         $this->SetFont('Arial','I',8);
//     // Print current and total page numbers
//         $this->Cell(0,10,  utf8_decode('Página '.$this->PageNo()),0,0,'C');
//     }

}


$a = new PDF('P', 'mm', 'A4');

$a->SetTitle($apellido.'-'.$nombre);

$a->AddPage();

$a->Header();

$a->Output('troquel'.$apellido.'-'.$nombre.'.pdf', 'I');
