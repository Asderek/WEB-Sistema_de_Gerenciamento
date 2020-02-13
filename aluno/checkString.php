<?php

	function CS_CheckString($mode,$testString,$nextMode)
	{
		if (strstr($mode,$testString) != false)
		{
			$indexAssistencia = substr($mode,strlen($testString));
			echo "<input type=\"hidden\" value=\"$indexAssistencia\" name=\"redirect\">";
			echo "
				<input type=\"hidden\" value=\"$nextMode\" name=\"mode\">
				<script type=\"text/javascript\">
					document.getElementById('id_Form').submit();
				</script>
			";
		}
	}
						
?>