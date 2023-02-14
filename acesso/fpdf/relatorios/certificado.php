<?php

include('../pdf_mc_table.php');


$pdf = new PDF_MC_TABLE();

$nomeAluno = $_REQUEST['nomeAluno'];
$faixa     = $_REQUEST['faixa'];

$pdf->AliasNbPages();
$pdf->AddPage("L", "A4");

$pdf->Image('oficial.png',0,0,300);

//$pdf->Image('femeju.png',10,6,40);

//$pdf->Image('cbj.png',230,4,90);

//$pdf->Image('logo1.png',105,50,100);
    
$pdf->Ln(25);
    // Arial bold 15
$pdf->SetFont('Arial','B',60);
    // Move to the right
$pdf->Cell(100);
    // Title
   
$pdf->Cell(10,10,utf8_decode(''));
$pdf->Ln(10);

$pdf->SetFont('Arial','B',27);
$pdf->Ln(25);
$pdf->Cell(10);
$pdf->Cell(10,10,utf8_decode('A federação Metropolitana de judo - FEMEJU, confere a'));

$pdf->Ln(20);

$pdf->SetFont('Arial','B',24);

$pdf->SetAligns(Array('C'));
$pdf->SetWidths(Array(280));
//$pdf->SetY(-100);
//$pdf->SetX(-230);
$pdf->SetLineHeight(5);
$pdf->SetTextColor(255,0,0);   
//$pdf->Cell(256,10,utf8_decode('Nº ATV'),1,0,'C');
$pdf->Cell(280,10,utf8_decode($nomeAluno),0,0,'C');
$pdf->SetTextColor(0,0,0);   
$pdf->Ln(20);
$pdf->Cell(30);
$pdf->SetFont('Arial','B',27);
$pdf->Cell(10,10,utf8_decode('da Associação judô Granado / Colégio Maristinha'));
$pdf->Ln(10);
$pdf->Cell(90);
$pdf->Cell(10,10,utf8_decode('o titulo de '.$faixa));


$pdf->SetFont('Arial','B',14);
$pdf->Ln(45);
$pdf->Cell(45);
$pdf->Cell(10,10,'__________________________________');
$pdf->Cell(90);
$pdf->Cell(10,10,'__________________________________');
$pdf->Ln(7);
$pdf->Cell(55);
$pdf->Cell(10,10,utf8_decode('   PROFESSOR RESPONSÁVEL '));
$pdf->Cell(90);
$pdf->Cell(10,10,'      LUIZ GONZAGA FILHO ');
$pdf->Ln(7);
$pdf->Cell(154);
$pdf->Cell(10,10,'      PRESIDENTE - FEMEJU ');    
$pdf->Output();

?>