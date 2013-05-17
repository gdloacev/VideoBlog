<?php require("App_Config/GC.php"); ?>
<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php 
	if(!isset($_SESSION)) 
	{
		session_start();
	}
	$Error = '';
	$Saved = false;
	if(isset($_POST['btnSavePicture']))
	{
		$target = "Images/";
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
			$Error .= 'El archivo excede el maximo tama&ntilde;o permitido (2 MB)';
		}
	}
	if(isset($_POST['btnSaveThreadReply']))
	{
		$Index = new Index(); 
		$DBConn = $Index -> ConnectDB();
		
		$Query = 'insert into udtthread 
		(idUser, idTheme, Title, DateFrom) 
		values 
		(' . $_SESSION['UserId'] . ',1,\'' . $_POST['tbTitle'] . '\',Now())';
		
		$Query2 = 'insert into udtmessage
		(idThread,idUser,Title,Message,DateFrom)
		select ' . $_REQUEST['id'] . ',' . $_SESSION['UserId'] . ',\'' .  $_POST['tbTitle'] . '\',\'' . $_POST['tbMessage'] . '\',Now()';
	
			
		mysql_query($Query2,$DBConn);
		mysql_close($DBConn);
		unset($_POST['btnSaveThread']);
		$Saved = true;
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
    	<div style="width:700px;border:1px solid #003366;text-align:center;">
            <div>
            	<form action="Reply.php?id=<?php echo $_REQUEST['id']; ?>" method="post" enctype="multipart/form-data">
                <table id="Thread">
                    <tr>
                        <td>
                            Tema:
                        </td>
                        <td>
                       	  <input type="text" name="tbTitle" id="tbTitle" value="<?php echo Value('tbTitle','P'); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mensaje:
                        </td>
                        <td>
                       	  <textarea rows="8" cols="30" name="tbMessage" id="tbMessage"><?php echo Value('tbMessage','P'); ?></textarea>
                        </td>
                    </tr>
					<?php if($Saved) { ?>
						<tr>
							<td>
								Imagenes:
							</td>
							<td>
								<table>
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
										$Results = mysql_query($Query,$DBConn3);
				
										if(mysql_num_rows($Results) > 0)
										{
											while($row = mysql_fetch_array($Results))
											{ ?>
													<tr>
														<td><?php echo $row['Title']; ?></td>
														<td>
															<a href="Reply.php?Option=DeleteImage&picid=<?php echo $row['id']; ?>">Borrar</a>
														</td>
													</tr>
											<?php }
										}
									?>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:center;">
								<input type="file" name="UploadFile" id="UploadFile" /><br />
								<input name="btnSavePicture" type="submit" id="btnSavePicture" value="Subir Foto" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a href="index.php">Terminar</a>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<?php if(isset($Error)) {echo $Error;} ?>
							</td>
						</tr>
					<?php } else {?>
					<tr>
						<td colspan="2">
							<input name="btnSaveThreadReply" type="submit" id="btnSaveThreadReply" value="Guardar" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<a href="index.php">Cancelar</a>
						</td>
					</tr>
					<?php } ?>
                </table>
                </form>
            </div>
        </div>
    </body>
</html>
