<?php 
	$path = $_FILES['background']['name'];
	$ext1 = pathinfo($path, PATHINFO_EXTENSION);
	$arquivo = $_FILES['background'];
	
	
	$success = 1;
	
	$ext1 = strtolower($ext1);
	
	$target_Path = 'assets/img/';
	//echo "target_Path = $target_Path<br>";
	
	
	//$target_Path = "../uploads/$cpf/";
	if (is_dir($target_Path) != 1)
	{
		echo "nao achei path<br>";
		$sucess = 0;
	}
	else
	{
		chmod($target_Path, 0775);
	}
	
	$filePath = $target_Path.basename($path);
	 echo "filePath = $filePath<br>";
	
	if(move_uploaded_file( $arquivo['tmp_name'], $filePath ) == false)
	{
		echo "nao consegui mover<br>";
		$success = 0;
	}
	
	echo "success = $success<br>";
	
	if ($success != 0)
	{
		$newpath = $target_Path.'bg.jpg';
		$oldpath = $filePath;
		
		echo "newpath = $newpath<br>oldpath = $oldpath<br>"; 
		
		rename($oldpath,$newpath);
		
		chmod($newpath,0777);
	}
	
	if ($success != 0)
	{
		
		echo "<form id=\"id_auto\" action=\"index.html\" method=\"post\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
	}
				  
?>