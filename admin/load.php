<?php 
session_start();
define ('SESSION_TIMEOUT', "1800");
include('../inc/login.php'); 
$objectLogin = new myClassLogin();
$objectLogin->checkLogin();

include('../config/db.php');
include('entete.php');	


		
include('../inc/erreurs.php');

include('../inc/roles.php');	
$objectRole = new myClassRole();
$objectRole->roleAccess();

?>