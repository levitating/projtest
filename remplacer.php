<?php
class myClassRemplacer
{
	function remplacerHtml($motRemplacer,$code,$lienPage)
	{
	//$motRemplacer = mysql_real_escape_string($motRemplacer);
	//$code = mysql_real_escape_string($code);
	//$lienPage = mysql_real_escape_string($lienPage);

	$page = file_get_contents($lienPage);
	$newpage = str_replace( $motRemplacer, $code, $page);
	echo $newpage ;
	//echo $code;
	}
}
?>