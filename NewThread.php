<?php require("App_Config/GC.php"); ?>
<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php 
	if(!isset($_SESSION)) 
	{
		session_start();
	}
	if(!isset($_SESSION['UserId']))
	{
		header('Location:index.php');
	}
	$Error = '';
	$Saved = false;
	if(isset($_POST['btnSavePicture']))
	{
		$target = "images_blog/";
		$target = $target . basename($_FILES['UploadFile']['name']);
		$size = ($_FILES['UploadFile']['size'] / 1024) / 1024;
		if($size > 0)
		{
			if(move_uploaded_file($_FILES['UploadFile']['tmp_name'], $target))
			{
				$Index = new Index(); 
				$DBConn2 = $Index -> ConnectDB();
				
				$QueryIma = 'insert into udtmessageimages
				(idMessage, Title, Path)
				select id, \'' . basename($_FILES['UploadFile']['name']) . '\', \'' . basename($_FILES['UploadFile']['name']) . '\'
				from udtmessage
				where idUser = ' . $_SESSION['UserId'] . '
				and Title = \'' . $_POST['tbTitle'] . '\'
				and Message = \'' . $_POST['tbMessage'] . '\'';
					
				mysql_query($QueryIma,$DBConn2);
				mysql_close($DBConn2);
				
				$Saved = true;
			}
			else
			{
				$Error .= 'No se ha podido procesar el archivo';
			}
		}
		else
		{
			$Error .= 'El archivo excede el maximo tamaño permitido (2 MB)';
		}
	}
	if(isset($_POST['btnSaveThread']))
	{
		$Index = new Index(); 
		$DBConn = $Index -> ConnectDB();
		$Query = 'insert into udtthread 
		(idUser, idTheme, Title, DateFrom, idType) 
		values 
		(' . $_SESSION['UserId'] . ',1,\'' . $_POST['tbTitle'] . '\',Now(),' . $_POST['TypeSelect'] . ')';
		
		$Query2 = 'insert into udtmessage
		(idThread,idUser,Title,Message,DateFrom)
		select id, idUser, \'' . $_POST['tbTitle'] . '\', \'' . $_POST['tbMessage'] . '\', Now()
		from udtthread
		where idUser = ' . $_SESSION['UserId'] . '
		and Title = \'' . $_POST['tbTitle'] . '\'';

		mysql_query($Query,$DBConn);
		mysql_query($Query2,$DBConn);
		mysql_close($DBConn);
		unset($_POST['btnSaveThread']);
		$Saved = true;
	}
	
	if(isset($_REQUEST['picid']))
	{
		$picId = $_REQUEST['picid'];
		$Index = new Index();
		$DBConn = $Index -> ConnectDB();
		$QueryDelete = 'delete from udtmessageimages where id='.$picId;
		mysql_query($QueryDelete,$DBConn);
		mysql_close($DBConn);
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title><?php echo $ApplicationName; ?></title>
	<link rel="stylesheet" href="CSS/Style.css" type="text/css" />
	<link rel="stylesheet" href="CSS/Style.css" type="text/css" />
	<link rel="stylesheet" href="CSS/thread.css" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
    <body>
    	<header>
	    	<h1><?php echo $ApplicationName; ?></h1> 
	  	</header>
		<nav>
	    	<ul>
	      		<li><a href="./">Inicio</a></li>
	    	</ul>
		</nav>
		<section>
    		<article>
	    		<h2>Nuevo Tema:</h2>
				    <form action="NewThread.php" method="post" enctype="multipart/form-data">
                	<label for="tbTitle">Tema:</label>
					<input type="text" name="tbTitle" id="tbTitle" value="<?php echo Value('tbTitle','P'); ?>" required autofocus/>
                    <label for="tbMessage">Mensaje:</label>
					<textarea rows="8" cols="30" name="tbMessage" id="tbMessage" required><?php echo Value('tbMessage','P'); ?></textarea>
					<?php if($_SESSION['UserName'] == "admin" and !$Saved) { ?>
							<label for="TypeSelect">Categoria:</label>
							<select id="TypeSelect" name="TypeSelect">
								<option selected="selected" value="1">Blog</option>
								<option value="2">Algo que decirte</option>
							</select>
					<?php } ?>
					<?php if($Saved) { ?>
							<h3>Imagenes:</h3>
									<?php
										$Index = new Index(); 
										$DBConn3 = $Index -> ConnectDB();

										$Query = 'select * 
										from udtmessageimages
										where idMessage = 
										(select id 
										from udtmessage 
										where idUser = ' . $_SESSION['UserId'] . ' 
										and Title = \'' . $_POST['tbTitle'] . '\' 
										and Message = \'' . $_POST['tbMessage'] . '\')';
										
										//echo $Query;
										$Results = @mysql_query($Query,$DBConn3);
										
										if(@mysql_num_rows($Results) > 0)
										{
											while($row = mysql_fetch_array($Results))
											{ ?>
														<p><?php echo $row['Title']; ?></p>
															<!--<a href="NewThread.php?picid=<?php echo $row['id']; ?>">Borrar</a>-->
											<?php }
										}
									?>
								<input type="file" name="UploadFile" id="UploadFile" /><br />
								<input name="btnSavePicture" type="submit" id="btnSavePicture" value="Subir Foto" />
								<a href="index.php">Terminar</a>
								<p><?php if(isset($Error)) {echo $Error;} ?></p>
					<?php } else {?>
							<input name="btnSaveThread" type="submit" id="btnSaveThread" value="Guardar" />
					<?php } ?>
                </form>
	        </article>
        </section>
      	<footer>
	   	 <small>Copyright &copy; 2013. Todos los derechos reservados. Oscar Aceves.</small>
	  	</footer>
		<!-- JavaScript -->
  		<script src="Scripts/prefixfree.min.js"></script>
    </body>
</html>
