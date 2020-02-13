<?php

	include('../../teste/utils/newconexao.php');
	$fileName = "ListaAlunas".".csv";
	
	$sqlArquivoMorto = "SELECT * FROM alunos WHERE 1 ORDER BY `disciplina`, `professor`, `nome` ASC";
	$queryArquivoMorto = $conexao->query($sqlArquivoMorto);
	$myfile = fopen($fileName,"w");
	$i=0;
	if ($queryArquivoMorto != false)
	{
		$resultArquivoMorto = $queryArquivoMorto->fetchAll(PDO::FETCH_ASSOC);
		
		echo "matricula;nome;professor;disciplina;email;telefone;oab;oficina;passado1;passado2;atual1;atual2;primeirafase\r\n";
		while ($i<count($resultArquivoMorto))
		{
			$matricula = $resultArquivoMorto[$i]['matricula'].";";
			$nome = $resultArquivoMorto[$i]['nome'].";";
			$oab = $resultArquivoMorto[$i]['oab'].";";
			$oficina = $resultArquivoMorto[$i]['oficina'].";";
			$email = $resultArquivoMorto[$i]['email'].";";
			$telefone = $resultArquivoMorto[$i]['telefone'].";";
			$passado1 = $resultArquivoMorto[$i]['passado1'].";";
			$passado2 = $resultArquivoMorto[$i]['passado2'].";";
			$atual1 = $resultArquivoMorto[$i]['atual1'].";";
			$atual2 = $resultArquivoMorto[$i]['atual2'].";";
			$primeirafase = $resultArquivoMorto[$i]['primfase'].";";
			$professor = $resultArquivoMorto[$i]['professor'].";";
			$disciplina = $resultArquivoMorto[$i]['disciplina'].";";

			echo "$matricula";
			echo "$nome";
			echo "$professor";
			echo "$disciplina";
			echo "$email";
			echo "$telefone";
			echo "$oab";
			echo "$oficina";
			echo "$passado1";
			echo "$passado2";
			echo "$atual1";
			echo "$atual2";
			echo "$primeirafase";
			echo "\r\n";
			$i++;
			
			if ($i <count($resultArquivoMorto)-1)
			{
				fclose($myfile);
				
				header("Content-type: text/csv");
				header("Content-disposition: attachment; filename = $fileName");
				readfile($fileName);
			}
		}
		
		
	}
?>