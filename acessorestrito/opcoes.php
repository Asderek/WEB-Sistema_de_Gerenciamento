<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html 
		{ 
			background: url(../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.modal-footer {   border-top: 0px; }
	
		.button {
			background-color: #16B7CC;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			width: 70%;
			font-weight: bold;
		}
		
		.button2 {
			background-color: #085966;
			border: none;
			color: white;
			padding: 10px 39px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 19px;
			width: 49%;
			margin-left: 25%;
			font-weight: bold;
		}
		
		.button:hover {
			box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
		}
		
		button:disabled {
			background-color: #0B5B66;
			opacity: 0.6;
			cursor: not-allowed;
		}
	
		p.padding 
		{
				padding-left: 1cm;
		}
	
        </style>
    </head>
    
    
    <body  >
        
		<!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h1 class="text-center">Núcleo de Prática Jurídica</h1>
					<h3 class="text-center">Acesso Restrito</h3>
					</div>
					<div class="modal-body">
								<?php
									
									include('../newconexao.php');
									
									$matricula = $_POST['matricula'];
									$senha = $_POST['senha'];
									$radio = $_POST['tipo'];
									
									while($matricula[0] == '0')
										$matricula = substr($matricula,1);
									
									//echo "<label id=\"id_mensagem\"></label>";
			
									echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
									
									#{
										$inject = false;
										
										$injection1 = "DROPTABLE";
										$injection2 = "aluno";
										$injection3 = "ALTER";
										$injection4 = "OR";
										
										$injections = array (	"DROPTABLE","aluno","ALTER","OR","INSERT","DELETE","UPDATE","SELECT");
										
										foreach($injections as $inj)
										{
											if(strpos($matricula,$inj) !== false )
											{
												$inject = true;
											}
										}
										
										if($inject == true)
										{
											echo "My code is sanitized bitch";
											echo "<a href=\"javascript: window.history.go(-1)\">Voltar</a>";
											return;
										}
										
									#}
									
									$secretaria = false;
									if($radio == 1)
									{
										$sqlSecretaria = "SELECT * FROM `NPJ_login` WHERE `login` = \"$matricula\"";
										$querySecretaria = $conexao->query($sqlSecretaria);
										if ($querySecretaria != false)
										{
											$resultSecretaria = $querySecretaria->fetchAll(PDO::FETCH_ASSOC);
											if ( count($resultSecretaria) != 0)
											{
												$secretaria = true;
												if ($resultSecretaria[0]['alter'] == 1)
												{
													echo "  
														<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
						
						
															<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
															<input type=\"hidden\" name=\"email\" value=\"npj@puc-rio.br\"></input>
															<input type=\"hidden\" name=\"tipo\" value=\"$radio\"></input>
						
															<div class=\"form-group\">
															  <input type=\"password\" name=\"newMat\" class=\"form-control input-lg\" placeholder=\"Nova Senha\" required>
															</div>				
															
															<div class=\"form-group\">
															  <input type=\"password\" name=\"confirmMat\" class=\"form-control input-lg\" placeholder=\"Repita a Senha\" required>
															</div>	
															
															<div class=\"form-group\">
															  <button type=\"submit\" class=\"button2 btn-primary btn-lg \">Enviar</button>
															</div>
													  
														</form>		
													";
												}
												else if ($senha == $resultSecretaria[0]['senha'])
												{
													$target = $resultSecretaria[0]['target'];
													//echo "matricula = $matricula<br>";
													echo "<form id=\"myFormMobile\" action=\"../teste/$target\" method=\"post\">";
													
													echo "
															<input type=\"hidden\" name=\"cookieName\" value=\"$matricula\">
															<input type=\"hidden\" name=\"cookie\" value=true>
															<input type=\"submit\">
														</form>";
												}
												else
												{
													echo "<h3 class=\"text-center\">Senha Incorreta, tenta de novo</h3>";
													echo "<a href=\"javascript:history.go(-1)\" class=\"button btn-primary btn-lg btn-block\">Voltar</a>";
												}
											}
										}
									}
									
									$ema34 = false;
									if ($secretaria == false)
									{
										$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
										//echo "matricula = $matricula<br>";
										
										if($radio == 1)
										{
											$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
										}
										if($radio == 2)
										{
											$sqlProfessor = "SELECT * FROM alunos WHERE matricula = $matricula";
										}
										
										$queryProfessor = $conexao->query($sqlProfessor);
										$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									
										if(count($rowsProfessor) <= 0)
										{
											echo "<p align=\"center\">Matricula não encontrada<br>";
											echo "
													<div class=\"form-group\">
													  <a align=\"center\" class=\"button2 btn-primary btn-lg\" href=\"javascript: window.history.go(-1)\">Voltar</a>
													</div>
											";
										}
										else if(strcmp($rowsProfessor[0]['senha'],$senha) != 0)
										{
											echo "<p align=\"center\">Senha incorreta<br>";
											echo "
													<div class=\"form-group\">
													  <a align=\"center\" class=\"button2 btn-primary btn-lg\" href=\"javascript: window.history.go(-1)\">Voltar</a>
													</div>
											";
										}								
										else if($rowsProfessor[0]['alter'] == 1)
										{
											
											$email = $rowsProfessor[0]['email'];
											$nome = $rowsProfessor[0]['nome'];

											echo "  
													<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
					
					
														<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
														<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
														<input type=\"hidden\" name=\"email\" value=\"$email\"></input>
														<input type=\"hidden\" name=\"tipo\" value=\"$radio\"></input>
					
														<div class=\"form-group\">
														  <input type=\"password\" name=\"newMat\" class=\"form-control input-lg\" placeholder=\"Nova Senha\" required>
														</div>				
														
														<div class=\"form-group\">
														  <input type=\"password\" name=\"confirmMat\" class=\"form-control input-lg\" placeholder=\"Repita a Senha\" required>
														</div>	
														
														<div class=\"form-group\">
														  <button type=\"submit\" class=\"button2 btn-primary btn-lg \">Enviar</button>
														</div>
												  
													</form>		
												";
										}
										else
										{
											if($_POST['tipo']==1)
											{
												echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
												
												
												echo "
														<form id=\"myFormMobile\" class=\"form col-md-12 center-block\" action='../teste/professor/mainProfessor.php' method=\"post\">
															<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
														</form>		
												
												";
												//header('Location:https://npj.jur.puc-rio.br/areaprofessor/opcoes.php?matricula=$matricula');
											}
											else if($_POST['tipo']==2)
											{
												$monitor = false;
												$sqlMonitor = "SELECT * FROM `monitores` WHERE `monitor` = $matricula";
												$queryMonitor = $conexao->query($sqlMonitor);
												if ($queryMonitor != false)
												{
													$resultMonitor = $queryMonitor->fetchAll( PDO::FETCH_ASSOC );
													if (count($resultMonitor) > 0)
													{
														echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
														echo "
																<form id=\"myFormMobile\" class=\"form col-md-12 center-block\" action='https://npj.jur.puc-rio.br/teste/monitor/mainMonitor.php' method=\"post\">
																	<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
																	<input id=\"id_submit\" type=\"submit\" value=\"Ir\"></input>
																</form>		
														
														";
														$monitor = true;
													}
												}
												//echo "monitor = $monitor<br>";
												if ($monitor === false)
												{
													$sql34 = "SELECT * FROM `alunos` WHERE `matricula` LIKE \"%$matricula%\"";
													$query34 = $conexao->query($sql34);
													if ($query34 != false)
													{
														$result34 = $query34->fetchAll(PDO::FETCH_ASSOC);
														if (count($result34) <= 0)
														{
															
														}
														else if (count($result34) == 1)
														{
															echo "
																<form id=\"myFormMobile\" class=\"form col-md-12 center-block\" action='https://npj.jur.puc-rio.br/teste/aluno/mainAluno.php' method=\"post\">
																	<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
																	<input id=\"id_submit\" type=\"submit\" value=\"Ir\"></input>
																</form>	
															";
														}
														else
														{
															$ema34 = true;
															echo "
																<form id=\"myFormMobile\" class=\"form col-md-12 center-block\" action='https://npj.jur.puc-rio.br/teste/aluno/mainAluno.php' method=\"post\">";
																echo "<h4 class=\"text-center\">Você está matriculado em mais de um EMA, por favor, escolha o EMA que deseja acessar</h4>";
																for ($i=0;$i<count($result34);$i++)
																{
																	$matricula = $result34[$i]['matricula'];
																	$ema = $result34[$i]['disciplina'];
																	echo "
																	<button type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"btn btn-primary btn-block btn-lg\">$ema</button>
																	";
																}
																echo "<input id=\"id_submit\" type=\"hidden\" value=\"Ir\"></input>";
																echo "</form>
															";
														}
													}
												}
												//header("Location:$location");
											}
											
										}
									}
								?>
					</div>
					<div class="modal-footer"></div>
				</div>
			</div>
		</div>
				
		<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<!-- JavaScript jQuery code from Bootply.com editor -->
		<script type='text/javascript'>
			$(document).ready(function() {});	

			window.mobilecheck = function() {
			  var check = false;
			  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
			  return check;
			};

			onload = function()
			{
				if (window.mobilecheck())
				{
					//document.getElementById('id_mensagem').innerHTML = "teste";
					
					<?php 
						if ($secretaria == false)
						{
							if( $radio == 2)
							{
								{
									echo "document.getElementById('id_submit').setAttribute(\"value\",\"../teste/mobile/alunos/main.php\");";	
									echo "document.getElementById('myFormMobile').setAttribute(\"action\",\"../teste/mobile/alunos/main.php\");";	
								}
							}
							else
							{
								echo "document.getElementById('myFormMobile').setAttribute(\"action\",\"../teste/mobile/professores/main.php\");";
							}
						}
						else
						{
							echo "document.getElementById('myFormMobile').setAttribute(\"action\",\"../teste/mobile/secretaria/main.php\");";
						}
					?>
				}
				<?php
					if ($ema34 == false)
						echo "document.getElementById('myFormMobile').submit();";
				?>
			}
		</script>
        
    </body>
</html>