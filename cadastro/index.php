		<?php
		include ('header.php');
	?>
    
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

			<form class="form col-md-12 center-block" id="id_Form" method="post" action="procurar.php">
				<input type="text"  id="id_CPF" name="cpf" class="form-control input-lg" placeholder="123.123.123-40"> <br>
				
				<input type="submit" id="id_Button" value="Pesquisar Assistido" class="btn btn-primary btn-lg btn-block">
				<a href="verlista.php" class="btn btn-primary btn-lg btn-block">Ver Lista de Espera</a>
				<a href="javascript:history.go(-1)" class="btn btn-primary btn-lg btn-block">Voltar</a>
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