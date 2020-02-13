<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/index.js"></script>
		
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html { 
  background: url(assets/img/bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
            .modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
          <h5 class="text-center">Consulta de Informações da Aluna</h5>
      </div>
		<div class="modal-body">

<?php
	include('../../newconexao.php');
	include('../../injection.php');
	
	$CPF = $_POST['cpf'];
	
	if(injection($CPF))
	{
		echo "My code is Sanitized";
		return;
	}
	
	$re = "/\d+/";
	if (preg_match($re,$CPF) == 1)
	{
		
		if ((strpos($CPF,"-") != false) && (strpos($CPF,".") != false))
		{
			$SQLSearch = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
			$querySearch = $conexao->query($SQLSearch);
			$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
			$rowsSearch = count($resultSearch);
			
			if ($rowsSearch <= 0)
			{
				echo "
						<form id=\"myForm\" class=\"form col-md-12 center-block\" action='cadastrarnovocliente.php' method=\"post\">
							<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
						</form>		
						<script type=\"text/javascript\">
							document.getElementById('myForm').submit();
						</script>
				";
				
			}
			else
			{
				$nome = $resultSearch[0]['nome'];
				$rg = $resultSearch[0]['rg'];
				$tel1 = $resultSearch[0]['tel1'];
				$tel2 = $resultSearch[0]['tel2'];
				$cel = $resultSearch[0]['cel'];
				$dob = $resultSearch[0]['dob'];
				$bairro = $resultSearch[0]['bairro'];
				$email = $resultSearch[0]['email'];
				$comunidade = $resultSearch[0]['comunidade'];
				$etnia = $resultSearch[0]['etnia'];
				
				
				echo "
								<form id=\"myForm\" class=\"form col-md-12 center-block\" action='consulta.php' method=\"post\">
									<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
									<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
									<input type=\"hidden\" name=\"rg\" value=\"$rg\"></input>
									<input type=\"hidden\" name=\"tel1\" value=\"$tel1\"></input>
									<input type=\"hidden\" name=\"tel2\" value=\"$tel2\"></input>
									<input type=\"hidden\" name=\"cel\" value=\"$cel\"></input>
									<input type=\"hidden\" name=\"dob\" value=\"$dob\"></input>
									<input type=\"hidden\" name=\"bairro\" value=\"$bairro\"></input>
									<input type=\"hidden\" name=\"email\" value=\"$email\"></input>
									<input type=\"hidden\" name=\"comunidade\" value=\"$comunidade\"></input>
									<input type=\"hidden\" name=\"etnia\" value=\"$etnia\"></input>
								</form>		
								<script type=\"text/javascript\">
									document.getElementById('myForm').submit();
								</script>
						";
			}
		}
		else
		{
			echo " 	<h3 align=\"center\">Digite o CPF na forma aaa.bbb.ccc-dd</h3>
					<form class=\"form col-md-12 center-block\" id=\"id_Forma\" method=\"post\" action=\"procurar.php\">
						<input type=\"text\"  id=\"id_CPF\" name=\"cpf\" class=\"form-control input-lg\" placeholder=\"123.123.123-40\"> <br>
						<input type=\"submit\" id=\"id_Button\" value=\"Pesquisar Assistido\" class=\"btn btn-primary btn-lg btn-block\">
						<a href=\"verlista.php\" class=\"btn btn-primary btn-lg btn-block\">Ver Lista De Atendidos</a>
						<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
					</form>
			
			";
		}
	}
	else
	{
		$SQLSearch = "SELECT * FROM `assistidos` WHERE `nome` LIKE \"%$CPF%\" ORDER BY `nome` ASC";
		$querySearch = $conexao->query($SQLSearch);
		$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
		$rowsSearch = count($resultSearch);
		
		if ($rowsSearch <= 0)
		{
			echo "<h1 align=\"center\">Não foi encontrado nenhum assistido com esse nome</h1>";
		}
		else
		{
			echo "
				<form id=\"myForm\" class=\"form col-md-12 center-block\" action='procurar.php' method=\"post\">
			";
			for($i=0;$i<$rowsSearch;$i++)
			{
				$CPF = $resultSearch[$i]['cpf'];
				$nome = $resultSearch[$i]['nome'];
				
				echo "
								<button type=\"submit\" name=\"cpf\" value=\"$CPF\">$nome</button><br>
						";
			}
			echo "</form>";
		}
	}
	
	
?></div>
	  
	  
		
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
        
        </script>
        
    </body>
</html>