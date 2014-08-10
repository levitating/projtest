<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Administration de l'UABT</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
  


    <link href="../css/dashboard.css" rel="stylesheet">

  <script src="../js/jquery.min.js"></script>
 <!--script src="../js/bootstrap.min.js"></script-->
    <!--[if lt IE 9]><script src="http://getbootstrap.com/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>
    <script src="../js/bootstrap.js"></script>
   
  

    <script src="../js/ie10-viewport-bug-workaround.js"></script>

	
	    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
		
		<script>

			tinymce.init({
				selector: "textarea#texteditor", theme: "modern",width: '100%',height: 300,
				plugins: [
					 "advlist autolink link image lists charmap code print preview hr anchor pagebreak",
					 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
					 "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
			   ],
			   language : 'fr_FR',
			   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
			   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
			   image_advtab: true ,
			   
			   external_filemanager_path:"/uabt/admin/filemanager/",
			   filemanager_title:"Responsive Filemanager" ,
			   external_plugins: { "filemanager" : "/uabt/admin/filemanager/plugin.min.js"}
			 }); 
	</script> 
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style id="holderjs-style" type="text/css"></style>
  <link rel="stylesheet" href="../css/accordionmenu.css" type="text/css" media="screen" />


  <link href="../css/supplement.css" rel="stylesheet">
  <link href="../css/erreurs.css" rel="stylesheet">
  </head>

  <body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo 'M. '.$_SESSION["NOM_USER"].' '.$_SESSION["PRENOM_USER"]; ?></a>
        </div>
        <div class="navbar-collapse collapse" style="height: 1px;">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Panneau</a></li>
            <li><a href="#">paramètres</a></li>
            <li><a href="ModifierUtilisateur.php?administrateur=<?php echo $_SESSION["ID_USER"]; ?>">Profile</a></li>
            <li><a href="#">Aides</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Chercher...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="padding: 0 !important;">
    
	
<?php  include('MenuAdmin.php'); ?>
	
	
	
	
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		