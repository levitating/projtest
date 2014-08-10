<?php 

//  hostname de la base de données, par defaut localhsot
$mysql_hostname = "localhost"; 



//  utilisateur de la base de données
$mysql_utilisateur = "Vbeta1";



//  mot de passe d'utilisateur de la abase de donnée
$mysql_pass = "hhhhh";  



// nom de la base de données
$mysql_database = "uabt";  



//  etablir la connexion a la base de donnée
$bd = mysql_connect($mysql_hostname, $mysql_utilisateur, $mysql_pass) or die("Erreur de connexion"); 



//  selectionner la base de données
mysql_select_db($mysql_database, $bd) or die("Erreur de connexion");



//  encoder les caractéres envoyées a la base de données
mysql_query("SET NAMES 'utf8'");  
 ?>