<?php

include('remplacer.php');
class myClassAfficherBandeau
{
	function afficherBandeau()
	{
	$code="";
	$lienPage='new.php';
	$motRemplacer="[slider]";

	$requetteBandeau = mysql_query("SELECT * FROM bandeau")or die(mysql_error());
	

		while($getBandeau= mysql_fetch_array($requetteBandeau))
		{
		
		$titreBandeau = $getBandeau['titre_bandeau'];
		$descriptionBandeau = $getBandeau['description_bandeau'];
		$imageBandeau = $getBandeau['image_bandeau'];

		$titreBandeau = mysql_real_escape_string($titreBandeau);
		$descriptionBandeau = mysql_real_escape_string($descriptionBandeau);
		$imageBandeau = mysql_real_escape_string($imageBandeau);
		
		$code=$code."<li><img src='uploadBandeau/".$imageBandeau."' alt=''><div class='banner'><strong>".$titreBandeau."</strong><p><span>".$descriptionBandeau.".</span></p></div></li><br>";
		}
		
		$codeSlider="<div class='main'><article id='content'><div class='slider_bg'><div class='slider'><ul class='items'>".$code."</ul></div></div></article></div>";
				
					$objetRemplacer = new myClassRemplacer();
					
					$objetRemplacer->remplacerHtml($motRemplacer,$codeSlider,$lienPage);
	}
}
include('config/db.php');
$objectAfficherBandeau= new myClassAfficherBandeau();
$objectAfficherBandeau->afficherBandeau();

?>