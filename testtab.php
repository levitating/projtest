<?php

$tab = array();
$tab[2] = 4;
$tab[5] = 8;
$tab[6] = 5;

arsort($tab);
foreach ($tab as $key => $val) {
    echo "$key = $val\n";
	$req=mysql_query("SELECT * from actu where id_a");
	$result = mysql_fetch_assoc($req);
	$titre=
	
}

var_dump($tab[2]);
?>