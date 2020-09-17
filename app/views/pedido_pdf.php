<?php 

include_once $_SERVER['DOCUMENT_ROOT'].'/ventas/assets/libs/php/fpdf17/fpdf.php';

$cliente = $_POST['cliente_pdf'];
$cliente_dni = $_POST['dni_pdf'];
$nro_pedido = $_POST['id_pdf'];
$nro_cli = $_POST['nro_pdf'];
$fecha = $_POST['fecha_pdf'];
$fechac = $_POST['fechacierre_pdf'];
$domicilio = $_POST['domicilio_pdf'];
$localidad = $_POST['localidad_pdf'];
$correo = $_POST['correo_pdf'];
$tel = $_POST['telefono_pdf'];
$señapedido = $_POST['senia_pdf'];
$saldopedido = $_POST['saldo_pdf'];
$totalpedido = $_POST['total_pdf'];
$descuento = $_POST['total_pdf'];
$descuento = $_POST['descuento_pdf'];
$tipodescuento = $_POST['tipodescuento_pdf'];
$simbolo = '';

// capturamos el arreglo con los productos del pedido
$data = json_decode($_POST['arreglo_pdf']);
//var_dump($data);

function Footer() {
//           // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print current and total page numbers
        $this->Cell(0,10,  utf8_decode('Página '.$this->PageNo()),0,0,'C');
}

$pdf = new FPDF($orientation='P',$unit='mm');
$pdf->AddPage();
$pdf->SetTitle(utf8_decode('Nota de Pedido Nº: '.$nro_pedido));
$pdf->Header();
$pdf->SetFont('Arial','B',26);    
$textypos = 5;
$pdf->setY(12);
$pdf->setX(10);
// Agregamos los datos de la empresa
$pdf->Cell(5,$textypos,"JENZO Distribuciones");
$pdf->Ln(6);
$pdf->SetFont('Arial','',9);  
$pdf->Cell(5,$textypos,utf8_decode("e-mail: jenzoproductos@hotmail.com - 3100 Paraná - Entre Ríos"));


// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(10);
$pdf->Cell(5,$textypos,"PARA:");
$pdf->SetFont('Arial','',10);    
$pdf->setY(35);$pdf->setX(10);
$pdf->Cell(5,$textypos,$cliente.' DNI: '.$cliente_dni);
$pdf->setY(40);$pdf->setX(10);
$pdf->Cell(5,$textypos,utf8_decode("Número de cliente: ".$nro_cli));
$pdf->setY(45);$pdf->setX(10);
$pdf->Cell(5,$textypos,utf8_decode('Domicilio: '.$domicilio.' - '.$localidad));
$pdf->setY(50);$pdf->setX(10);
$pdf->Cell(5,$textypos,'E-mail: '.$correo);
$pdf->setY(55);$pdf->setX(10);
$pdf->Cell(5,$textypos,utf8_decode('Teléfono: '.$tel));

// Agregamos los datos del cliente
$pdf->SetFont('Arial','B',10);    
$pdf->setY(30);$pdf->setX(135);
$pdf->Cell(5,$textypos,"NOTA DE PEDIDO # ".$nro_pedido);
$pdf->SetFont('Arial','',10);    
// $pdf->setY(35);$pdf->setX(135);
// $pdf->Cell(5,$textypos,"Fecha del pedido: ".$fecha);
$pdf->setY(35);$pdf->setX(135);
$pdf->Cell(5,$textypos,"Fecha de cierre: ".$fechac);
$pdf->setY(45);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");
$pdf->setY(50);$pdf->setX(135);
$pdf->Cell(5,$textypos,"");

/// Apartir de aqui empezamos con la tabla de productos
$pdf->setY(60);$pdf->setX(135);
$pdf->Ln();
/////////////////////////////
//// Array de Cabecera

$header = array("Cant.","Art.","Descripcion", "Medida", "Talle","Color","Color Alt.","Aroma","Precio","Total");

$pdf->SetFont('Arial','B',8.5); 
    // Column widths
    $w = array(10,15, 65, 15, 10, 14, 14 ,14, 14, 14);
    // Header
    for($i=0;$i<count($header);$i++)
        $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
    $pdf->Ln();
    // Data
    $pdf->SetFont('Arial','',7); 
    $n = count($data);
    $subtotal = 0;
    
    for ($i = 1; $i < $n; $i++) {
        $medida = '';
        $color = '';
        if($data[$i][4] != ''){
            $medida = $data[$i][3].'-'.$data[$i][4];
        }else{
            $medida = '';
        }
             $pdf->Cell($w[0],6,$data[$i][8],'1',0,'C');
             $pdf->Cell($w[1],6,$data[$i][1],'1',0,'C');
             $pdf->Cell($w[2],6,substr(utf8_decode($data[$i][2]),0,47),1);
             $pdf->Cell($w[3],6,$medida,1);
             $pdf->Cell($w[4],6,substr(utf8_decode($data[$i][5]),0,8),1);
             $pdf->Cell($w[5],6,substr(utf8_decode($data[$i][6]),0,8),1);
             $pdf->Cell($w[6],6,'',1);
             $pdf->Cell($w[7],6,substr(utf8_decode($data[$i][7]),0,8),1);
             $pdf->Cell($w[8],6,"$ ".number_format($data[$i][9]),'1',0,'C');
             if($data[$i][11] == true){

                $pdf->Cell($w[9],6,"$ ".number_format($data[$i][10]),'1',0,'C');
                $subtotal = ($subtotal+$data[$i][10]);

             }else{

                $pdf->Cell($w[9],6,"0",'1',0,'C'); 
                
             }
             
        
             
       

        $pdf->Ln();
        //$total+=$row[3]*$row[2];

    }

$pdf->SetFont('Arial','',10); 
/////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
$yposdinamic = 60 + (count($data)*10);

$pdf->setY($yposdinamic);
$pdf->setX(235);
    $pdf->Ln();
/////////////////////////////
if($tipodescuento == 2){

    $descuento = $_POST['descuento_pdf'];
    $simbolo = '$';

}else if($tipodescuento == 1){

    $descuento = ($subtotal*$_POST['descuento_pdf']/100);
    $simbolo = $_POST['descuento_pdf'].'%';
}
$saldopedido = ($subtotal-$descuento-$señapedido);
$header = array("", "");
$data2 = array(
	array("Subtotal",$subtotal),
	array("Descuento ".$simbolo."", $descuento),
	array(utf8_decode("seña"), $señapedido),
	array("Saldo", $saldopedido),
);
    // Column widths
    $w2 = array(40, 40);
    // Header

    $pdf->Ln();
    // Data
    foreach($data2 as $row)
    {
$pdf->setX(115);
        $pdf->Cell($w2[0],6,$row[0],1);
        $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');
        $pdf->Ln();
    }
/////////////////////////////

$yposdinamic += (count($data2)*10);
$pdf->SetFont('Arial','B',10);    
$pdf->SetY(-32);
    // Select Arial italic 8
$pdf->SetFont('Arial','I',8);
    // Print current and total page numbers
$pdf->Cell(0,10,  utf8_decode('Página '.$pdf->PageNo()),0,0,'C');
$pdf->output();