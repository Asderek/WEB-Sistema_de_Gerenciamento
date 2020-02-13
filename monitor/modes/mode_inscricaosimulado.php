<?php
	include('../utils/newconexao.php');
			
	$matricula = $_POST['matricula'];
	
	$inject = false;
	
	$injections = array (	"DROPTABLE","aluno","ALTER","OR","INSERT","DELETE","UPDATE","SELECT");
	
	foreach($injections as $inj)
	{
		if(strpos($matricula,$inj) !== false )
		{
			$inject = true;
		}
	}
	
	if($inject == true)
	{
		echo "My code is sanitized bitch";
		return;
	}
	
	$sql = "SELECT * FROM alunos WHERE matricula = $matricula ";
	$query = $conexao->query($sql);
	//$query = mysql_query($sql,$conexao);

	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$rows = count($result);
	//$rows = mysql_num_rows($query);
	
	if($rows > 0)
	{
		
		$nome = $result[0]['nome'];
		$professor= $result[0]['professor'];
		$disciplina = $result[0]['disciplina'];
		$oficina = $result[0]['oficina'];
		$status = $result[0]['status'];
		$turma = $result[0]['turma'];

		
		if ($oficina == 0 && $disciplina == "JUR1961")
		{
			echo '<h5 class="text-center">Verifique seus dados</h5>
			<table class="table table-bordered table-striped table-hover">
			<tbody>';
			echo "
			<tr>
					<td width='20%'><strong>Matrícula</strong></td>
					<td width='80%'>$matricula</td>";
					echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
					echo "
					</tr>
				  <tr>
					<td><strong>Nome</strong></td>
					<td>$nome</td>
					</tr>
				  <tr>
					<td><strong>Disciplina</strong></td>
					<td>$disciplina</td>
					</tr>
					  <tr>
							<td><strong>Professora</strong></td>
					<td>$professor</td>
					</tr>
					<tr>
							<td><strong>Turma</strong></td>
					<td>$turma</td>
					</tr>
			
			";

			 echo" </tbody>
				  </table> ";
			  
			  echo '  <button type="submit" class="btn btn-primary btn-lg btn-block" name="mode" value="confirmacaosimulado">Enviar Cadastro</button>';
		}
		else if ($oficina == 1 && $status == 0)
		{
			echo '<h5 class="text-center">Verifique seus dados</h5>
			<table class="table table-bordered table-striped table-hover">
			<tbody>';
			echo "
			<tr>
					<td width='20%'><strong>Matrícula</strong></td>
					<td width='80%'>$matricula</td>";
					echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
					echo "
					</tr>
				  <tr>
					<td><strong>Nome</strong></td>
					<td>$nome</td>
					</tr>
				  <tr>
					<td><strong>Disciplina</strong></td>
					<td>$disciplina</td>
					</tr>
					  <tr>
							<td><strong>Professora</strong></td>
					<td>$professor</td>
					</tr>
					<tr>
							<td><strong>Turma</strong></td>
					<td>$turma</td>
					</tr>
			
			";

			 echo" </tbody>
				  </table> ";
			  
			  echo '  <button type="submit" class="btn btn-primary btn-lg btn-block" name="mode" value="confirmacaosimulado">Enviar Cadastro</button>';
		}
		else if ($oficina == 0)
		{
			echo'<div class="text-center">Aluna não habilitada para o simulado <br/>
										Por favor, envie comprovante de conclusão de sua Oficina para <a href="mailto:npj@puc-rio.com.br"> npj@puc-rio.br</a><br/>
										O prazo para atualização do sistema é de 24 horas</div><br/>';
			
			echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';

		}
		else if ($status == 1)
		{
			echo'<h5 class="text-center">Aluna já cadastrada para o simulado</h5></br>';
			
			echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';

		}
	}
	else{
		echo '<div class="text-center">Matrícula não cadastrada<br/>Por favor, procure a secretaria do NPJ – <a href="mailto:npj@puc-rio.com.br"> npj@puc-rio.br</a></div></br>';
		echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
	}
?>