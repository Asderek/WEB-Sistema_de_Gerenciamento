<table class="table table-bordered table-hover">
	<tbody>
		<tr>
			<td width='30%'><strong>Professor</strong></td>
			<td>
				<select name="professor" id="id_professorSelect">
					<option value="none"></option>
					<?php
						include ('../../newconexao.php');
						$sqlProfessor = "SELECT * FROM `professores` WHERE 1";
						$queryProfessor = $conexao->query($sqlProfessor);
						$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
						for($i=0;$i<count($resultProfessor);$i++)
						{
							$value = $resultProfessor[$i]['nome'];
							echo "<option value=\"$value\">$value</option>";
						}
					?>
				</select>
			</td>
		</tr>
	
		<tr>
			<td width='30%'><strong>Assunto</strong></td>
			<td width='70%'><input type="text" id="id_assunto" size="80" name="subject" placeholder="Assunto do Email" required></td>
		</tr>
		
		<tr>
			<td width='30%' rowspan="5"><strong>Corpo do Email</strong></td>
			<td width='70%' rowspan="5"><textarea name="descricao" id="id_corpo" cols="120" rows="5" placeholder="Corpo do Email" align="center"></textarea></td>
		</tr>
		
		<tr>
			<td width='30%' style="display:none"><strong></strong></td>
		</tr>
		
		<tr>
			<td width='30%' style="display:none"><strong></strong></td>
		</tr>
		
		<tr>
			<td width='30%' style="display:none"><strong></strong></td>
		</tr>
		
		<tr>
			<td width='30%' style="display:none"><strong></strong></td>
		</tr>
			
		<tr>
			<td width='30%'><strong>EMA</strong></td>
			<td>
				<input type="checkbox" id="id_emaCheckbox1" name="EMA1" onclick="onCheck();">Ema1</input>
				<input type="checkbox" id="id_emaCheckbox2" name="EMA2" onclick="onCheck();">Ema2</input><br>
				<input type="checkbox" id="id_emaCheckbox3" name="EMA3" onclick="onCheck();">Ema3</input>
				<input type="checkbox" id="id_emaCheckbox4" name="EMA4" onclick="onCheck();">Ema4</input>
			</td>
		</tr>	
			
		<tr>
			<td width='30%'><strong>CC</strong></td>
			<td>
				<input type="text" name="cc" placeholder="email1@gmail.com;email2@yahoo.com" size="60"></input>
			</td>
		</tr>	

		<tr align="center">
			<td colspan="2">
				<button id="id_buttonTurma" type="submit" name="destino" value="turma" formaction="enviarEmail.php">Enviar Email Para a Turma</button>
				<button id="id_buttonPlantao" type="submit" name="destino" value="plantao" formaction="enviarEmail.php">Enviar Email Para o Plantao</button>
			</td>
		</tr>
		
	</tbody>
</table>

<h3 class="text-center"><button type="submit" name="mode" value="email" formnovalidate class="btn btn-primary" onclick="emails();">Obter Lista de Emails</button></h3>

<?php

	if (isset($_POST['getEmails']))
	{
		$professorAntigo = "";
		$sqlEmails = "SELECT * FROM `alunos` ORDER BY `disciplina`, `professor`, `nome` ASC";
		
		$queryEmails = $conexao->query($sqlEmails);
		if($queryEmails != false)
		{
			$resultEmails = $queryEmails->fetchAll(PDO::FETCH_ASSOC);
			echo "<table class=\"table table-bordered\">";
			for($i=0;$i<count($resultEmails);$i++)
			{
				$nome = $resultEmails[$i]['nome'];
				$email = $resultEmails[$i]['email'];
				$matricula = $resultEmails[$i]['matricula'];
				$professor = $resultEmails[$i]['professor'];
				if ($professor != $professorAntigo)
				{
					echo "<tr><td colspan=\"3\" align=\"center\" style=\"background-color: #ccc\"><strong>$professor</strong></td></tr>";
					$professorAntigo = $professor;
				}
				echo "<tr><td>$matricula</td><td>$nome</td><td>$email</td></tr>";
			}
			echo "</table>";
		}
	}

?>

<script>
	function onCheck()
	{
		if (document.getElementById('id_emaCheckbox1').checked || document.getElementById('id_emaCheckbox2').checked ||document.getElementById('id_emaCheckbox3').checked ||document.getElementById('id_emaCheckbox4').checked) 
		{
			document.getElementById('id_professorSelect').style.display = "none";
			document.getElementById('id_buttonPlantao').style.display = "none";
			document.getElementById("id_buttonTurma").childNodes[0].nodeValue= "Enviar Email para os Alunos desse EMA";
			document.getElementById("id_buttonTurma").value= "EMA";

			//document.getElementById('id_professorSelect').setAttribute('hidden','hidden');
		}
		else
		{
			document.getElementById('id_professorSelect').style.display = "";
			document.getElementById('id_buttonPlantao').style.display = "";
			document.getElementById("id_buttonTurma").childNodes[0].nodeValue= "Enviar Email Para a Turma";
			document.getElementById("id_buttonTurma").value= "turma";
		}
	}
	
	function validateAndSend() {
		var select = document.getElementById('id_professorSelect');
		var assunto = document.getElementById('id_assunto');
		var corpo = document.getElementById('id_corpo');
		var ema1 = document.getElementById('id_emaCheckbox1');
		var ema2 = document.getElementById('id_emaCheckbox2');
		var ema3 = document.getElementById('id_emaCheckbox3');
		var ema4 = document.getElementById('id_emaCheckbox4');
		
		
		var boolCorpo = (corpo.value != '');
		var boolAssunto = (assunto.value != '');
		var boolSelect = (select.value!='none');
		var boolEma = ema1.checked || ema2.checked || ema3.checked || ema4.checked;
		
		console.log("boolCorpo = "+boolCorpo);
		console.log("boolAssunto = "+boolAssunto);
		console.log("boolSelect = "+boolSelect);
		console.log("boolEma = "+boolEma);
		
		if ((boolSelect || boolEma) && boolCorpo && boolAssunto)
		{
			document.getElementById('id_form').submit();
		}
		else
		{
			alert('Escolha ao menos um professor ou um EMA e preencha os campos assunto e corpo');
			return false;
		}
	}
	
	function emails()
	{
		var input = document.createElement("input");
		input.setAttribute("type","hidden");
		input.setAttribute("name","getEmails");
		input.setAttribute("value","getEmails");
		document.getElementById('id_Form').appendChild(input);
	}
	
</script>