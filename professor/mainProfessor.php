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
		
			.btn-primary
			{
				<?php
				$AZUL_ESCURO = "#428BCA";
				$AZUL_CLARO = "#A4DDFF";
				$VERDE_CLARO = "#90FF90";
			
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
						$COR_TEXTO = "#000000";
		
				echo "color: $COR_TEXTO;";
				echo "background-color: $AZUL_CLARO;";
				?>
			}
			
			.accept
			{
				background-color: #30EA70	;
				border: none;
				color: white;
				text-decoration: none;
				display: inline-block;
				font-size: 12px;
				width: 69%;
				font-weight: bold;
			}
			
			.accept:hover {
				box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
			}
			
			.reject {
				background-color: #E02321;
				border: none;
				color: white;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 12px;
				width: 69%;
				font-weight: bold;
			}
			
			.reject:hover {
				box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
			}
		
			.accordion {
				background-color: #eee;
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
				background-color: #ccc;
			}

			.panel {
				padding: 0 18px;
				background-color:	#FFFFFA;
				max-height: 0;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
			}
					
			html { 
			  background: url(assets/BG.jpg) no-repeat center center fixed; 
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
					if ($_POST['matricula'] == 222222)
					{
						echo "background: url(assets/BG_teste.jpg) center center fixed; ";
						//echo "background-color:					#FFFFF6;"
					}
					else
					{
						echo "background-color:					#FFFFF6;";
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
				overflow:							auto;
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
				width:                             	71%;
				overflow:							auto;
			}
			
			.assistido-left
			{
				float:								left;
				position:                        	relative;
				width:                             	29%;
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
			
			.staticInvisibox 
			{
			  border: none;
			  background: transparent;
			  border-bottom: 1px solid #fff;
			  outline: none;
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
			<img width="177" height="113" src="assets/NPJ.bmp" class="custom-logo" alt="Núcleo de Prática Jurídica" sizes="(max-width: 177px) 100vw, 177px" align="right">
		  </a>
		  
		  <a href="http://www.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="66" height="113" src="assets/PUC.png" class="custom-logo" alt="Puntíficia Universidade Catolica - PUC-Rio" sizes="(max-width: 177px) 100vw, 177px" align="left">
		  </a>
		  <form action="mainProfessor.php" method="post">
		  <?php
			$matricula = $_POST['matricula'];
			$a = $_POST['colorButton'];
			$b = $_POST['colorText'];
			
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			  echo "<input type=\"hidden\" name=\"colorButton\" value=\"$a\">";
			  echo "<input type=\"hidden\" name=\"colorText\" value=\"$b\">";
		  ?>		
          <h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
          <h4 class="text-center">
						<?php
							switch($_POST['mode'])
							{
								case "calendario":
									echo "Calendario";
									break;
								case "redigiremail":
									echo "Enviar Email para todos os Alunos Matriculados";
									break;
								case "mostracaso":
									echo "Caso do Assistido";
									break;
								case "listapendencias":
									echo "Lista de Pendências";
									break;
								case "pauta":
									echo "Pauta do Professor";
									break;
								case "listardocumentos":
									echo "Pasta do Professor";
									break;
								case "listarassistidos":
									echo "Lista de Assistidos";
									break;
								case "consultaassistido":
									echo "Informações do Assistido";
									break;
								case "procuraassistido":
									echo "Resultado da Pesquisa";
									break;
								case "listavisitas":
									echo "Visitas Registradas do Professor";
									break;
								case "mostravisita":
									echo "Relatorio da Visita";
									break;
								case "listaralunosplantao":
									echo "Relatório do Plantão";
									break;
								case "verrelatorioplantao":
									echo "Relatório do Plantão";
									break;
								case "listamonitoria":
									echo "Lista de Candidatos à Monitoria";
									break;
								case "vermonitoria":
									echo "Informação do Candidato";
									break;
								case "contato":
									echo "Contate a Secretaria";
									break;
								case "contato":
									echo "Contate a Secretaria";
									break;
								case "aluno":	
									echo "Informações da Aluna";
									break;
								default:
									echo "Texto Default";
									break;
							}
						?>
		  </h4>
		  
		  <a href="https://npj.jur.puc-rio.br" class="btn btn-primary" style="background-color: #D33;">Sair</a>
		  <button type="submit" value="contato" name="mode" class="btn btn-primary" style="background-color: #2D2; color:black; float: right; font-size:150%;"> &#9993 </button>
		  </form>
      </div>
		<div class="modal-body" id="id_print">
			<form class="form col-md-12 center-block" id="id_Form" method="post" action="mainProfessor.php" enctype="multipart/form-data">
				<div class="left-side" id="id_leftDiv">
				
					<?php
					
						$matricula = $_POST['matricula'];
						echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";

						
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
						$styleOn = "box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);";
						
						if(!isset($_POST['mode']))
							$mode = "calendario";
						else
							$mode = $_POST['mode'];
					?>
					
					<?php
						include('../../newconexao.php');
						$sqlProfessor = "SELECT * FROM `professores` WHERE `matricula`=$matricula";
						$queryProfessor = $conexao->query($sqlProfessor);
						$resultProfessor = $queryProfessor->fetchAll(PDO::FETCH_ASSOC);
						if(count($resultProfessor) >0)
						{
							$nomeProfessor = $resultProfessor[0]['nome'];
							echo "<h5 class=\"text-center\" style=\"font-weight: bold;\"><bold>-- $nomeProfessor --</bold></h5>";
						}
						
						
						$sqlAtividade = "SELECT * FROM atividades WHERE `responsavel` = \"$nomeProfessor\" AND pendente = 1";
						$queryAtividade = $conexao->query($sqlAtividade);
						$exclamacao = "";
						
						$stylePendenciaOn = $styleOn;
						$stylePendenciaOff = $styleOff;
						
						if($queryAtividade != false)
						{
							$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
							if (count($resultAtividade) > 0)
							{
								$color = "FFA4A4";
								$halfColor = dechex(hexdec($color[0].$color[1])*0.85);
								$halfColor .= dechex(hexdec($color[2].$color[3])*0.85);
								$halfColor .= dechex(hexdec($color[4].$color[5])*0.85);
								
								$stylePendenciaOn = $styleOn."background-color: #$halfColor;";
								
								$stylePendenciaOff = "background-color: #$color;";
								$exclamacao = "&#9888;";
								
							}
							else
							{
								$stylePendenciaOn .= "background-color: $AZUL_ESCURO;";
							}
						}
						
						{//Audiencias
							$sqlAudiencias = "SELECT * FROM audiencias WHERE `matricula` = $matricula";
							$queryAudiencias = $conexao->query($sqlAudiencias);
							$exclamacaoAudiencia = "";
							
							$styleAudienciaOn = $styleOn;
							$styleAudienciaOff = $styleOff;
							
							if($queryAudiencias != false)
							{
								$resultAudiencias = $queryAudiencias->fetchAll( PDO::FETCH_ASSOC );
								$ativado = false;
								$meses = array();
								$meses['jan'] = "01";
								$meses['fev'] = "02";
								$meses['mar'] = "03";
								$meses['abr'] = "04";
								$meses['mai'] = "05";
								$meses['jun'] = "06";
								$meses['jul'] = "07";
								$meses['ago'] = "08";
								$meses['set'] = "09";
								$meses['out'] = "10";
								$meses['nov'] = "11";
								$meses['dez'] = "12";
								
								for($i=0;$i<count($resultAudiencias);$i++)
								{
									$diaAudiencia = $resultAudiencias[$i]['dia'];
									$mesAudiencia = $resultAudiencias[$i]['mes'];
									$anoAudiencia = $resultAudiencias[$i]['ano'];
									
									$mesAudiencia = $meses[$mesAudiencia];
									
									$dia = date('d');
									$mes = date('m');
									$ano = date('Y');
									
									$strHoje = "$ano-$mes-$dia";
									$strAudiencia = "$anoAudiencia-$mesAudiencia-$diaAudiencia";
									
									//echo "strHoje = $strHoje<br>strAudiencia = $strAudiencia<br>";
									
									
									$dataHoje = new DateTime($strHoje);
									$dataAudiencia = new DateTime($strAudiencia);
									
									$diff = $dataHoje->diff($dataAudiencia);
									
									if ((int)$diff->format("%r%a") < 0)
										continue;
									
									if ($diff->d < 7)
									{
										$color = "FFA4A4";
										$halfColor = dechex(hexdec($color[0].$color[1])*0.85);
										$halfColor .= dechex(hexdec($color[2].$color[3])*0.85);
										$halfColor .= dechex(hexdec($color[4].$color[5])*0.85);
										
										$styleAudienciaOn = $styleAudienciaOn."background-color: #$halfColor;";
										
										$styleAudienciaOff = "background-color: #$color;";
										$exclamacaoAudiencia = "&#9888;";
										break;
									}
										
								}
								if($i >= count($resultAudiencias))
								{
									$styleAudienciaOn .= "background-color: $AZUL_ESCURO;";
								}
							}
						
							
						}
						$styleOn .= "background-color: $AZUL_ESCURO;";
					?>
					
					<?php
						if ($mode != "calendario")
							echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Calendário</button><br>";
						else
							echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Calendário</button><br>";
					?>	
					
						<button type="submit" value="listaaudiencias" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listaaudiencias")? print $styleAudienciaOff: print $styleAudienciaOn ?>"><?php echo "$exclamacaoAudiencia Audiencias $exclamacaoAudiencia"; ?></button><br>
					
						<p align="center" style="background-color: #EEEEEE;"><strong> ~Alunos~ </strong></p>
						<button type="submit" value="listapendencias" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listapendencias")? print $stylePendenciaOff: print $stylePendenciaOn ?>"><?php echo "$exclamacao Pendencias $exclamacao"; ?></button><br>
					<?php	
						if ($mode != "pauta")
							echo "<button type=\"submit\" id=\"id_ButtonPauta\" value=\"pauta\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Ver Pauta</button><br>";
						else
							echo "<button type=\"submit\" id=\"id_ButtonPauta\" value=\"pauta\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Ver Pauta</button><br>";
					?>
					
					<?php	
						if ($mode != "verrelatorioplantao")
							echo "<button type=\"submit\" value=\"verrelatorioplantao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Ver Plantão</button><br>";
						else
							echo "<button type=\"submit\" value=\"verrelatorioplantao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Ver Plantão</button><br>";
					?>
					
						<button type="submit" value="redigiremail" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "redigiremail")? print $styleOff: print $styleOn ?>">Enviar Email</button><br>
						<button type="submit" value="listardocumentos" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listardocumentos")? print $styleOff: print $styleOn ?>">Documentos</button><br>
					<button id="id_accordionAssistidos" class="accordion" onclick="return false">Pesquisar</button>
					<div class="panel">
						<input type="text" id="id_assistido" name="assistido" class="form-control input-lg" placeholder="Jose Maria Marin"></input><br>
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
							echo "<button type=\"submit\" id=\"id_ButtonCPF\" value=\"procuraassistido\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Pesquisar</button><br>";
						else
							echo "<button type=\"submit\" id=\"id_ButtonCPF\" value=\"procuraassistido\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Pesquisar</button><br>";
						
						if ($mode != "listarassistidos")
							echo "<button type=\"submit\" id=\"id_ButtonListaAssistidos\" value=\"listarassistidos\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\">Listar Assistidos</button>";
						else 
							echo "<button type=\"submit\" id=\"id_ButtonListaAssistidos\" value=\"listarassistidos\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\">Listar Assistidos</button>";
						?>	
					</div>

					
					<button class="accordion" id="id_accordionAtividades" onclick="return false;">Atividades Academicas</button>
					<div class="panel">
						<button type="submit" value="listavisitas" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listavisitas")? print $styleOff:print $styleOn ?>">Consultar Eventos</button>
						<br>
						<button type="submit" value="listamonitoria" name="mode" class="btn btn-primary btn-lg btn-block"  style="<?php ($mode != "listamonitoria")? print $styleOff:print $styleOn; ?>">Monitoria</button>	
						<br>
						<?php
					
							$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"cadastroPlantoes(Professor)\" LIMIT 0 , 30";
							$query = $conexao->query($sql);
							$result = $query->fetchAll( PDO::FETCH_ASSOC );
							$status = $result[0]['status'];
							
							if($status==1)
							{
								if ($mode != "escolherplantao")
									echo "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"escolherplantao\" class=\"btn btn-primary btn-lg btn-block	\" style=\"$styleOff\">Cadastrar Plantoes</button>";
								else
									echo "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"escolherplantao\" class=\"btn btn-primary btn-lg btn-block	\" style=\"$styleOn\">Cadastrar Plantoes</button>";
							}
						?>
					</div>	
					
					<button class="accordion" id="id_accordionAtividades" onclick="return false;">Personalizar</button>
					<div class="panel">
						<?php
							echo "<table class=\"table table-bordered\">
								<tr>
									<td>";
										echo "Cor do Texto dos Butões</td><td align=\"right\" colspan=\"2\"><input name=\"colorText\" type=\"color\" value = $COR_TEXTO onchange=\"submit()\">
									</td>
								</tr>";
							echo "<tr>
									<td>
										Cor Dos Butões</td><td align=\"right\" colspan=\"2\"><input name=\"colorButton\" type=\"color\" value = $AZUL_CLARO onchange=\"submit()\">
									</td>
								</tr>
							</table>";
						?>
					</div>
					
					</div>
					<div class="right-side" id="id_rightDiv">
							<?php			
							
							
								if(!isset($_POST['mode']))
									$mode = "calendario";
								else
									$mode = $_POST['mode'];
								
								if ($matricula == 111111)
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
								
								if (strstr($mode,"clickmonitoria") != false)
								{
									$matriculaAluno = substr ($mode,strlen("clickmonitoria"));
									echo "<input type=\"hidden\" value=\"$matriculaAluno\" name=\"matriculaAluno\">";
									echo "
										<input type=\"hidden\" value=\"vermonitoria\" name=\"mode\">
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
								
								if (strstr($mode,"novaatividade") != false)
								{
									$matriculaAluno = substr ($mode,strlen("novaatividade-"));
									$mode = "novaatividade";
								}
								
								if (!empty($_POST['alert']))
								{
									if (strstr($_POST['alert'],"Plantão cadastrado com sucesso") != false)
									{
										echo "
										<h3 id=\"id_disappear\" style=\"text-align:center;background-color:#66FF66; opacity: 1\">
												PLANTÃO CADASTRADO COM SUCESSO
										</h3>";
										echo "
											<script> 
												var a = setInterval(function() 
												{
													var curStyle = document.getElementById('id_disappear').getAttribute(\"style\");
													var curStyleLength = curStyle.length;
													var opacity = document.getElementById('id_disappear').getAttribute(\"style\");
													var startOpacity = opacity.indexOf(\"opacity\");
													curStyle = curStyle.substr(0,startOpacity);
													opacity = opacity.substr(startOpacity);
													currentOpacity = opacity.substr(\"opacity: \".length);
													opacity = opacity.substr(0,opacity.length-currentOpacity.length);
													currentOpacity = parseFloat(currentOpacity);
													currentOpacity = currentOpacity * 0.9;
													opacity = opacity + currentOpacity;
													curStyle = curStyle + \" \" + opacity;
														
													if (currentOpacity < 0.05)
													{
														document.getElementById('id_disappear').setAttribute(\"style\",\"display:none\");
														clearInterval(a);
													}
													else
														document.getElementById('id_disappear').setAttribute(\"style\",curStyle);
												},100); 
											</script>";
									}
								}
								
								switch ($mode)
								{
									case "procuraassistido":
										include("modes/mode_procuraassistido.php");
										break;
									case "pauta":
										include("modes/mode_pauta.php");
										break;
									case "plantao":
										include("modes/mode_plantao.php");
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
									case "listamonitoria":
										include("modes/mode_listamonitoria.php");
										break;
									case "vermonitoria":
										include("modes/mode_vermonitoria.php");
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
									case "listapendencias":
										include("modes/mode_pendencias.php");
										break;
									case "listaratividadesaluno":
										include("modes/mode_listaratividadesaluno.php");
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
									case "redigiremail":
										include("modes/mode_redigiremail.php");
										break;
									case "contato":
										include("modes/mode_contato.php");
										break;
									case "audiencia":
										include("modes/mode_audiencia.php");
										break;
									case "listaaudiencias":
										include("modes/mode_listaaudiencias.php");
										break;
									case "novaatividade":
										include("modes/mode_novaatividade.php");
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
								  //acc[i].addEventListener("touchstart", toggle);
								}
								
								var check = document.getElementById("id_checkbox");
								if (check != null)
								{
									check.addEventListener("click",checkAll);
								}
								
								var mode = "<?php echo $mode; ?>";
														
								if (mode == "listamonitoria" || mode == "listaralunosplantao" || mode == "listavisitas" || mode == "escolherplantao" )
								{
									document.getElementById("id_accordionAtividades").click();
								}
								
								if (mode == "consultaassistido" || mode == "listarassistidos")
								{
									document.getElementById("id_accordionAssistidos").click();
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
		function printData()
		{
			var	i = 1;
		   newWin= window.open("");
		   
		   console.log(document.getElementById("printTable"+i));
		  
		  var professor = "<?php echo $nomeProfessor ?>";
		    console.log(professor);
		   
		   newWin.document.write("<h3 class=\"text-center\">Relação de Plantão<br>Professor(a): " + professor + "</h3>");
		   while (document.getElementById("printTable"+i) != false)
		   {
			var divToPrint=document.getElementById("printTable"+i);
			newWin.document.write(divToPrint.outerHTML);
			i++;
		   }
		   
		   newWin.print();
		   newWin.close();
		   
		   //return false;
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