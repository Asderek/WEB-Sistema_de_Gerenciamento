<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/mainProfessorJS.js"></script>
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">

			.panel {
				padding: 0 18px;
				background-color:	#FFFFFA;
				max-height: 0;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
			}
					
			html { 
			  background: url(../../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			  min-height: 100%; 
			}
            .modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
			
			.modal-content
			{
				margin-left:                       	-750px;
				margin-top:                        	0px;
				position:                        	absolute;
				width:                             	1500px;
				left:                               50%;
				top:                                50%;
				background-color:					#FFFFFA;
			}
			
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 align="center">Calendario</h3>
			</div>
			<div class="modal-body">
			<form action="../triagem/procurar.php" method="post">
<?php

	include ('../../newconexao.php');
	$nomeAssistido = $_POST['nome'];
	$atendimento = false;
	$sqlSearch = "SELECT * FROM `atendimentos` WHERE   (`nome` LIKE \"%$nomeAssistido%\" OR `autor`  LIKE \"%$nomeAssistido%\" OR `beneficiado` LIKE \"%$nomeAssistido%\" OR `reu` LIKE \"%$nomeAssistido%\")";
	$nomes = array();
	
	//echo "sqlSearch = $sqlSearch<br>";
	$querySearch = $conexao->query($sqlSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	//echo "rowsSearch = $rowsSearch<br>";
	
	if ($rowsSearch <= 0)
	{
		echo "<h3>Nenhum ";
			echo "Assistido, Autor ou Beneficiado ";
			echo "ou Réu ";
		echo "encontrado com esses dados.</h3>";
	}
	else
	{
		echo '
				<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
					<tbody>';
					
			echo '
					<tr align="center">
						<td><strong>Assistido</strong></td>
						<td><strong>Relação</strong></td>
					</tr>
			';
		for ($i=0;$i<$rowsSearch;$i++)
		{
			
			$nome = $resultSearch[$i]['nome'];
			if (in_array($nome,$nomes))
			{}
			else
			{
				array_push($nomes,$nome);
				$cpf = $resultSearch[$i]['cpf'];
				$reu = $resultSearch[$i]['reu'];
				$beneficiado = $resultSearch[$i]['beneficiado'];
				$autor = $resultSearch[$i]['autor'];
				$descricao = $resultSearch[$i]['descricao'];
				//echo "$i -> Nome = $nome -> reu = $reu -> beneficiado = $beneficiado -> autor = $autor -> descricao = $descricao -> nomeAssistido = $nomeAssistido<br>";
				echo "<tr>";
				echo "<td>";
					echo "<button type=\"submit\" name=\"cpf\" value=\"$cpf\">$nome</button><br>";
				echo "</td>";
				
				echo "<td>";
					if (strstr(strtolower($nome),strtolower($nomeAssistido)))
					{
						echo "Assitido: $nome<br>";
					}if (strstr(strtolower($beneficiado),strtolower($nomeAssistido)))
					{
						echo "Beneficiado: $beneficiado<br>";
					}if (strstr(strtolower($autor),strtolower($nomeAssistido)))
					{
						echo "Autor: $autor<br>";
					}if (strstr(strtolower($reu),strtolower($nomeAssistido)))
					{
						echo "Parte Contraria	: $reu<br>";
					}
				echo "</td>";
				echo "</tr>";
			}
		}
		echo "</tbody> </table>";
	}
	
?>
	</form>
</div>
			<div class="modal-footer">
			</div>
		</div>
</div>
</div>
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        
        </script>
        
    </body>
</html>