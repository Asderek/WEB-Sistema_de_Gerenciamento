<?php 
	include('../../newconexao.php');

	$matricula = $_POST['matricula'];
	$sqlDados = "SELECT * FROM `alunos` WHERE `matricula` = $matricula";
	$queryDados = $conexao->query($sqlDados);
	$resultDados = $queryDados->fetchAll( PDO::FETCH_ASSOC );
	$nome = $resultDados[0]['nome'];
	$tel = $resultDados[0]['telefone'];

?>

<div class="form-group">
	<label for="matricula">Matricula: </label>
	<input type="text"  name="matricula" class="form-control input-lg" value="<?php echo "$matricula";?>" readonly>
</div>

<div class="form-group">
	<label for="nome">Nome: </label>
	<input type="text"  name="nome" class="form-control input-lg" value="<?php echo "$nome";?>" readonly>
</div>

<div class="form-group">
	<label for="tel">Telefone: </label>
	<input type="tel" name="tel" class="form-control input-lg" value="<?php echo "$tel";?>" readonly>
</div>

<div class="form-group">
	<label for="formatura">Previsão de Formatura: </label>
	<input type="text" name="formatura" class="form-control input-lg" placeholder="jun/2020">
</div>


<?php
	include('../../newconexao.php');

	$sqlSearch = "SELECT * FROM professoresmonitoria WHERE 1";
	$querySearch = $conexao->query($sqlSearch);
	$rowsSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	
	
	echo '<div class="form-group">';
		echo '<div class="col-lg-10">';
			echo '<label for="professor">Professor - Area: </label>';
				echo '<select class="form-control" id="professor" name="professor">';
	
	
	for($x=0;$x<count($rowsSearch);$x++)
	{
		$status = $rowsSearch[$x]['status'];
		if($status==1)
		{
			$name = $rowsSearch[$x]['nome'];
			$area = $rowsSearch[$x]['area'];
			
			echo '<option name="'.$x.'">'.$name.' - '.$area.'</option>';

		}
	}
				echo '</select>';
			echo '<br>';
		echo '</div>';
	echo '</div>';
	?>
	<br><br><br><br>
<div class="form-group" style="float:left; width: 100%;" >
	<label for="nome">Apresentação: </label>
	<textarea id="apresentacao" name="apresentacao" style="width: 100%" rows="2" placeholder="Digite uma breve apresentação"></textarea>
</div>

<div class="form-group">
	<label for="razao">Porque deseja este estágio: </label>
	<textarea id="razao" name="razao" style="width: 100%" rows="2" placeholder="Explique"></textarea>
</div>

<div class="form-group">
	<label for="nome">Experiencia: </label>
	<textarea id="exp" name="exp" style="width: 100%" rows="5" placeholder="Descreva sua experiencia"></textarea>
</div>

<div class="form-group">
		<input type="checkbox" name="OAB" value="1"> Possuo carteira da OAB<br>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="mode" value="confirmamonitoria">Cadastrar</button>
</div>