<?php
	
	include('../../newconexao.php');
	echo "<div id=\"id_cadastrarAtividade\">";
		include ("modes/mode_cadastraratividade.php");
	echo "</div>";
	echo "<br>";
	/*if(is_null($_POST['matricula']));
	{
		$mat = $_POST['matricula'];
		echo "mat = $mat<br>";
		echo "Deu Pau";
		return;
	}*/
	
	$matricula = $_POST['matricula'];
	{
		echo "<div id=\"id_listaAtividades\">";
			echo "<div id=\"id_commentary\" class=\"commentary-hidden\">";
				echo "<button onclick=\"hideCommentary(); return false;\" class=\"btn btn-primary\" style=\"background-color:#DD0000; right: 0; display: block; position: absolute;\">X</button>";
				echo "<table class=\"table table-bordered\">";
				echo "<tr><td align=\"center\"><strong>Comentario</strong></td></tr>";
				echo "<tr><td align=\"center\" id=\"id_labelCommentary\"></td></tr>";
				echo "</table>";
			echo "</div>";
		
			$sqlInformacao = "SELECT * FROM `alunos` WHERE matricula = $matricula";
			$queryInformacao = $conexao->query($sqlInformacao);
			if ($queryInformacao == false)
			{
				echo "Matricula Incorreta tente novamente<br>";
				return;
			}
			$resultInformacao = $queryInformacao->fetchAll( PDO::FETCH_ASSOC );
			
			$sqlAtividades = "SELECT * FROM `atividades` WHERE matricula = $matricula";
			$queryAtividades = $conexao->query($sqlAtividades);
			if ($queryAtividades == false)
			{
				echo "Matricula Incorreta tente novamente<br>";
				return;
			}
			$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
			$rowsAtividades = count($resultAtividades);

			if($rowsAtividades<0)
			{
				echo "Atividades nao encontrada somehow wtf??";
			}

			
				$professor = $resultInformacao[0]['professor'];
				echo "
					<table class=\"table table-bordered \" style=\"border: 1px black;\" id=\"id_table\">
						<tr bgcolor=\"#505050\" ><td colspan=\"9\" align=\"center\"><strong><font color=\"#FFFFFF\">HISTÓRICO DE ATIVIDADES</font></strong></td></tr>
						
						<tr align=\"center\" style=\"background-color: #F0F0F0;\">
							<td><strong>Horas</strong></td>
							<td><strong>Tipo</strong></td>
							<td><strong>Titulo</strong></td>
							<td><strong>Descricao</strong></td>
							<td><strong>Professor</strong></td>
							<td><strong>Status</strong></td>
							<td><strong>Delete</strong></td>
							<td><strong>Comprovante</strong></td>
							<td><strong>Comentario</strong></td>
						</tr>
				";
				
			include ('../utils/documentos.php');
			$adjust = false;
			//echo "<tr><td>rowsAtividades = $rowsAtividades</td></tr>";
			$missingFile = 0;
			for($i=0;$i<$rowsAtividades;$i++)
			{
				$responsavel = $resultAtividades[$i]['responsavel'];
				$tipo = $resultAtividades[$i]['tipo'];
				$atividade = $resultAtividades[$i]['atividade'];
				$descricao = $resultAtividades[$i]['descricao'];
				$pendente = $resultAtividades[$i]['pendente'];
				$horas = $resultAtividades[$i]['horas'];
				$index = $resultAtividades[$i]['index'];
				$comentario = $resultAtividades[$i]['comentario'];
				$ano = date('Y');
				$mes = date('n');
				if (intval($mes) < 8)
				{
					$strInicio = "$ano-01-01";
					$strFim = "$ano-07-31";
				}
				else
				{
					$strInicio = "$ano-08-01";
					$strFim = "$ano-12-31";
				}
				try {
					$dataAtv = new DateTime($resultAtividades[$i]['dataAtv']);
				} catch (Exception $e) {
					echo "A atividade [(".$i."-".$index.") ". $descricao . "] foi cadastrada de forma errada. Contate a informatica para rever as informações<br>".$e->getMessage()."<br><br>";
					continue;
				}
				
				$dataInicio = new DateTime($strInicio);
				$dataFim = new DateTime($strFim);
				$dataFim->setTime(23,59);
				if ($dataFim < $dataAtv)
					continue;
				if ($dataInicio > $dataAtv)
					continue;
				$button = "";
				switch ($pendente)
				{
					case -1:
						$pendente = "Rejeitado";
					break;
					case 0:
						$pendente = "Aceito";
					break;
					case 1:
						$pendente = "Pendente";
						$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate>X</button>";
					break;
					case 2:
						$pendente = "Secretaria";
						$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate>X</button>";
					break;
				}
				
				$matProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
				$dir  = DOCUMENTS_GETDOCUMENTPATH($matProfessor)."/atividades";
				$filename = $index."-".$matricula."-Comprovante";
				$files = glob("$dir/$filename.*");
				$filePath = $files[0];
				if (file_exists($filePath))
				{
					$anchor = "<a href=\"$filePath\" target=\"_blank\"><img name=\"img\" src=\"../uploads/defaultAssets/download.png\" width=\"40%\" height=\"6%\"></a>";
				}
				else
				{
					if ($pendente == "Pendente" || ($pendente == "Secretaria" && $tipo != "estagio"))
					{
						$accept = ".pdf,image/*";
						$anchor = "<input class=\"class_fileUpload\" type=\"file\" name=\"documento$missingFile\" accept=\"$accept\"><br><button formaction=\"editAtividade.php\" name=\"atvIndex\" value=\"$index\" class=\"btn btn-primary\" formnovalidate>Enviar Documento</button>";
						$adjust = true;
						$missingFile++;
					}
					else
						$anchor = "Sem Documento";
				}
												
				echo "<tr>";
					echo "
					<td width=\"5%\" align=\"center\">$horas</td>
					<td width=\"5%\" align=\"center\">$tipo</td>
					<td width=\"20%\" align=\"center\">$atividade</td>
					<td width=\"45%\" align=\"center\">$descricao</td>
					<td width=\"20%\" align=\"center\">$responsavel</td>
					<td width=\"5%\" align=\"center\">$pendente</td>
					<td align=\"center\">$button</td>
					<td align=\"center\">$anchor</td>";
					echo "<td align=\"center\">";
					if (!empty($comentario))
					{
						echo "<button onclick=\"displayCommentary(event,'$comentario'); return false;\" formnovalidate class=\"btn btn-primary\">Ver</button>";
					}
					else
					{
						echo "---";
					}
					echo "</td>";
				echo "</tr>";
			echo "</div>";
			
		}

		echo	"</table><br>";
		echo "<script>";
		
			if ($adjust == true)
			{
				
				echo "
					var x = document.getElementsByName(\"img\");
					var i;
					for (i = 0; i < x.length; i++) {
					  x[i].setAttribute(\"width\",\"10%\");
					}
				";

			}
		
			echo "function displayCommentary(event, comentario)
			{
				var y = event.screenY;
				console.log(\"y = \"+y);
				
				document.getElementById('id_rightDiv').scrollTop = 564;
				document.getElementById('id_labelCommentary').innerHTML = comentario;
				document.getElementById('id_commentary').setAttribute(\"class\",\"commentary-display\");
				setTimeout(function() { document.getElementById('id_commentary').setAttribute(\"class\",\"commentary-show\"); }, 400 );
			}
			
			function hideCommentary()
			{
				document.getElementById('id_commentary').setAttribute(\"class\",\"commentary-hidden\");
			}
			
			document.body.addEventListener('mousedown', hideCommentary); 
		</script>";
	}
?>


<script>
	var uploadField2 = document.getElementsByClassName("class_fileUpload");

	for(var i=0;i<uploadField2.length;i++)
	{
		uploadField2[i].onchange = function() {
			if(this.files[0].size > 15728640){
			   alert("Arquivo ultrapassa o valor maximo de 15mb por arquivo!");
			   this.value = "";
			};
		};
	}
</script>