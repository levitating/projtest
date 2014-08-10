<?php 


class myClassLogin {

	function checkLogin()
	{
		if (!isset($_SESSION["ID_USER"]))
			{
				header("location: index.php");
				exit;
			}
	}
	
	function checkLoginIndex()
	{
		if (isset($_SESSION["ID_USER"]))
			{
				header("location: dashboard.php");
				
			}
	}


}



?>