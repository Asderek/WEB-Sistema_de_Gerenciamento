<?php
						
	include('../utils/newconexao.php');
	include('../utils/email.php');

	$matricula= $_POST['matricula'];

	$sqlCheck = "SELECT * FROM `alunos` WHERE `matricula`=$matricula";
	$query = $conexao->query($sqlCheck);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	//$query = mysql_query($sqlCheck,$conexao);
	if($result[0]['atual1'] == -3)
		$sql = "update alunos set status =1, atual1=-1 where matricula = $matricula ";
	else
		$sql = "update alunos set status =1, atual2=-1 where matricula = $matricula ";
	
	$query = $conexao->query($sql);
	
	if($query!=false)
	{
	  echo '<h5 class="text-center">sua inscrição para o simulado foi concluída.<p></p>';
	  echo date(DATE_RFC822);
	  echo "<br><br>";
	  //echo '<a href="index.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
	  
	  $email = EMAIL_GET($matricula);
	  if ($email != null)
	  {
		  $sbj = "Confirmação de Inscrição no Simulado EMA";
		  $nome = $result[0]['nome'];
		  $data = date(DATE_RFC822);
		  $msg = "Prezada(o) Aluna(o) $nome\n\nEssa é uma confirmação de que você inscreveu-se no simulado no dia $data\n\n";
		  EMAIL_SEND($email,$sbj,$msg);
	  }
	  
	}
	else
	{
	  echo '<h5 class="text-center">por favor, procure a secretaria do npj</h5><p></p>';
	  //echo '<a href="index.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
	}	
						
						
?>