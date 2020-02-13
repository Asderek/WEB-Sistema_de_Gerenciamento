<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="veratendimento.js"></script>
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
			
			.rightSide-Top
			{
				position:                        	relative;
				height:								50%;
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
				width:                             	65%;
				overflow:							auto;
			}
			
			.assistido-left
			{
				float:								left;
				position:                        	relative;
				width:                             	35%;
				overflow:							auto;
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
			<img width="177" height="113" src="assets/NPJ.bmp" class="custom-logo" alt="Núcleo de Prática Jurídica" sizes="(max-width: 177px) 100vw, 177px" align="right">
		  </a>
		  
		  <a href="http://www.puc-rio.br" class="custom-logo-link" rel="home">
			<img width="66" height="113" src="assets/PUC.png" class="custom-logo" alt="Puntíficia Universidade Catolica - PUC-Rio" sizes="(max-width: 177px) 100vw, 177px" align="left">
		  </a>
          <h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
          <h5 class="text-center">Consulta de Informações da Aluna</h5>
      </div>
		<div class="modal-body" id="id_print">
				<form class="form col-md-12 center-block" id="id_Form" method="post" action="mainProfessor.php" enctype="multipart/form-data">
					<?php
					
						$assistencia = $_POST['indexAtendimento'];
						echo "<input type=\"hidden\" name=\"index\" value=$assistencia>";
							
					echo "
						<table class=\"table table-bordered table-hover\">
						<tbody>
							<tr> 
								<td width=\"30%\">
									<strong>Proxima Consulta</strong>
								</td>
								<td width=\"40%\">
									<input type=\"date\" name=\"proximoatendimento\" value = \"$dataDeRetorno\">
								</td>
								<td width=\"15%\">
									<button type=\"submit\" formaction=\"reagendar.php\" >Reagendar</button>
								</td>
								<td width=\"15%\">
									<button>Ausente</button>
								</td>
							</tr>
							</tbody>
						</table>"; ?>
			
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