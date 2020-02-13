<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/index.js"></script>
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
          <h5 class="text-center">Consulta de Informações da Aluna</h5>
      </div>
		<div class="modal-body">
			
		
				<?php
					if (isset($_POST['matricula']))
						$matricula = $_POST['matricula'];
					else
						$matricula = 18856;
					
					
					if (isset($_POST['error']))
					{
						$error = $_POST['error'];
						switch($error)
						{
							case "matInvalida":
								echo "<h3 class=\"text-center\"> Matricula não reconhecida pelo sistema</h3><br>";
								break;
						}
					}
					
					echo "
					<form id=\"myForm\" class=\"form col-md-12 center-block\" action='debug_login.php' method=\"post\">
							<input type=\"text\" name=\"matricula\" value=\"$matricula\"></input>
							<input type=\"submit\">
						</form>		";
				
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
        
        $(document).ready(function() {
        
            
        
        });
        
        </script>
        
    </body>
</html>