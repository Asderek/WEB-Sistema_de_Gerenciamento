<?php
	header('charset=ISO-8859-1');
	require("../utils/fpdf/fpdf.php");

	include ("../utils/newconexao.php");
	
	$index = $_GET['index'];
	//$index = $_POST['livro'];

	$sqlAssistido = "SELECT * FROM `assistidos` WHERE `index` = $index";
	$queryAssistido = $conexao->query($sqlAssistido);
	if ($queryAssistido == false)
	{
		return;
	}
	$resultAssistido = $queryAssistido->fetchAll(PDO::FETCH_ASSOC);
	$nome = $resultAssistido[0]['nome'];
	$cpf = $resultAssistido[0]['cpf'];
	$rg = $resultAssistido[0]['rg'];
	
	
	$sqlEndereco = "SELECT * FROM `atendimentos` WHERE cpf=\"$cpf\"";
	$queryEndereco = $conexao->query($sqlEndereco);
	if ($queryEndereco == false)
	{
		$endereco = "_________________________________________";
	}
	else
	{
		$resultEndereco = $queryEndereco->fetchAll(PDO::FETCH_ASSOC);
		$endereco = $resultEndereco[0]['endereco'];
	}
	
	$endereco = strtoupper($endereco);
	$nome = strtoupper($nome);
	
	$texto =utf8_decode("Formulário Monografia");

	$pdf = new FPDF();
	$pdf->AddPage();

	$pdf->Image('assets/img/logo.jpeg',130,10,70,20);
	
	$pdf->Cell(0,15,'',0,1,'');
	$pdf->Cell(0,5,'',0,1,'');
	//$pdf->SetFont('Castellar','B','18');
	$pdf->SetFont('Times','B','18');
	$pdf->Cell(0,0,utf8_decode("DECLARAÇÃO DE HIPOSSUFICIÊNCIA"),0,1,'C');
	//$pdf->SetFont('Century Gothic','B','12');
	$pdf->SetFont('Times','','12');
	$pdf->Cell(0,20,utf8_decode("(PARA FINS DE ASSISTÊNCIA GRATUITA)"),0,2,'C');
	$pdf->Cell(0,1,utf8_decode(""),0,2,'C');

	
	$pdf->SetFont('Times','','14');
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell(15,15,"",0,0,'J');
	$pdf->MultiCell(162.5,7,utf8_decode("Eu, $nome   identidade n° $rg, CPF n° $cpf Endereço $endereco,   afirmo, com fulcro no art. 5º, LXXIV, da Constituição Federal Federativa do Brasil de 1988, a fim de obter gratuidade de justiça e patrocínio do Escritório de Pratica Jurídica da Pontifícia Universidade Católica do Rio de Janeiro, em conformidade com o art. 98 e 99 do Código de Processo Civil, Lei nº 13.105/15 , que não tenho condições financeiras para arcar com o ônus decorrente das custas processuais e honorários advocatícios, sem prejuízo do sustento próprio e de minha família, eis que recebo, mensalmente, R$ ________, tendo ___ dependentes, a saber:"),0,1,'J');

	date_default_timezone_set('America/Sao_Paulo');
	$data = date('d-m-Y',time());
	$data = explode('-',$data);
	$data = $data[0]."/".$data[1]."/".$data[2];
	
	//Nome

	$pdf->Cell(55,0.2,"",0,0,'C');
	$pdf->Cell(0,5,'',0,1,'');
	
	
	$image1 = 'assets/img/tabela.JPG';
	$pdf->Cell( 0, 120, $pdf->Image($image1, $pdf->GetX()+15, $pdf->GetY(), 163), 0, 0, 'L', false );
	
	
	$pdf->Cell(0,5,'',0,1,'');
	
	$pdf->Cell(55,0.2,"",0,0,'C');
	$pdf->Cell(0,15,'',0,1,'');
	$pdf->Cell(55,100,"",0,0,'C');
	$pdf->Cell(0,20,'',0,1,'');
	$pdf->SetFont('Times','','14');
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell(15,15,"",0,0,'L');
	$pdf->MultiCell(162.5,7,utf8_decode("Declaro reconhecer que estou sujeito(a) às sanções civis, administrativas e criminais previstas na legislação aplicável, sendo comprovada a falsidade das afirmações supre mencionadas."),0,1,'J');

	
	//Data
	$pdf->Cell(0,10,'',0,1,'C');
	$pdf->SetFont('Arial','','12');
	$pdf->setFillColor(220,220,220);
	$pdf->Cell(5,10,"",0,0,'C');
	$pdf->Cell(5,10,"",0,0,'C');
	$pdf->Cell(0,10,utf8_decode("Rio de Janeiro, ___ de ________________ de _____"),0,0,"C");
	//$pdf->MultiCell(50,0,utf8_decode("Rio de Janeiro, ___ de _________ de ____"),'','C',0);


	//Assinatura
	$pdf->Cell(0,30,'',0,1,'');
	$pdf->Cell(40,0.2,'',0,0,'');
	$pdf->Cell(110,0.2,'',1,1,'');
	$pdf->SetFont('Arial','','12');
	//$pdf->Cell(50,10,"",0,0,'C');
	$pdf->Cell(0,10,utf8_decode("(Assinatura)"),0,0,"C");



	//Footer
	
	
	/*$pdf->Cell(100,30,'',0,1,"R");
	$pdf->SetFont('Arial','','7');
	$pdf->Cell(150,1,"",0,0,"R");
	
	$image1 = 'assets/img/footer.JPG';
	$pdf->Cell( 0, 0, $pdf->Image($image1, $pdf->GetX()-137, $pdf->GetY()+25, 163), 0, 0, 'C', false );
	/*
	
	$pdf->Cell(15,10,utf8_decode("Data de impressão"),'',0,"");
	$pdf->MultiCell(25,10,utf8_decode($data),'',"R");
	$pdf->Cell(0,10,'',0,1,"R");*/

	$pdf->Output();
?>