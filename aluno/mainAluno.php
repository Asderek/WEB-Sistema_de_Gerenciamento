<!DOCTYPE html>
<html lang="en">
    <head>
		<link rel="icon" href="../uploads/defaultAssets/npj.png">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/mainAluno.js"></script>
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
			
			.right-side
			{
				float:								right;
				position:                        	relative;
				width:                             	75%;
				top:                                50%;
				overflow:							auto;
				height:								550px;
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
			
			.staticInvisibox 
			{
			  border: none;
			  background: transparent;
			  border-bottom: 1px solid #fff;
			  outline: none;
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
			
			.commentary-display
			{
				display: block; 
				position: absolute; 
				width: 100%; 
				z-index: 1; 
				background-color: #FFFFDDF0; 
				border:1px solid black; 
				opacity:0;
				animation: pulse 0.5s;
			}
			
			.commentary-hidden
			{
				display: block; 
				position: absolute; 
				width: 100%; 
				z-index: 1; 
				background-color: #FFFFDDF0; 
				border:1px solid black; 
				opacity:0;
			}
			
			.commentary-show
			{
				display: block; 
				position: absolute; 
				width: 100%; 
				z-index: 1; 
				background-color: #FFFFDDF0; 
				border:1px solid black; 
				opacity:1;
			}
			
			@keyframes pulse {
			10% {
				opacity: 0.1;
			}

			20% {
				opacity: 0.2;
			}

			30% {
				opacity: 0.3;
			}
			
			40% {
				opacity: 0.4;
			}

			50% {
				opacity: 0.5;
			}

			60% {
				opacity: 0.5;
			}
			
			70% {
				opacity: 0.7;
			}

			80% {
				opacity: 0.8;
			}

			90% {
				opacity: 0.9;
			}
			
			100% {
				opacity: 1;
			}
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
		  <form action="mainAluno.php" method="post">
			<?php
				$matricula = $_POST['matricula'];
				echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			?>
			<?php
				if ($matricula == 111111)
				{
					$width = 270 * 0.5;
					$height = 222 * 0.5;
					
					echo "<div style=\"position: static\"><h1 class=\"text-center\"><img width=\"$width\" height=\"$height\" src=\"../uploads/defaultAssets/nexus3.png\" class=\"custom-logo\" alt=\"Puntíficia Universidade Catolica - PUC-Rio\"></h1>";
					$width = 222 * 0.5;
					$height = 270 * 0.5;
					
					//echo "<h1 class=\"text-center\"><img width=\"$width\" height=\"$height\" src=\"../uploads/defaultAssets/nexus2.png\" class=\"custom-logo\" alt=\"Puntíficia Universidade Catolica - PUC-Rio\" style=\"margin-left:300px\"></h1></div>";
				}
				else
					echo "<h1 class=\"text-center\">Núcleo de Prática Jurídica</h1><br>";
				?>
          <h4 class="text-center">
			<?php
				$mode = $_POST['mode'];
				//echo "mode = $mode<br>";
				switch ($mode)
				{
					case "calendario":
						echo "Calendário";
						break;
					case "downloads":
						echo "Arquivos importantes";
						break;
					case "inscricaosimulado":
						echo "Inscrição para o simulado da OAB";
						break;
					case "monitoria":
						echo "Professores com processo de seleção aberto";
						break;
					case "listavisitas":
						echo "Lista de Eventos com vagas disponíveis";
						break;
					case "listarassistidos":
						echo "Lista de Assistidos";
						break;
					case "verassistencia":
						echo "Informações do Caso do Assistido";
						break;
					case "mostraassistido":
						echo "Ficha do Assistido";
						break;
					case "procuraassistido":
						echo "Resultado da Pesquisa";
						break;
					case "listaatividades":
						echo "Atividades";
						break;
					case "informacao":
						echo "Informações Pessoais";
						break;
					case "relatorioatividades":
						echo "Relatorio de Todas as Atividades EMA";
						break;
					default:
						echo "texto default";
				}
			?>
		  </h4>
		  
		  <a href="https://npj.jur.puc-rio.br" class="btn btn-primary" style="background-color: #F66; color:black;">Sair</a>
			<button type="submit" value="contato" name="mode" class="btn btn-primary" style="background-color: #2D2; color:black; float: right;" formnovalidate>Contato</button>
		  </form>
      </div>
		<div class="modal-body">
			
				<div class="left-side" id="id_leftDiv">
					<form class="form col-md-12 center-block" id="id_Form" method="post" action="mainAluno.php" enctype="multipart/form-data">
					<?php
						include('newconexao.php');
					
						$matricula = $_POST['matricula'];
						echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
						
						if(!isset($_POST['mode']))
						{
							$mode = "calendario";
						}
						else
							$mode = $_POST['mode'];
						
						$styleOff = "background-color: #A4DDFF;";
						$styleOn = "box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19); ";
						
					
					?>
					
					
					<br>
					<?php
						if ($mode != "calendario")
						{
							echo '<button type="submit" id="id_calendario" value="calendario" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOff.'" formnovalidate>Calendário</button>	';
						}
						else
						{
							echo '<button type="submit" id="id_calendario" value="calendario" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOn.'" formnovalidate>Calendário</button>	';
						}
					?>
					<br>
					<?php
						if ($mode != "informacao")
						{
							echo '<button type="submit" id="id_informacao" value="informacao" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOff.'" formnovalidate>Informação</button>	';
						}
						else
						{
							echo '<button type="submit" id="id_informacao" value="informacao" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOn.'" formnovalidate>Informação</button>	';
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
						if (true)
						{
							if ($mode != "relatorioatividades")
								echo '<button type="submit" value="relatorioatividades" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOff.'" formnovalidate>Relatorio de Atividades</button>';
							else
							{
								echo '<button type="submit" value="relatorioatividades" name="mode" class="btn btn-primary btn-lg btn-block" style="'.$styleOn.'" formnovalidate>Relatorio de Atividades</button>';
							}
						}
					?>
					<br>
					<button type="submit" value="downloads" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "downloads")? print $styleOff:print $styleOn ?>" formnovalidate>Downloads</button>
					
					<br>
					<button id="id_accordionAssistidos" class="accordion" onclick="return false">Pesquisar</button>
					<div class="panel">
						<input type="text" id="id_assistido" name="assistido" class="form-control input-lg" placeholder="Martinho José Ferreira"></input><br>
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
					
					
					<button class="accordion" id="id_accordionAtividades" onclick="return false">Atividades Academicas</button>
					<div class="panel">
						<button type="submit" value="listavisitas" name="mode" class="btn btn-primary btn-lg btn-block" style="<?php ($mode != "listavisitas")? print $styleOff:print $styleOn ?>" formnovalidate>Eventos</button>
						<br>
						
						<?php
							include('../../newconexao.php');
							$sqlProfessoresMonitoria = "SELECT * FROM `professoresmonitoria` WHERE `status` = 1";
							$queryProfessoresMonitoria = $conexao->query($sqlProfessoresMonitoria);
							if ($queryProfessoresMonitoria != false)
							{
								$resultMonitoria = $queryProfessoresMonitoria->fetchAll(PDO::FETCH_ASSOC);
								if (count($resultMonitoria) > 0)
								{
									echo "<button type=\"submit\" formnovalidate name=\"mode\" value=\"monitoria\" class=\"btn btn-primary btn-lg btn-block\" style=\"";
									if (strstr($mode,"monitoria") == false)
										echo "$styleOff";
									else
										echo "$styleOn";
									echo "\">Monitoria</button>";
									echo "<br>";
								}								
							}
						?>
						<?php
							include('../../newconexao.php');
					
							$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"inscricaoPlantoes(Alunos)\" LIMIT 0 , 30";
							$query = $conexao->query($sql);
							$result = $query->fetchAll( PDO::FETCH_ASSOC );
							$status = $result[0]['status'];
							
							if($status==1)
							{								
								echo "<button formnovalidate type=\"submit\" name=\"mode\" value=\"listaplantao\" class=\"btn btn-primary btn-lg btn-block\" style=\"";
								if (strpos($mode,"plantao") == false)
									echo "$styleOff";
								else
									echo "$styleOn";
								echo "\">Cadastro em Plantão</button>";
								echo "<br>";
							}
							$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"simulado\" LIMIT 0 , 30";
							$query = $conexao->query($sql);
							$result = $query->fetchAll( PDO::FETCH_ASSOC );
							$status = $result[0]['status'];
							
							if($status==1)
							{
								echo "<button type=\"submit\" formnovalidate name=\"mode\" value=\"inscricaosimulado\" class=\"btn btn-primary btn-lg btn-block\" style=\"";
								if (strpos($mode,"simulado") == false)
									echo "$styleOff";
								else
									echo "$styleOn";
								echo "\">Simulado</button>";
							}
						?>
					</div>
						
						<?php
							include('../../newconexao.php');
					
							$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"avaliacao\" LIMIT 0 , 30";
							$query = $conexao->query($sql);
							$result = $query->fetchAll( PDO::FETCH_ASSOC );
							$status = $result[0]['status'];
							
							if($status==1)
							{
								echo "<button type=\"submit\" formnovalidate value=\"avaliacao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\""; 
								if ($mode == "avaliacao")
									echo $styleOn;
								else
									echo $styleOff;
								echo "\">Avaliacao EMA</button><br>	";
							}
						?>						
					
					<!--
					<button class="accordion">Section 3</button>
					<div class="panel">
					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>-->
				</div>
				<div class="right-side" id="id_rightDiv">
					<?php
						include("checkString.php");
						
						CS_CheckString($mode,"vercaso", "verassistencia");
						CS_CheckString($mode,"verassistido", "mostraassistido");
						CS_CheckString($mode,"vervisita", "mostravisita");
						
						if (strlen($matricula) < 7)
							echo "mode = $mode<br>";
						
						switch ($mode)
						{
							case "confirmamonitoria":
								include("modes/mode_confirmamonitoria.php");
								break;
							case "confirmacaosimulado":
								include("modes/mode_confirmacaosimulado.php");
								break;
							case "inscricaosimulado":
								include("modes/mode_inscricaosimulado.php");
								break;
							case "informacao":
								include ("modes/mode_informacao.php");
								break;
							case "cadastraratividade":
								include("modes/mode_cadastraratividade.php");
								break;
							case "listaatividades":
								include("modes/mode_listaatividades.php");
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
							case "listarassistidos":
								include("modes/mode_listarassistidos.php");
								break;
							case "procuraassistido":
								include("modes/mode_procuraassistido.php");
								break;
							case "contato":
								include("modes/mode_contato.php");
								break;
							case "mostravisita":
								include("modes/mode_mostravisita.php");
								break;
							case "relatorioatividades":
								include("modes/mode_relatorioatividades.php");
								break;
							default:
								include("modes/mode_calendario.php");
								break;
								
						}
					?>
				</div>
			</form>
					<script>
						document.getElementById("id_rightDiv").style.height = (screen.height-screen.height*0.34)+"px";
						document.getElementById("id_leftDiv").style.height = (screen.height-screen.height*0.34)+"px";
						
						onload = function()
{
						//width = 1500;
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
						
						console.log("tchau");
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
						  acc[i].addEventListener("click", function() {
							this.classList.toggle("active");
							var panel = this.nextElementSibling;
							if (panel.style.maxHeight){
							  panel.style.maxHeight = null;
							} else {
							  panel.style.maxHeight = panel.scrollHeight + "px";
							} 
						  });
						}
						
						var mode = "<?php echo $mode; ?>";
												
						if (mode == "listamonitoria" || mode == "listaralunosplantao" || mode == "listavisitas" || mode == "escolherplantao" || mode == "mostravisita")
						{
							document.getElementById("id_accordionAtividades").click();
						}
						
						if (mode == "consultaassistido" || mode == "listarassistidos" || mode == "procuraassistido")
						{
							document.getElementById("id_accordionAssistidos").click();
						}
						
					}
						
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
								console.log("date = " + date);
								date = ano + '-' + mes + '-' + dia;
								console.log("date = " + date);
							}
							
							var today = new Date();
							var atvDate = new Date(date);
							atvDate.setDate(atvDate.getDate()+1);
							allowed = true;
							
							
							
							document.getElementById('id_Enviar').setAttribute("style","visibility: visible;");
							document.getElementById('id_aviso').setAttribute("style","visibility: hidden; float: left; vertical-allign: middle;");
							
							if(atvDate.getYear() < today.getYear())
								allowed = false;
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
							}
							
						}
						
						function checaEstagio()
						{
							var tipoAtividade = document.getElementById('id_TipoAtividade').value;
							
							if (tipoAtividade == "estagio")
								alert("1a fase - Aprovação da Documentação pela Secretaria\n2a Fase - Atribuição de Horas pelo Professor da Disciplina");
							
							document.getElementById('id_uploadFile').setAttribute("accept",".pdf");
							
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
			
			
				
		</div>
	  
      <div class="modal-footer"></div>
  </div>
  </div>
</div>
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        
        </script>
        
    </body>
</html>