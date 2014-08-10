<?php 
session_start();
include('../config/db.php');
include('../inc/erreurs.php');
include('../inc/login.php');
$objectLogin = new myClassLogin();
$objectLogin->checkLoginIndex();
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Administration</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/accesstyletwo.js" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../css/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../css/accesstyleone.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../css/accesstyletree.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  <link href="../css/erreurs.css" rel="stylesheet">
  </head>

  <body kasperskyvirtualkeyboardtooltipshown="yes">

    <div class="container">
	<?php 
	$objectErreur = new myClassErreur();
	if (isset($_POST["pseudoAdminAccess"]) or isset($_POST["passAdminAccess"]))
	{
		$myPseudo = mysql_real_escape_string($_POST["pseudoAdminAccess"]);
		$myPass   = md5(mysql_real_escape_string($_POST["passAdminAccess"]));
		if (empty($myPseudo) or empty($myPass))
		{
			$objectErreur->initialiserErreur("Il faut remplir tout les champs" , 0);
		}
		else
		{
			$verifierDataQuery = mysql_query("SELECT * FROM admin WHERE pseudo_admin = '$myPseudo' and password_admin = '$myPass' ") or die(mysql_error()); 
			if ($verifierDataQuery && (mysql_num_rows($verifierDataQuery) != 0))
			{
				$getMyIdAdmin = mysql_fetch_assoc($verifierDataQuery);
				$_SESSION["ID_USER"] = $getMyIdAdmin["id_admin"];
				$_SESSION["PASS_USER"] = $getMyIdAdmin["password_admin"];
				$_SESSION["PSEUDO_USER"] = $getMyIdAdmin["pseudo_admin"];
				$_SESSION["EMAIL_USER"] = $getMyIdAdmin["email_admin"];
				$_SESSION["NOM_USER"] = $getMyIdAdmin["nom_admin"];
				$_SESSION["PRENOM_USER"] = $getMyIdAdmin["prenom_admin"];
				$_SESSION["ROLE_USER"] = $getMyIdAdmin["type_admin"];
				header("location: dashboard.php");
				//echo "<script>window.location.replace('Dashboard.php');</script>";
				//exit;
			}
			else
			{
				$objectErreur->initialiserErreur("l’identifiant ou mot de passe ne sont pas valide." , 0);
			}
		
		}
	}

 ?>
      <form action="index.php" method="POST" class="form-signin" role="form">
        <h2 class="form-signin-heading">Connectez-vous</h2>
        <input type="text" name="pseudoAdminAccess" class="form-control" placeholder="Pseudo" required="Remplir le champs pseudo" autofocus="">
		<br>
		
        <input type="password" class="form-control" name="passAdminAccess" placeholder="Mot de passe" required="">
        <div class="checkbox">
          <label>
            <input type="checkbox"  value="remember-me"> Se souvenir de moi
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
      </form>

    </div> 

</body></html>