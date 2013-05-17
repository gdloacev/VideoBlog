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
		header('Location:Index.php');
	}
	if(isset($_POST['btnSaveEditThread']))
	{
		if(isset($_POST['tbTitle']) and isset($_POST['tbMessage']))
		{
			$Index = new Index(); 
			$DBConn = $Index -> ConnectDB();
			$Query = 'update udtmessage set Title = \'' . $_POST['tbTitle'] . '\', Message = \'' . $_POST['tbMessage'] . '\' where id = ' . $_REQUEST['id'];
			//echo $Query;
			mysql_query($Query,$DBConn) or die(mysql_error());
			unset($_POST['btnSaveEditThread']);
			unset($_POST['tbTitle']);
			unset($_POST['tbMessage']);
			header('Location:index.php');
		}
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
				<?php 
					$Index = new Index(); 
					$DBConn = $Index -> ConnectDB();
					
					$Query = 
					'select Title, Message from udtmessage where id = ' . $_REQUEST['id'] ;
					
					$Results = mysql_query($Query,$DBConn);
					
					if(mysql_num_rows($Results) > 0)
					{
						$row = mysql_fetch_array($Results);
					}
				?>
            	<form action="MessageEdit.php?id=<?php echo $_REQUEST['id']; ?>" method="post" enctype="multipart/form-data">
                <table id="Thread">
                    <tr>
                        <td>
                            Tema:
                        </td>
                        <td>
                       	  <input type="text" name="tbTitle" id="tbTitle" value="<?php echo $row['Title']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mensaje:
                        </td>
                        <td>
                       	  <textarea rows="8" cols="30" name="tbMessage" id="tbMessage"><?php echo $row['Message']; ?></textarea>
                        </td>
                    </tr>
					<?php if($_SESSION['UserId'] = 1 and !$Saved) { ?>
						<!--<tr>
							<td style="text-align:rigth;">
								Categoria
							</td>
							<td style="text-align:left;">
								<select id="TypeSelect" name="TypeSelect">
									<option selected="selected" value="1">Blog</option>
									<option value="2">Algo que decirte</option>
								</select>
							</td>
						</tr>-->
					<?php } ?>
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
										and Title = \'' . $row['Title'] . '\' 
										and Message = \'' . $row['Message'] . '\')';
										
										//echo $Query;
										$Results = @mysql_query($Query,$DBConn3);
				
										if(@mysql_num_rows($Results) > 0)
										{
											while($row = mysql_fetch_array($Results))
											{ ?>
													<tr>
														<td><?php echo $row['Title']; ?></td>
														<td>
															<!--<a href="NewThread.php?picid=<?php echo $row['id']; ?>">Borrar</a>-->
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
							<input name="btnSaveEditThread" type="submit" id="btnSaveEditThread" value="Guardar" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<a href="index.php">Cancelar</a>
						</td>
					</tr>
					<?php }
						mysql_free_result($Results);
						mysql_close($DBConn);
					?>
                </table>
                </form>
            </div>
        </div>
    </body>
</html>