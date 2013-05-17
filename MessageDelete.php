<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php 
	if(!isset($_SESSION)) 
	{
		session_start();
	}
	if(isset($_SESSION['UserId']))
	{
		if(isset($_REQUEST['id']) && $_REQUEST['id'] <> '')
		{
			$Index = new Index();
			$DBConn = $Index -> ConnectDB();
			$Query = 'delete from udtthread where id in (select distinct idThread from udtmessage where id=' . $_REQUEST['id'] . ')';
			mysql_query($Query,$DBConn);	
			mysql_close($DBConn);
			
			$Index = new Index();
			$DBConn = $Index -> ConnectDB();
			$Query = 'delete from udtmessage where id = ' . $_REQUEST['id'];
			mysql_query($Query,$DBConn);
			mysql_close($DBConn);

			$Index = new Index();
			$DBConn = $Index -> ConnectDB();
			$Query = 'delete from udtmessageimages where idMessage=' . $_REQUEST['id'];
			mysql_query($Query,$DBConn);	
			mysql_close($DBConn);
		}
	}
	header('Location:index.php');
?>