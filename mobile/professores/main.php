<?php
		include ('../../utils/professores.php');
		if (empty($_POST['matricula']))
		{
			echo "<form id=\"id_auto\" action=\"../../../acessorestrito/\"></form>";
			echo "<script> document.getElementById('id_auto').submit()</script>";
		}
		else
			$matricula = $_POST['matricula'];
		$nomeProfessor = PROFESSORES_GETNAME($matricula);
		$primeiroNome = substr($nomeProfessor,0,strpos($nomeProfessor," "));
		$pieces = explode(' ', $nomeProfessor);
		$ultimoNome = array_pop($pieces);
		
		$displayName = $primeiroNome." ".$ultimoNome;
		
?>
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
	.accept
	{
		background-color: #30EA70	;
		border: none;
		color: white;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 12px;
		width: 69%;
		font-weight: bold;
	}
			
	.accept:hover 
	{
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
	}
			
	.reject 
	{
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
	
	.reject:hover 
	{
		box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
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
				echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
		?>
		<?php
		
		echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<table class=\"table table-bordered\">
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"pendencias\" class=\"w3-bar-item w3-button\"><strong>PENDÊNCIAS</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"calendario\" class=\"w3-bar-item w3-button\"><strong>CALENDÁRIO</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"pauta\" class=\"w3-bar-item w3-button\"><strong>PAUTA</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\"><button type=\"submit\" name=\"mode\" value=\"pesquisarCliente\" class=\"w3-bar-item w3-button\"><strong>PESQUISAR CLIENTE</strong></button></td>
						</tr>
						<tr>
							<td align=\"center\" style=\"background-color: #ff6666\"><a href=\"../../acessorestrito/index.php\" class=\"w3-bar-item w3-button\"><strong>SAIR</strong></a></td>
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

<footer class="w3-container w3-theme">
  <h3 class="text-center"><?php echo "$displayName"; ?></h3>
</footer>

<body>
	<div class="modal-content" id="id_content">
		<?php			
		
			if (empty($_POST['mode']))
				$mode = "pendencias";
			else
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
			
			if (strstr($mode,"infoAluno_") != false)
			{
				echo "<form id=\"id_Form\" action=\"main.php\" method=\"post\">";
				$matriculaAluno = substr ($mode,strlen("infoAluno_"));
				echo "<input type=\"hidden\" value=\"$matriculaAluno\" name=\"matriculaAluno\">";
				echo "
					<input type=\"hidden\" value=\"dadosAluno\" name=\"mode\">
					<input type=\"hidden\" value=\"$matricula\" name=\"matricula\">
					</form>
					<script type=\"text/javascript\">
						document.getElementById('id_Form').submit();
					</script>
				";
				
				$mode = "aluno";
			}
			
			switch($mode)
			{
				case "calendario":
					include ("modes/calendario.php");
					break;
				case "pauta":
					include ("modes/pauta.php");
					break;
				case "pendencias":
					include ("modes/pendencias.php");
					break;
				case "informacao":
					include ("modes/cliente.php");
					break;
				case "dadosAluno":
					include ("modes/aluno.php");
					break;
				case "pesquisarCliente":
					include ("modes/pesquisa.php");
					break;
				case "resultPesquisa":
					include ("modes/resultPesquisa.php");
					break;
				default:
					include ("modes/pendencias.php");
					break;
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