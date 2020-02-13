<?php
	if(!isset($_COOKIE['usuario']))
	{
		echo "<form action=\"//npj.jur.puc-rio.br\" id=\"id_auto\"></form>";
		echo "<script> document.getElementById('id_auto').submit()</script>";
	}
?>
	  
<!DOCTYPE html>
<html lang="en">
    <head>
		<link rel="icon" href="../uploads/defaultAssets/npj.png">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/mainSecretaria.js"></script>
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
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
		  <a href="https://npj.jur.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="177" height="113" src="../../assets/img/NPJ.bmp" class="custom-logo" alt="Núcleo de Prática Jurídica" sizes="(max-width: 177px) 100vw, 177px" align="right">
		  </a>
		  
		  <a href="http://www.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="66" height="113" src="../../assets/img/PUC.png" class="custom-logo" alt="Puntíficia Universidade Catolica - PUC-Rio" sizes="(max-width: 177px) 100vw, 177px" align="left">
		  </a>
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
					case "pendencias":
						echo "Lista de Pendencias";
						break;
					case "deletaaluno":
						echo "Apagar documentos do aluno";
						break;
					case "monitores":
						echo "Relação de Monitores";
						break;
					default:
						echo "Calendário";
						break;
						
				}
		  
		  ?>
		  </h4>
		  
      </div>
		<div class="modal-body" id="id_print">
			<form class="form col-md-12 center-block" id="id_Form" method="post" action="mainSecretaria.php" enctype="multipart/form-data">
			<div class="left-side" id="id_leftDiv">
					<?php
					
						
						include('../../newconexao.php');
					
						$i = 0;
						
						$styleOff = "background-color: #A4DDFF;";
						$styleOn = "box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19); ";
						$styleRedirect = "background-color: #80DD80;";
						
						$sqlAtividade = "SELECT * FROM atividades WHERE `pendente` = 2";
						$queryAtividade = $conexao->query($sqlAtividade);
						$exclamacao = "";
						
						$stylePendenciaOn = $styleOn;
						$stylePendenciaOff = $styleOff;
						
						if($queryAtividade != false)
						{
							$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
							if (count($resultAtividade) > 0)
							{
								$stylePendenciaOn = $styleOn."background-color: #FFA4A4;";
								$stylePendenciaOff = "background-color: #FFA4A4;";
								$exclamacao = "&#9888;";
								
							}
						}
						
						if(!isset($_POST['mode']))
							$mode = "calendario";
						else
							$mode = $_POST['mode'];
						
						echo "mode = $mode<br>";
						
						if ($mode != "calendario")
							echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOff\" formnovalidate>Calendário</button>	";
						else
							echo "<button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$styleOn\" formnovalidate>Calendário</button>";
						
						echo "<br>";
						
						if ($mode != "pendencias")
							echo "<button type=\"submit\" value=\"pendencias\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$stylePendenciaOff\" formnovalidate>$exclamacao Pendências $exclamacao</button>	";
						else
							echo "<button type=\"submit\" value=\"pendencias\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"$stylePendenciaOn\" formnovalidate>$exclamacao Pendências $exclamacao</button>";
						
						echo "<br>";
						
						echo "<button type=\"submit\" value=\"email\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\""; 
						if ($mode=="email")
							echo "$styleOn";
						else
							echo "$styleOff";
						echo "\">Email</button><br><br>
					
						<input type=\"text\"  id=\"id_assistido\" name=\"nomeAssistido\" class=\"form-control input-lg\" placeholder=\"Jose Maria Marin\"> <br>
						<button type=\"submit\" id=\"id_ButtonCPF\" value=\"procuraassistido\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "procuraassistido")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Procurar Assistido</button><br>";
						
						//---------------------------------------------------------------------------------------------------------------------------------------------------//
						echo "<button id=\"id_accordionCoordenacao\" class=\"accordion\" onclick=\"return false\">Coordenacao</button>";
						echo "<div class=\"panel\">";
						
						echo "<button type=\"submit\" value=\"redirectNPJpauta\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "pauta")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Pauta</button>";
						
						echo "<button type=\"submit\" value=\"novoSemestre\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "novoSemestre")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Novo Semestre</button>";
						
						echo "<button type=\"submit\" value=\"deletaaluno\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "deletaaluno")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Deleta Arquivos Aluno</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJsimulado\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "inscritosProfessor")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Simulado</button>";
							
						echo "<button type=\"submit\" value=\"redirectNPJplantao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="plantao")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Plantao</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJavaliacao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="avaliacao")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Avaliacao</button>";
						
						
						echo "<button type=\"submit\" value=\"redirectNPJquadro\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="quadro")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Quadro de Chaves</button>";
						
						echo "<button type=\"submit\" value=\"relatorio\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "relatorip")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Relatorio</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJafericao\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="afericao")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Afericao</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJclientes\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="clientes")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Clientes</button>";
						
						
						echo "</div>";
						
						//---------------------------------------------------------------------------------------------------------------------------------------------------//
						
						echo "<button id=\"id_accordionAssistidos\" class=\"accordion\" onclick=\"return false\">Secretaria</button>";
						echo "<div class=\"panel\">";
						
						echo "<button type=\"submit\" value=\"redirectNPJdownloads\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="downloads")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Downloads</button>";
						
						
						echo "<button type=\"submit\" value=\"redirectNPJnepple\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="nepple")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Sistema Nepple</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJvisita\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="visita")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Visita</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJestagio\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="estagio")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Estagio</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJmonitoria\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="monitoria")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Monitoria</button>";
						
						echo "<button type=\"submit\" value=\"redirectNPJacessorestrito\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "sistemaNPJ" && $_POST['show']=="acessorestrito")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Acesso Restrito</button>";
						
						echo "<button type=\"submit\" value=\"monitores\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" formnovalidate style=\"";
						if ($mode == "monitores")
						{ 
							echo "$styleOn";
						}
						else 
						{
							echo "$styleOff";
						} 
						echo "\">Monitores</button>";
						
						echo "</div>";
					?>
					
					</div>
					<div class="right-side" id="id_rightDiv">
							<?php			
							
							
								if(!isset($_POST['mode']))
									$mode = "calendario";
								else
									$mode = $_POST['mode'];
								
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
								
								if (strstr($mode,"redirectNPJ") != false)
								{
									$opcao = substr ($mode,strlen("redirectNPJ"));
									echo "<input type=\"hidden\" value=\"$opcao\" name=\"show\">";
									echo "
										<input type=\"hidden\" value=\"sistemaNPJ\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"embed") != false)
								{
									$show = substr ($mode,strlen("embed-"),(strpos($mode,"!")-strpos($mode,"-")-1));
									$option = substr($mode,strpos($mode,"!")+1);
									echo "<input type=\"hidden\" value=\"$show\" name=\"show\">";
									echo "<input type=\"hidden\" value=\"$option\" name=\"option\">";
									echo "
										<input type=\"hidden\" value=\"displayEmb\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"pesquisa") != false)
								{
									$bairro = substr ($mode,strlen("pesquisa"));
									echo "<input type=\"hidden\" value=\"$bairro\" name=\"bairro\">";
									echo "
										<input type=\"hidden\" value=\"relatoriobairro\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"comunidade") != false)
								{
									$bairro = substr ($mode,strlen("comunidade"));
									echo "<input type=\"hidden\" value=\"$bairro\" name=\"comunidade\">";
									echo "
										<input type=\"hidden\" value=\"relatoriocomunidad\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								if (strstr($mode,"relatorioprofessor") != false)
								{
									$professor = substr ($mode,strlen("relatorioprofessor"));
									$searchInicio = $_POST['searchInicio'];
									$searchFim = $_POST['searchFim'];
									echo "<input type=\"hidden\" name=\"searchInicio\" value=\"$searchInicio\">";
									echo "<input type=\"hidden\" name=\"searchFim\" value=\"$searchFim\">";
			
	
									
									echo "<input type=\"hidden\" value=\"$professor\" name=\"professor\">";
									echo "
										<input type=\"hidden\" value=\"relatProfessor\" name=\"mode\">
										<script type=\"text/javascript\">
											document.getElementById('id_Form').submit();
										</script>
									";
									
									$mode = "aluno";
								}
								
								include("../utils/embedder.php");
								switch ($mode)
								{
									case "displayEmb":
										include('modes/mode_embedded.php');
										break;
									case "inscritosProfessor":
										embedSite("npj.jur.puc-rio.br/simulado/secretaria/inscritos-professor.php");
										break;
									case "Lucas":
										embedSite("npj.jur.puc-rio.br/simulado/secretaria/");
										break;
									case "sistemaNPJ":
										include("modes/mode_sistema.php");
										break;
									case "email":
										include("modes/mode_email.php");
										break;
									case "confirmacaosimulado":
										include("modes/mode_confirmacaosimulado.php");
										break;
									case "inscricaosimulado":
										include("modes/mode_inscricaosimulado.php");
										break;
									case "procuraassistido":
										include("modes/mode_procurarassistido.php");
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
									case "listaratividadesaluno":
										include("modes/mode_listaratividadesaluno.php");
										break;
									break;
									case "listaralunosplantao":
										include("modes/mode_listaralunosplantao.php");
										break;
									break;
									case "listardocumentos":
										include("modes/mode_listardocumentos.php");
										break;
									break;
									case "verrelatorioplantao":
										include("modes/mode_verrelatorioplantao.php");
										break;
									break;
									case "listarassistidos":
										include("modes/mode_listarassistidos.php");
										break;
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
									case "listavisitasparaalunos":
										include("modes/mode_listavisitasparaalunos.php");
										break;
									case "relatorio":
										include("modes/mode_relatorio.php");
										break;
									case "relatoriobairro":
										include("modes/mode_relatoriobairro.php");
										break;
									case "relatoriocomunidad":
										include("modes/mode_relatoriocomunidade.php");
										break;
									case "pendencias":
										include("modes/mode_pendencias.php");
										break;
									case "relatProfessor":
										include("modes/mode_relatorioprofessor.php");
										break;
									case "deletaaluno":
										include("modes/mode_deletaaluno.php");
										break;
									case "novoSemestre":
										include("modes/mode_novosemestre.php");
										break;
									case "monitores":
										include("modes/mode_monitores.php");
										break;
									default:
										include("modes/mode_calendario.php");
										break;
										
								}
							
							?>
					</div>
					
					<script>
							document.getElementById("id_rightDiv").style.height = (screen.height-screen.height*0.34)+"px";
							document.getElementById("id_leftDiv").style.height = (screen.height-screen.height*0.34)+"px";
							
							onload = function () 
							{
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
	  
  </div>
  </div>
</div>
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
			
        });
		
		function confirmAction()
		{ 
			
			var valor = "Tem certeza que deseja excluir o cliente <?php echo $nome ?>?";
			
			//return false;
			return !confirm(valor);
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