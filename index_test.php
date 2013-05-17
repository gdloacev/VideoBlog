<?php require("App_Config/GC.php"); ?>
<?php 
	if(!isset($_SESSION)) 
	{
		session_start();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $ApplicationName; ?></title>
<link rel="stylesheet" href="CSS/Style.css" type="text/css" />
</head>
    <body>
    	<div style="width:700px;border:1px solid #003366;">
        	<?php 
				require("login.php");
				require("messages_test.php");
			?>
        </div>
    </body>
</html>
