
<?php 

function embedSite($entrada)
{
	echo "

    <div style=\"height:100%;\">
        <iframe src=\"//$entrada\" width=\"100%\" height=\"100%\"></iframe>
    </div>";
}
?>