<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
<link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">
<style type="text/css">
	html 
	{ 
		background: url(../../../assets/img/pilotis.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	
	.accordion {
		background-color: #009688; <!-- Cor do lado de fora do accordion -->
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
		background-color: #009688;<!-- Cor do accordion quando eu hovero -->
	} 

	.panel {
		padding: 0 18px;
		background-color:	#FF0000 <!-- Cor da parte de dentro do accordion -->;
		max-height: 0;
		overflow: hidden;
		transition: max-height 0.2s ease-out;
	}
	
</style>
<body style="max-width:600px">

<nav class="w3-sidebar w3-bar-block w3-card" id="mySidebar">
	<div class="w3-container w3-theme-d2">
	  <span onclick="closeSidebar()" class="w3-button w3-display-topright w3-large">X</span>
	  <br>
	</div>
	<form action="main.php" method="post">
		<?php
		
		echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<table class=\"table table-bordered\">
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"inscritossimulado\" class=\"w3-bar-item w3-button\"><strong>LISTA DE INSCRITOS SIMULADO</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"switchboard\" class=\"w3-bar-item w3-button\"><strong>QUADRO DE CHAVES</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"calendario\" class=\"w3-bar-item w3-button\"><strong>CALENDARIO</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"pesquisarCliente\" class=\"w3-bar-item w3-button\"><strong>PESQUISAR CLIENTE</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"pesquisarAluno\" class=\"w3-bar-item w3-button\"><strong>PESQUISAR ALUNO</strong></button></td>
						</tr>
					</table>
				  </div>
				</div>  
			</hr>
			";
		
		?>
		
		
		
	</form>
</nav>

<header class="w3-bar w3-card" style="background-color:#FFFFFF">
  <button class="w3-bar-item w3-button w3-xxxlarge w3-hover-theme" onclick="openSidebar()">&#9776;</button>
  <div style="margin-right: 50%; height:100%; width: 100%"  ><img src="NPJ.bmp" alt="avatar" width="30%" style="float:right;"></div>
  <!--<h1 class="w3-bar-item"></h1>-->
  
</header>

<body>
	<div class="modal-content" id="id_content">
		<?php			
			$mode = $_POST['mode'];
			
			if (strstr($mode,"cliente") != false)
			{
				echo "<form id=\"id_Form\" action=\"main.php\" method=\"post\">";
				$index = substr ($mode,strlen("cliente"));
				echo "<input type=\"hidden\" value=\"$index\" name=\"indice\">";
				echo "
					<input type=\"hidden\" value=\"informacao\" name=\"mode\">
					<input type=\"hidden\" value=\"$matricula\" name=\"matricula\">
					</form>
					<script type=\"text/javascript\">
						document.getElementById('id_Form').submit();
					</script>
				";
				
				$mode = "aluno";
			}
			if (strstr($mode,"redirectAluno") != false)
			{
				echo "<form id=\"id_Form\" action=\"main.php\" method=\"post\">";
				$matricula = substr ($mode,strlen("redirectAluno"));
				echo "
					<input type=\"hidden\" value=\"dadosEstudante\" name=\"mode\">
					<input type=\"hidden\" value=\"$matricula\" name=\"matriculaAluno\">
					</form>
					<script type=\"text/javascript\">
						document.getElementById('id_Form').submit();
					</script>
				";
				
				$mode = "aluno";
			}
			
			switch ($mode)
			{
				case "inscritossimulado":
					include("modes/listaalunossimulado.php");
					break;
				case "switchboard":
					include("modes/switchboard.php");
					break;
				case "informacao":
					include ("modes/cliente.php");
					break;
				case "pesquisarCliente":
					include ("modes/pesquisa.php");
					break;
				case "pesquisarAluno":
					include ("modes/pesquisaAluno.php");
					break;
				case "resultPesquisa":
					include ("modes/resultPesquisa.php");
					break;
				case "resultAluno":
					include ("modes/resultAluno.php");
					break;
				case "dadosEstudante":
					include ("modes/dadosAluno.php");
					break;
				default:
					include("modes/calendario.php");
			}
			
		?>
	</div>
</body>

<script>
	closeSidebar();
	function openSidebar() {
		document.getElementById("mySidebar").style.display = "block";
	}
	function closeSidebar() {
		document.getElementById("mySidebar").style.display = "none";
	}
	onload = function()
	{
		{
			width = screen.width	;
			height = screen.height;
			
			divStyle = document.getElementById('id_content').style;
			divStyle.marginTop = "0px";
			divStyle.position = "relative";
			divStyle.overflow = "auto";
			divStyle.left = "50%";	
			divStyle.width = width+"px";
			divStyle.height = height+"px";
			divStyle.marginLeft = -width/2+"px";
			
		}
		
		{
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) 
			{
			  acc[i].addEventListener("click", toggle);
			}
		}
	}

	function toggle() {
		console.log("togleei");

		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
		  panel.style.maxHeight = null;
		} else {
		  panel.style.maxHeight = panel.scrollHeight + "px";
		} 
	}


</script>

</body>