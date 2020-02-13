<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html 
		{ 
			background: url(../../assets/img/pilotis.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.modal-footer {   border-top: 0px; }
	
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
					<h3 class="text-center">Relação de Alunos por Horario</h3>
					</div>
					<div class="modal-body">
						<form action="registraplantao.php" method="post">
								<?php
									
									include('../../newconexao.php');
									
									$abr = $_POST['professor'];
									echo "<input type=\"hidden\" value=\"$abr\" name=\"professor\">";
									echo "
										<table class=\"table table-bordered table-striped\" id=\"id_table\" style=\"width:100%\">
											<tbody id=\"id_body\">
											<tr id=\"id_button\">
												<td align =\"center\" colspan=\"3\"><button type=\"button\" onclick=\"novoplantao()\">+</button></td>
											</tr><tr>
												<td align =\"center\" colspan=\"3\"><strong>$abr</strong></td>
											</tr>
											<tr>
												<td align =\"center\"><b>Dia</b></td>
												<td align =\"center\"><b>Inicio</b></td>
												<td align =\"center\"><b>Fim</b></td> 
											</tr>";
									echo "
										<tr>
											<td align =\"center\">
												<select name=\"dia1\">
													<option value=\"2\">Segunda</option>
													<option value=\"3\">Terça</option>
													<option value=\"4\">Quarta</option>
													<option value=\"5\">Quinta</option>
													<option value=\"6\">Sexta</option>
												</select>
											</td>
											<td align =\"center\">
												<select name=\"start1\" id=\"id_start1\">";
													for($i=8;$i<22;$i++)
													{
														echo "<option value=\"$i\">$i".":00</option>";
													}
											echo "</select></td><td align =\"center\">
												<select name=\"end1\" id=\"id_end1\" onchange=\"filter()\">";
													for($i=8;$i<22;$i++)
													{
														echo "<option value=\"$i\">$i".":00</option>";
													}
												echo "
												
												</select></td> 											
										</tr>
										</tbody></table><br>
									";
									
									{ //Detalhes do Plantao
									echo "
										<table class=\"table table-bordered table-striped\" id=\"id_tableDetalhe\" style=\"width:100%\">
											<tbody id=\"id_bodyDetalhe\">
												<tr>
													<td align =\"center\" colspan=\"3\"><strong>Detalhes do Plantão</strong></td>
												</tr>
												<tr>
													<td align =\"center\"><strong>1o Atendimento às</strong></td>
													<td align =\"center\"><strong>Numero Max de Alunos</strong></td>
													<td align =\"center\"><strong>Numero Max de Clientes</strong></td>
												</tr>
												<tr>
													<td align=\"center\">
														<select name=\"primAtendimento1\" id=\"id_primAtendimento1\">";
														for($i=8;$i<22;$i++)
														{
															echo "<option value=\"$i\">$i".":00</option>";
														}
														echo "</select>
													</td>
													<td align=\"center\">
														<select name=\"numAlunos1\">";
														for($i=0;$i<25;$i += 5)
														{
															echo "<option value=\"$i\">$i</option>";
														}
														echo "</select>
													</td>
													<td align=\"center\">
														<select name=\"numAssistidos1\">";
														for($i=0;$i<10;$i++)
														{
															echo "<option value=\"$i\">$i</option>";
														}
														echo "</select>
													</td>
												</tr>
											</tbody>
										</table>
										
									
									";
									}
									
								?>
							<input type="submit" value="Registrar" class="btn btn-primary btn-lg btn-block"></td></tr>
							<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>
							
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
			
			onload = function()
			{
				curplantao=2;
			}
			function novoplantao()
			{
				if(curplantao>3)
				{
					console.log(curplantao);
					return false;
				}
				
				var body = document.getElementById('id_body');
				var tr = document.createElement("tr");
				var tdDia = document.createElement("td");
				var tdStart = document.createElement("td");
				var tdEnd = document.createElement("td");
				
				//<Dia>
					var select = document.createElement("select");
					select.setAttribute("name","dia"+curplantao);
					
					var optionSegunda = document.createElement("option");
					optionSegunda.setAttribute("value","2");
					optionSegunda.innerHTML = "Segunda";
					select.appendChild(optionSegunda);
					
					var optionSegunda = document.createElement("option");
					optionSegunda.setAttribute("value","3");
					optionSegunda.innerHTML = "Terça";
					select.appendChild(optionSegunda);
					
					var optionSegunda = document.createElement("option");
					optionSegunda.setAttribute("value","4");
					optionSegunda.innerHTML = "Quarta";
					select.appendChild(optionSegunda);
					
					var optionSegunda = document.createElement("option");
					optionSegunda.setAttribute("value","5");
					optionSegunda.innerHTML = "Quinta";
					select.appendChild(optionSegunda);
					
					var optionSegunda = document.createElement("option");
					optionSegunda.setAttribute("value","6");
					optionSegunda.innerHTML = "Sexta";
					select.appendChild(optionSegunda);
					
					tdDia.appendChild(select);
				//</Dia>
				
				//<Start>
					var select = document.createElement("select");
					select.setAttribute("name","start"+curplantao);
					select.setAttribute("id","id_start"+curplantao);
					for(var i=8;i<22;i++)
					{
						var optionSegunda = document.createElement("option");
						optionSegunda.setAttribute("value",i);
						optionSegunda.innerHTML = i+":00";
						select.appendChild(optionSegunda);
					}
					tdStart.appendChild(select);
				//</Start>
				
				//<End>
					var select = document.createElement("select");
					select.setAttribute("name","end"+curplantao);
					select.setAttribute("id","id_end"+curplantao);
					select.setAttribute("onchange","filter()");
					for(var i=8;i<22;i++)
					{
						var optionSegunda = document.createElement("option");
						optionSegunda.setAttribute("value",i);
						optionSegunda.innerHTML = i+":00";
						select.appendChild(optionSegunda);
					}
					tdEnd.appendChild(select);
				//</End>
				
				tdDia.setAttribute("align","center");
				tdStart.setAttribute("align","center");
				tdEnd.setAttribute("align","center");
				
				tr.appendChild(tdDia);
				tr.appendChild(tdStart);
				tr.appendChild(tdEnd);
				children = body.children;
				body.insertBefore(tr,children[children.length]);
				
				
				//Detalhes
				var body = document.getElementById('id_bodyDetalhe');
				var tr = document.createElement("tr");
				var tdAtendimento = document.createElement("td");
				var tdNumAlunos = document.createElement("td");
				var tdMaxAssistidos = document.createElement("td");
				
				//<primAtendimento>
					var select = document.createElement("select");
					select.setAttribute("name","primAtendimento"+curplantao);
					select.setAttribute("id","id_primAtendimento"+curplantao);
					
					for (var i=8;i<22;i++)
					{
						var optionPrimAtendimento = document.createElement("option");
						optionPrimAtendimento.setAttribute("value",i);
						optionPrimAtendimento.innerHTML = i+":00";
						select.appendChild(optionPrimAtendimento);
					}
					
					tdAtendimento.appendChild(select);
				//</primAtendimento>
				
				//<NumAlunos>
					var select = document.createElement("select");
					select.setAttribute("name","numAlunos"+curplantao);
					
					for (var i=0;i<25;i += 5)
					{
						var optionNumAlunos = document.createElement("option");
						optionNumAlunos.setAttribute("value",i);
						optionNumAlunos.innerHTML = i;
						select.appendChild(optionNumAlunos);
						
					}
					
					tdNumAlunos.appendChild(select);
				//</NumAlunos>
				
				//<MaxAssistidos>
					var select = document.createElement("select");
					select.setAttribute("name","numAssistidos"+curplantao);
					
					for (var i=0;i<10;i++)
					{
						var optionMaxAssistidos = document.createElement("option");
						optionMaxAssistidos.setAttribute("value",i);
						optionMaxAssistidos.innerHTML = i;
						select.appendChild(optionMaxAssistidos);
					}
					
					tdMaxAssistidos.appendChild(select);
				//</MaxAssistidos>
				
				tdAtendimento.setAttribute("align","center");
				tdNumAlunos.setAttribute("align","center");
				tdMaxAssistidos.setAttribute("align","center");
				
				tr.appendChild(tdAtendimento);
				tr.appendChild(tdNumAlunos);
				tr.appendChild(tdMaxAssistidos);
				children = body.children;
				body.insertBefore(tr,children[children.length]);
				
				curplantao++;
				if(curplantao>3)
				{
					var body = document.getElementById('id_body');
					console.log("body = " +body)
					console.log("firstChild = " + body.firstChild)
					//body.removeChild(body.firstChild);
					body.removeChild(document.getElementById('id_button'));
					return false;
				}
				
			}
			
			function filter()
			{
				for(var cont = 1; cont<4; cont++)
				{
					var select = document.getElementById('id_primAtendimento'+cont);
					if (select == null)
						return false;
					while (select.firstChild) {
						select.removeChild(select.firstChild);
					}
					var startOption = document.getElementById('id_start'+cont)
					var start = parseInt(startOption.options[startOption.selectedIndex].value);
					var endOption = document.getElementById('id_end'+cont)
					var end = parseInt(endOption.options[endOption.selectedIndex].value);
					
					for (var i=start;i<end;i++)
					{
						var optionPrimAtendimento = document.createElement("option");
						optionPrimAtendimento.setAttribute("value",i);
						optionPrimAtendimento.innerHTML = i+":00";
						select.appendChild(optionPrimAtendimento);
					}
				}
			}
			$(document).ready(function() {});				
		</script>
        
    </body>
</html>