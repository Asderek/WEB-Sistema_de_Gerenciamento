<!DOCTYPE html>
<html lang="en">
    <head>
		<link rel="icon" href="../uploads/defaultAssets/npj.png">
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
		
		
			.accept
			{
				background-color: #30EA70	;
				border: none;
				color: white;
				padding: 5px 17px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 19px;
				width: 49%;
				font-weight: bold;
			}
			
			.btn-primary
			{
				<?php
				$AZUL_ESCURO = "#428BCA";
				$AZUL_CLARO = "#A4DDFF";
				$VERDE_CLARO = "#90FF90";
				
				if (empty($_POST['color']))
					$COR_MONITOR = "#FFFFFA";
				else
					$COR_MONITOR = $_POST['color'];
				
				if (empty($_POST['colorDefault']))
					$COR_DEFAULT = "#FFFFFA";
				else
					$COR_DEFAULT = $_POST['colorDefault'];
				
				if (!empty($_POST['colorButton']))
				{
					$AZUL_CLARO = $_POST['colorButton'];
					$R = $AZUL_CLARO[1].$AZUL_CLARO[2];
					$G = $AZUL_CLARO[3].$AZUL_CLARO[4];
					$B = $AZUL_CLARO[5].$AZUL_CLARO[6];
					
					$Rdec = hexdec($R);
					$Gdec = hexdec($G);
					$Bdec = hexdec($B);
					
					$Rdec = $Rdec*0.5;
					$Gdec = $Gdec*0.5;
					$Bdec = $Bdec*0.5;
					
					$R = dechex($Rdec);
					$G = dechex($Gdec);
					$B = dechex($Bdec);
					if (strlen($R) <2)
						$R = '0'.$R;
					if (strlen($G) <2)
						$G = '0'.$G;
					if (strlen($B) <2)
						$B = '0'.$B;
					
					$AZUL_ESCURO = "#".$R.$G.$B;
				}
				
				
				if (!empty($_POST['colorText']))
						$COR_TEXTO = $_POST['colorText'];
				else
						$COR_TEXT = "#FFFFFF";
		
				echo "color: $COR_TEXTO;";
				echo "background-color: $AZUL_CLARO;";
				?>
			}
			
			.reject {
				background-color: #E02321;
				border: none;
				color: white;
				padding: 5px 17px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 19px;
				width: 49%;
				font-weight: bold;
			}
			
			.accept:hover {
				box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
			}
		
		
		
			.accordion {
				background-color: #eee; <!-- Cor do lado de fora do accordion -->
				color: #444;
				cursor: pointer;
				padding: 10px;
				width: 100%;
				border: none;
				text-align: left;
				outline: none;
				font-size: 15px;
				transition: 0.4s;
			}

			.active, .accordion:hover {
				background-color: #ccc;<!-- Cor do accordion quando eu hovero -->
			} 

			.panel {
				padding: 0 18px;
				background-color:	#FF0000 <!-- Cor da parte de dentro do accordion -->;
				max-height: 0;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
				<?php
					
					$mode = $_POST['mode'];
					switch ($mode)
					{
						case "pauta":
						case "aluno":
						case "listaratividadesaluno":
						case "listardocumentos":
						case "procuraassistido":
						case "listarassistidos":
						case "listavisitas":
						case "listaralunosplantao":
						case "verrelatorioplantao":
							echo "background-color:					$COR_MONITOR;";
							break;
						default:
							echo "background-color:					$COR_DEFAULT;";
					}
				?>
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
				
				<?php 
					switch ($mode)
					{
						case "pauta":
						case "aluno":
						case "listaratividadesaluno":
						case "listardocumentos":
						case "procuraassistido":
						case "listarassistidos":
						case "listavisitas":
						case "listaralunosplantao":
						case "verrelatorioplantao":
							echo "background-color:					$COR_MONITOR;";
							break;
						default:
							echo "background-color:					$COR_DEFAULT;";
					}
					
				?>
			}
			
			.right-side
			{
				float:								right;
				position:                        	relative;
				width:                             	75%;
				top:                                50%;
				overflow:							auto;
				height:								550px;
				
				
			}
			
			.rightSide-Top
			{
				position:                        	relative;
				height:								75%;
				overflow:							visible;
			}
			.Bottom
			{
				position:                        	relative;
				height:								100%;
			}
			
			.left-side
			{
				float:								left;
				position:                        	relative;
				width:                             	25%;
				overflow:							auto;
			}
			
			.left-side:after {
			  content: "";
			  background-color: #DDDDDD;
			  position: absolute;
			  width: 1px;
			  height: 710px;
			  left: 98%;
			  display: block;
			}
			
			.assistido-right
			{
				float:								right;
				position:                        	relative;
				width:                             	65%;
				overflow:							auto;
			}
			
			.assistido-left
			{
				float:								left;
				position:                        	relative;
				width:                             	35%;
				overflow:							auto;
			}
			
			.button-link
			{
				background:							none;
				color:								blue;
				border:								none; 
				padding:							0;
				font: 								inherit;
				border-bottom:						1px solid #444; 
				cursor: 							pointer;
			}
			
			.invisibox 
			{
			  border: none;
			  background: transparent;
			  border-bottom: 1px solid #fff;
			  outline: none;
			}
			
			.invisibox:hover
			{
				background: white;
				border: solid;
				outline: initial;
			}
			
			#submit {
			  background-color: #B33;
			  padding: .5em;
			  -moz-border-radius: 5px;
			  -webkit-border-radius: 5px;
			  border-radius: 6px;
			  color: #fff;
			  font-family: 'Oswald';
			  font-size: 20px;
			  text-decoration: none;
			  border: none;
			}

			#submit:hover {
			  border: none;
			  background-color: #F33;
			  box-shadow: 0px 0px 1px #777;
			}
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content" id="id_content">
      <div class="modal-header">
		  <a href="https://npj.jur.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="177" height="113" src="../../assets/img/NPJ.bmp" class="custom-logo" alt="Núcleo de Prática Jurídica" sizes="(max-width: 177px) 100vw, 177px" align="right">
		  </a>
		  
		  <a href="http://www.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="66" height="113" src="../../assets/img/PUC.png" class="custom-logo" alt="Puntíficia Universidade Catolica - PUC-Rio" sizes="(max-width: 177px) 100vw, 177px" align="left">
		  </a>
		  <form action="mainMonitor.php" method="post">
		  <?php
			$matricula = $_POST['matricula'];
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
		  ?>
          <h1 class="text-center">Núcleo de Prática Jurídica</h1>
		  <h5 class="text-center"> Sistema SILP ver. 1.0 </h5>
		  <h4 class="text-center">
		  <?php
			$mode = $_POST['mode'];
				switch ($mode)
				{
					case "procuraassistido":
						echo "Pesquisa de Assistidos";
						break;
					case "confirmamonitoria":
						echo "Confirmação de Dados de Monitoria";
						break;
					case "pauta":
						echo "Pauta de Alunos";
						break;
					case "aluno":
						echo "Informações do Aluno";
						break;
					case "listavisitas":
						echo "Lista de Visitas Abertas";
						break;
					case "mostravisita":
						echo "Informações de Visita";
						break;
					case "mostracaso":
						echo "Caso do Assistido";
						break;
					case "escolherplantao":
						echo "Escolha de Plantão do Aluno";
						break;
					case "registrarplantao":
						echo "Registro de Plantão";
						break;
					case "consultaassistido":
						echo "Ficha do Assistido";
						break;
					case "listaratividadesaluno":
						echo "Lista de Atividades do Aluno";
						break;
					case "listaralunosplantao":
						echo "Lista de Alunos Cadastrados no Plantão";
						break;
					case "listardocumentos":
						echo "Lista de Documentos da Pasta do Professor";
						break;
					case "verrelatorioplantao":
						echo "Relatorio de Plantao";
						break;
					case "listarassistidos":
						echo "Listagem de Assistidos do(a) Professor(a)";
						break;
					case "informacao":
						echo "Informações do Monitor";
						break;
					case "cadastraratividade":
						echo "Cadastrar Nova Atividade";
						break;
					case "listaatividades":
						echo "Lista de Atividades do Aluno";
						break;
					case "monitoria":
						echo "Informações de Monitoria";
						break;
					case "verassistencia":
						echo "Informação do Caso do Assistido";
						break;
					case "mostraassistido":
						echo "";
						break;
					case "avaliacao":
						echo "Avaliação EMA";
						break;
					case "downloads":
						echo "Documentos";
						break;
					case "listavisitas":
						echo "Lista de Visitas";
						break;
					case "listaplantao":
						echo "Lista de Plantões";
						break;
					case "escolherplantao":
						echo "Escolha de Plantão";
						break;
					case "listavisitasparaalunos":
						echo "Lista de Visitas Abertas";
						break;
					default:
						echo "Calendário";
						break;
						
				}
		  
		  ?>
		  </h4>
		   <a href="https://npj.jur.puc-rio.br" class="btn btn-primary" style="background-color: #D33;">Sair</a>
		  <button type="submit" value="contato" name="mode" class="btn btn-primary" style="background-color: #2D2; color:black; float: right;" formnovalidate>Contato</button>
		  </form>
      </div>
		<div class="modal-body" id="id_print">
			<div class="left-side" id="id_leftDiv">
				<form class="form col-md-12 center-block" id="id_Form" method="post" action="mainMonitor.php" enctype="multipart/form-data">
					
					<?php
						include('../../newconexao.php');
						include('../utils/professores.php');
					
						$matricula = $_POST['matricula'];
						echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
						
						$sqlEhAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
						$queryEhAluno = $conexao->query($sqlEhAluno);
						$resultEhAluno = $queryEhAluno->fetchAll(PDO::FETCH_ASSOC);
						
						$sqlMonitor = "SELECT * FROM `monitores` WHERE `monitor` = $matricula";
						$queryMonitor = $conexao->query($sqlMonitor);
						if ($queryMonitor == false)
						{
						}
						else
						{
							$resultMonitor = $queryMonitor->fetchAll( PDO::FETCH_ASSOC );
							$rowsMonitor = count($resultMonitor);
							if ($rowsMonitor <= 0)
							{
								echo "Aluno não está cadastrado como monitor<br>";
								return;
							}
							$matriculaResponsavel = $resultMonitor[0]['professor'];
							echo "<input type=\"hidden\" name=\"matriculaResponsavel\" value=\"$matriculaResponsavel\">";
						}
						
						
						if (empty($_POST['matricula']))
						{
							echo "oi";
							echo "
									<button type=\"submit\" id=\"ID_button\" formaction=\"index.php\"></button>
									<script type=\"text/javascript\">
										document.getElementById('ID_button').click();
									</script>
							";
						}
						
						$styleOff = "background-color: $AZUL_CLARO;";
						$styleOn = "box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19); background-color: $AZUL_ESCURO";
						
						
						if(!isset($_POST['mode']))
							$mode = "calendario";
						else
							$mode = $_POST['mode'];
						
					?>
					
					<br>
					
					<?php 
						if (/*$resultEhAluno[0]['professor'] != "LUCAS P NEPOMUCENO"*/ true)
						{
					?>
							<p align="center" style="background-color: #EEEEEE;"><strong> ~Perfil Aluno~ </strong></p>
							<?php
								if ($mode != "calendario")
									echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\" formnovalidate>Calendário</button>	";
								else
									echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\" formnovalidate>Calendário</button>";
							?>	
							<br>
							<?php
								if ($mode != "informacao")
								{
									echo '<button type="submit" id="id_ButtonInformacao" value="informacao" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOff.'" formnovalidate>Informação</button>	';
								}
								else
								{
									echo '<button type="submit" id="id_ButtonInformacao" value="informacao" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOn.'" formnovalidate>Informação</button>	';
								}
							?>
							<br>
							<?php
								if ($mode != "listaatividades")
									echo '<button type="submit" id="id_ButtonListaAssistidos" value="listaatividades" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOff.'" formnovalidate>Atividades</button>';
								else
								{
									echo '<button type="submit" id="id_ButtonListaAssistidos" value="listaatividades" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOn.'" formnovalidate>Atividades</button>';
								}
							?>
							<br>
							<?php
									include('../../newconexao.php');
							
									$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"avaliacao\" LIMIT 0 , 30";
									$query = $conexao->query($sql);
									$result = $query->fetchAll( PDO::FETCH_ASSOC );
									$status = $result[0]['status'];
									
									if($status==1)
									{
										echo "<button type=\"submit\" value=\"avaliacao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\""; 
										if ($mode == "avaliacao")
											echo $styleOn;
										else
											echo $styleOff;
										echo "\" formnovalidate>Avaliacao EMA</button><br>	";
									}
								?>						
							
							
							<button type="submit" value="downloads" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "downloads")? print $styleOff:print $styleOn ?>" formnovalidate>Downloads</button>
							<br>
							<button class="accordion" id="id_accordionAtividadesAlunos" onclick="return false">Atividades Academicas</button>
							<div class="panel">
								<button type="submit" value="listavisitasparaalunos" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listavisitasparaalunos")? print $styleOff:print $styleOn ?>" formnovalidate>Eventos</button>
								<br>
								<button type="submit" value="monitoria" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "monitoria")? print $styleOff:print $styleOn ?>" formnovalidate>Monitoria</button>	
								<br>
								<?php
									include('../../newconexao.php');
							
									$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"inscricaoPlantoes(Alunos)\" LIMIT 0 , 30";
									$query = $conexao->query($sql);
									$result = $query->fetchAll( PDO::FETCH_ASSOC );
									$status = $result[0]['status'];
									
									if($status==1)
									{
										echo "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"listaplantao\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate>Cadastrar em Plantão</button>";
									}
									
									$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"simulado\" LIMIT 0 , 30";
									$query = $conexao->query($sql);
									$result = $query->fetchAll( PDO::FETCH_ASSOC );
									$status = $result[0]['status'];
									
									if($status==1)
									{
										echo "<button type=\"submit\" name=\"mode\" value=\"inscricaosimulado\" class=\"btn btn-primary btn-lg btn-block\" style=\"";
										if (strpos($mode,"simulado") == false)
											echo "$styleOff";
										else
											echo "$styleOn";
										echo "\" formnovalidate>Simulado</button>";
									}
								?>
							</div>
					<?php
						}
						/*else
						{
								if ($mode != "calendario")
									echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Calendário</button>	";
								else
									echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Calendário</button>";
								echo "<br>";
						}*/
					?>
					<p align="center" style="background-color: #EEEEEE;"><strong> ~Perfil Monitor~ </strong></p>
					<p align="center"><strong> Professor: <?php echo ucwords(PROFESSORES_GETPROFESSORMONITORIANAME($matricula)); ?> </strong></p>
					<br>
					<?php	
						if ($mode != "pauta")
							echo "<button type=\"submit\" id=\"id_ButtonPauta\" value=\"pauta\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\" formnovalidate>Ver Pauta</button><br>";
						else
							echo "<button type=\"submit\" id=\"id_ButtonPauta\" value=\"pauta\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\" formnovalidate>Ver Pauta</button><br>";
					?>
					<button id="id_ButtonVerPlantao" name="mode" value="listaralunosplantao" align="center" type="submit" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listaralunosplantao")? print $styleOff:print $styleOn; ?>" formnovalidate>Ver Relação de Plantão</button>
						<br>
						<button type="submit" value="listardocumentos" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listardocumentos")? print $styleOff: print $styleOn ?>" formnovalidate>Documentos</button><br>
					<button id="id_accordionAssistidos" class="accordion" onclick="return false">Pesquisar</button>
					<div class="panel">
						<input type="text" id="id_assistido" name="nomeAssistido" class="form-control input-lg" placeholder="Jose Maria Marin"></input><br>
						<table class="table">
							<tr align="center">
								<td width = 50%>
									<input type="radio"  name="tipo"  value="1" checked><label>Assistido
								</td>
								<td width = 50%>
									<input type="radio"  name="tipo"  value="2"><label>Parte Contraria
								</td>
							  </tr>
						 </table>
						<?php
						if ($mode != "procuraassistido")
							echo "<button type=\"submit\" id=\"id_ButtonCPF\" value=\"procuraassistido\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\" formnovalidate>Pesquisar</button><br>";
						else
							echo "<button type=\"submit\" id=\"id_ButtonCPF\" value=\"procuraassistido\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\" formnovalidate>Pesquisar</button><br>";
						
						if ($mode != "listarassistidos")
							echo "<button type=\"submit\" id=\"id_ButtonListaAssistidos\" value=\"listarassistidos\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\" formnovalidate>Listar Assistidos</button>";
						else 
							echo "<button type=\"submit\" id=\"id_ButtonListaAssistidos\" value=\"listarassistidos\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\" formnovalidate>Listar Assistidos</button>";
						?>	
					</div>

					
					<button class="accordion" id="id_accordionAtividades" onclick="return false;">Atividades Academicas</button>
					<div class="panel">
						<button type="submit" value="listavisitas" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listavisitas")? print $styleOff:print $styleOn ?>" formnovalidate>Consultar Eventos</button>
						<br>
					</div>		
					
					<button class="accordion" id="id_accordionAtividades" onclick="return false;">Personalizar</button>
					<div class="panel">
						<?php
							
							echo "<table class=\"table table-bordered\"><tr><td>";
								echo "Cor do Texto dos Butões</td><td align=\"right\" colspan=\"2\"><input name=\"colorText\" type=\"color\" value = $COR_TEXTO onchange=\"submit()\"></td></tr>";
							echo "<tr><td>Cor Dos Butões</td><td align=\"right\" colspan=\"2\"><input name=\"colorButton\" type=\"color\" value = $AZUL_CLARO onchange=\"submit()\"></td></tr></table>";
						?>
					</div>		
					
					</div>
					<div class="right-side" id="id_rightDiv">
							<?php			
							
								if(!isset($_POST['mode']))
									$mode = "calendario";
								else
									$mode = $_POST['mode'];
								
								echo "mode = $mode<br>";
								
								if (strstr($mode,"veraluno") != false)
								{
									$matriculaAluno = substr ($mode,8);
									echo "<input type=\"hidden\" value=\"$matriculaAluno\" name=\"matriculaAluno\">";
									echo "
										<input type=\"hidden\" value=\"aluno\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"verassistido") != false)
								{
									$cpfassistido = substr ($mode,12);
									echo "<input type=\"hidden\" value=\"$cpfassistido\" name=\"cpf\">";
									echo "
										<input type=\"hidden\" value=\"consultaassistido\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"veratividades") != false)
								{
									$matriculaAluno = substr ($mode,strlen("veratividades"));
									echo "<input type=\"hidden\" value=\"$matriculaAluno\" name=\"matriculaAluno\">";
									echo "
										<input type=\"hidden\" value=\"listaratividadesaluno\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"vervisita") != false)
								{
									$idVisita = substr ($mode,strlen("vervisita"));
									echo "<input type=\"hidden\" value=\"$idVisita\" name=\"idVisita\">";
									echo "
										<input type=\"hidden\" value=\"mostravisita\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"vercaso") != false)
								{
									$idCaso = substr ($mode,strlen("vercaso"));
									echo "<input type=\"hidden\" value=\"$idCaso\" name=\"idCaso\">";
									echo "
										<input type=\"hidden\" value=\"mostracaso\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								switch ($mode)
								{
									case "confirmacaosimulado":
										include("modes/mode_confirmacaosimulado.php");
										break;
									case "inscricaosimulado":
										include("modes/mode_inscricaosimulado.php");
										break;
									case "procuraassistido":
										include("modes/mode_procuraassistido.php");
										break;
									case "confirmamonitoria":
										include("modes/mode_confirmamonitoria.php");
										break;
									case "pauta":
										include("modes/mode_pauta.php");
										break;
									case "aluno":
										include("modes/mode_aluno.php");
										break;
									case "listavisitas":
										include("modes/mode_listavisitas.php");
										break;
									case "mostravisita":
										include("modes/mode_vervisita.php");
										break;
									case "mostracaso":
										include("modes/mode_vercaso.php");
										break;
									case "escolherplantao":
										include("modes/mode_escolherplantao.php");
										break;
									case "registrarplantao":
										include("modes/mode_registrarplantao.php");
										break;
									case "consultaassistido":
										include("modes/mode_consultaassistido.php");
										break;
									case "listaatividades":
										include("modes/mode_listaratividades.php");
										break;									
									case "listaralunosplantao":
										include("modes/mode_listaralunosplantao.php");
										break;									
									case "listardocumentos":
										include("modes/mode_listardocumentos.php");
										break;
									case "verrelatorioplantao":
										include("modes/mode_verrelatorioplantao.php");
										break;
									case "listarassistidos":
										include("modes/mode_listarassistidos.php");
										break;
									case "informacao":
										include ("modes/mode_informacao.php");
										break;
									case "cadastraratividade":
										include("modes/mode_cadastraratividade.php");
										break;
									case "monitoria":
										include("modes/mode_monitoria.php");
										break;
									case "verassistencia":
										include("modes/mode_vercaso.php");
										break;
									case "mostraassistido":
										include("modes/mode_mostraassistido.php");
										break;
									case "avaliacao":
										include("modes/mode_avaliacao.php");
										break;
									case "downloads":
										include("modes/mode_downloads.php");
										break;
									case "listavisitas":
										include("modes/mode_listavisitas.php");
										break;
									case "listaplantao":
										include("modes/mode_plantao.php");
										break;
									case "escolherplantao":
										include("modes/mode_escolherplantao.php");
										break;
									case "listavisitasparaalunos":
										include("modes/mode_listavisitasparaalunos.php");
										break;
									case "contato":
										include("modes/mode_contato.php");
										break;
									case "audiencia":
										include("modes/mode_audiencia.php");
										break;
									default:
										include("modes/mode_calendario.php");
										break;
										
								}
								//echo "<br><br>";print_r($_POST);
							?>
					</div>
					
					<script>
							document.getElementById("id_rightDiv").style.height = (screen.height-screen.height*0.34)+"px";
							document.getElementById("id_leftDiv").style.height = (screen.height-screen.height*0.34)+"px";
							
							onload = function () 
							{
								{
									width = 1500;
									width = screen.width*0.95;
									height = screen.height*0.85;
									
									divStyle = document.getElementById('id_content').style;
									divStyle.marginTop = "0px";
									divStyle.position = "absolute";
									divStyle.overflow = "auto";
									divStyle.left = "50%";
									divStyle.top = "50%";
									divStyle.width = width+"px";
									divStyle.height = height+"px";
									divStyle.marginLeft = -width/2+"px";
								}
								
								var input = document.getElementById("id_assistido");

								// Execute a function when the user releases a key on the keyboard
								input.addEventListener("keyup", function(event) {
								  // Cancel the default action, if needed
								  event.preventDefault();
								  // Number 13 is the "Enter" key on the keyboard
								  if (event.keyCode === 13) {
									// Trigger the button element with a click
									document.getElementById("id_ButtonCPF").click();
								  }
								});
								
								var acc = document.getElementsByClassName("accordion");
								var i;

								for (i = 0; i < acc.length; i++) {
								  acc[i].addEventListener("click", toggle);
								  acc[i].addEventListener("touch", toggle);
								}
								
								var check = document.getElementById("id_checkbox");
								if (check != null)
								{
									check.addEventListener("click",checkAll);
								}
								
								var mode = "<?php echo $mode; ?>";
														
								//Atividades Academicas de Monitor						
								if (mode == "listamonitoria" || mode == "listaralunosplantao" || mode == "listavisitas" || mode == "escolherplantao" )
								{
									document.getElementById("id_accordionAtividades").click();
								}
								//Pesquisar
								if (mode == "consultaassistido" || mode == "listarassistidos")
								{
									document.getElementById("id_accordionAssistidos").click();
								}
								
								//Atividades Academicas de Aluno
								if (mode == "monitoria" || mode == "listavisitasparaalunos" || mode == "inscricaosimulado")
								{
									document.getElementById("id_accordionAtividadesAlunos").click();
								}
							}

					</script>
			
				</form>
			
			
				
		</div>
	  
      <div class="modal-footer"></div>
  </div>
  </div>
</div>
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        
		function checaData()
		{
			var date = document.getElementById('id_date').value;
			
			var n = date.indexOf("/");
			if (n != -1)
			{
				var dia = date.substr(0,2);
				var mes = date.substr(3,2);
				var ano = date.substr(6);
				console.log("ano = " + ano + " mes = " + mes + " dia = " + dia);
				date = ano + '-' + mes + '-' + dia;
			}
			
			var today = new Date();
			var atvDate = new Date(date);
			atvDate.setDate(atvDate.getDate()+1);
			allowed = true;
			
			document.getElementById('id_Enviar').setAttribute("style","visibility: visible;");
			document.getElementById('id_aviso').setAttribute("style","visibility: hidden; float: left; vertical-allign: middle;");
			
			if(atvDate.getYear() > today.getYear())
				allowed = false;
			if (atvDate.getMonth() > today.getMonth())
				allowed = false;
			if (atvDate.getMonth() == today.getMonth() && atvDate.getDate() > today.getDate())
				allowed = false;
			if (atvDate.getMonth() < today.getMonth()-1)
				allowed = false;
			
			if (today.getMonth()-1 == atvDate.getMonth() && today.getDate() > 10)
				allowed = false;
			
			
			if (allowed == false)
			{
				document.getElementById('id_Enviar').setAttribute("style","visibility: hidden;");
				document.getElementById('id_aviso').setAttribute("style","visibility: visible; float: left; vertical-allign: middle;");
				//document.getElementById('id_aviso').innerHTML = date;
			}
			
		}
		
		function checaEstagio()
		{
			var tipoAtividade = document.getElementById('id_TipoAtividade').value;
			
			if (tipoAtividade == "estagio")
				alert("O documento será enviado para a secretaria para pré-aprovação");
			
		}
		
		function checkArquivoRepetido()
		{
			var fileName = document.getElementById('id_fileName').value;
			var limite = <?php echo count($arrayArquivos); ?>;
			console.log("limite = " + limite);		
			var array = <?php echo json_encode($arrayArquivos); ?>;
			console.log("array = " +array);
			var disabled = false;
			for(var i=0;i < limite ;i++)
			{
				displayName = array[i];
				console.log("displayName = "+ displayName);
				console.log("fileName = "+ fileName);
				if (displayName == fileName)
				{
					document.getElementById('id_botaoEnviar').setAttribute("disabled","disabled");
					document.getElementById('id_botaoEnviar').setAttribute("style","visibility: hidden;");
					document.getElementById('id_alert').setAttribute("style","visibility: visible;");
					disabled = true;
				}
			}
			if (disabled == false)
			{
				document.getElementById('id_botaoEnviar').removeAttribute("disabled");	
				document.getElementById('id_botaoEnviar').setAttribute("style","visibility: visible;");
				document.getElementById('id_alert').setAttribute("style","visibility: hidden;");
			}
			
		}
		
        </script>
        
    </body>
</html>