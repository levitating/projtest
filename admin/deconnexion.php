<?php 
session_start();
if (isset ($_SESSION["ID_USER"])) unset($_SESSION["ID_USER"]);
if (isset ($_SESSION["PSEUDO_USER"])) unset($_SESSION["PSEUDO_USER"]);
if (isset ($_SESSION["EMAIL_USER"])) unset($_SESSION["EMAIL_USER"]);
if (isset ($_SESSION["NOM_USER"])) unset($_SESSION["NOM_USER"]);
if (isset ($_SESSION["PRENOM_USER"])) unset($_SESSION["PRENOM_USER"]);
if (isset ($_SESSION["ROLE_USER"])) unset($_SESSION["ROLE_USER"]);
header("location: index.php");
exit;
?>