<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html { 
  background: url(../../assets/img/pilotis.jpg) no-repeat center center fixed; 
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
          <h5 class="text-center">Atualização das Informações da Aluna</h5>
      </div>
	 <?php
			include('../../newconexao.php');
			
			$entrada = $_POST['query'];
			$matricula = null;
			$nome = null;
			
			if (floatval($entrada)>0)
			{
				$matricula = $entrada;
			}
			else
			{
				$nome = $entrada;
			}
			
			if($matricula != null)
			{
				$sqlAluno = "SELECT * from alunos where matricula = $matricula";
			}
			if($nome != null)
			{
				$sqlAluno = "SELECT * FROM  `alunos` WHERE  `nome` LIKE  \"%$nome%\"";	
			}
			
			$queryAluno = $conexao->query($sqlAluno);
			$rowsAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
			
			if(count($rowsAluno)<0)
			{
				echo "Deu Ruim";
			}
			else
			{
				if (count($rowsAluno) == 1)
				{
					$matricula = $rowsAluno[0]['matricula'];
					echo "	<form action=\"analise.php\" id=\"myForm\" class=\"form col-md-12 center-block\" method=\"post\">
								<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
								<br>
							</form>
							<script type=\"text/javascript\">
								document.getElementById('myForm').submit();
							</script>
							";
				}
				else
				{			
					for($i=0;$i<count($rowsAluno);$i++)
					{
						$nome = $rowsAluno[$i]['nome'];
						$matricula = $rowsAluno[$i]['matricula'];
						
						echo "	<form class=\"form col-md-12 center-block\" method=\"post\">
									<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
									<input type=\"submit\" formaction=\"analise.php\" value=\"$nome\" class=\"btn btn-primary btn-lg btn-block\">
									<br>
								</form>";
						
					}
				}
			}
	  ?>
	  
	  <div>
		<form action="cadastrarnovoaluno.php" method="post">
			<input type="submit" value="Cadastrar Novo Aluno" class="btn btn-primary btn-lg btn-block">
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
        
        </script>
        
    </body>
</html>