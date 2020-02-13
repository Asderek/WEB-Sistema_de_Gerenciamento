<?php
	
	
	function PROC_GetListaProcessos($attendIndex, $conexao)
	{
		{
			$sqlSearch = "SELECT * FROM `processos` WHERE `indiceatendimento` = $attendIndex";
			$querySearch = $conexao->query($sqlSearch);
			$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
			$rowsSearch = mysql_num_rows($resultSearch);
			
			if ($rowsSearch < 0)
			{
				return 0;
			}
			else
			{
				$arrayRet = array();
				
				for($i=0;$i<$rowsSearch;$i++)
				{
					
					$arrayInsert = array();
					array_push($arrayInsert,$resultSearch[$i]['index']);
					array_push($arrayInsert,$resultSearch[$i]['numerodoprocesso']);
					
					array_push($arrayRet,$arrayInsert);
				}
				return $arrayRet;
			}
		}
		
	}
	
?>