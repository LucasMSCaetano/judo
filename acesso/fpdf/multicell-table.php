<?php

include('pdf_mc_table.php');
include("config.php");

$pdf = new PDF_MC_TABLE();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins( 20, 20, 20, 20 );
$pdf->Image('iica-logo.png',10,6,40);
    // Arial bold 15
    $pdf->SetFont('Arial','B',14);
    // Move to the right
    $pdf->Cell(70);
    // Title
    $pdf->Cell(10,10,utf8_decode('TERMO DE RESPONSABILIDADE'));
    // Line break
    $pdf->Ln(5);
    $pdf->Cell(72);
    $pdf->Cell(10,10,utf8_decode('USO DE ATIVO MÓVEL'));
    $pdf->Ln(25);
    $pdf->SetFont('Arial','B',11);
    $pdf->Cell(30,5,utf8_decode('NOME:'));
    $pdf->Ln(10);
    $pdf->Cell(30,5,utf8_decode('CARGO/FUNÇÃO:'));
    $pdf->Ln(10);
    $pdf->Cell(30,5,utf8_decode('LOCAL DO USO:'));
    $pdf->Ln(10);

$pdf->SetFont('Arial','',11);
$pdf->SetAligns(Array('C','J'));
$pdf->SetWidths(Array(10,130,30));

$pdf->SetLineHeight(5);
$pdf->Cell(10,5,utf8_decode('  Nº'),1,0);
$pdf->Cell(130,5,utf8_decode('                                      DESCRIÇÃO COMPLETA'),1,0);
$pdf->Cell(30,5,utf8_decode('      Nº ATIVO'),1,0);
$pdf->Ln();

$result_cursos = "SELECT * FROM bd_iica WHERE responsavel like '%lucas%' " ; 
$resultado_cursos = mysqli_query($conn, $result_cursos);
$CONT = 1;
while($rows_cursos = mysqli_fetch_array($resultado_cursos)){
    
    $pdf->Row(Array(
    $CONT,    
    utf8_decode($rows_cursos["descricao_completa"]),
	$rows_cursos["num_ativo"],
	
    ));
    $CONT = $CONT +1;
}
$pdf->Ln();

$pdf->MultiCell(0,6,utf8_decode('               Declaro para os devidos fins de direito, que recebi os ativos acima relacionados em perfeito estado de conservação e estou ciente da responsabilidade no que se refere ao cuidado, conservação e manutenção do bem e que este não poderá ser emprestado ou transferido sem o prévio conhecimento deste Instituto. '),0,1);
$pdf->MultiCell(0,6,utf8_decode('               Em caso de perda do bem comprometo-me a restituir o IICA com equipamento igual, e em caso de furto ou roubo apresentar o Boletim de Ocorrência Policial. '),0,1);
$pdf->Ln(10);
$pdf->Cell(130);
$pdf->MultiCell(0,6,utf8_decode('Brasília, ').date('d/m/Y'),0,1);
$pdf->Ln(10);
$pdf->Cell(40);
$pdf->Cell(10,10,'______________________________________________________');
$pdf->Ln(5);
$pdf->Cell(40);
$pdf->Cell(10,10,'                               Assinatura do solicitante do ativo');
$pdf->Ln(40);
$pdf->Cell(10,10,utf8_decode('*Para preenchimento do responsável pelo ativo'));
$pdf->Ln(5);
$pdf->Cell(10,10,'______________________________________________________');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(10,10,utf8_decode('*DEVOLUÇÃO:'));
$pdf->Ln(7);
$pdf->SetFont('Arial','',11);
$pdf->Cell(10,10,utf8_decode('Recebi em __/__/____'));
$pdf->Ln(10);
$pdf->Cell(80);
$pdf->Cell(10,10,'_____________________________________________');
$pdf->Ln(5);
$pdf->Cell(90);
$pdf->Cell(10,10,utf8_decode('Nome do responsável pela guarda do ativo'));
$pdf->Output();


?>