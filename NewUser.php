<?php require("App_Config/GC.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php require("App_Config/MainClass.php"); ?>
<?php 	
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_POST['btnSaveUser']))
	{
		$FirstName = '';
		$LastName = '';
		$User = '';
		$Password = '';
		$Mail = '';
		$Error = '';
		if(isset($_POST['tbFirstName']) and trim($_POST['tbFirstName']) <> '')
		{
			$FirstName = $_POST['tbFirstName'];
		}
		else
			$Error .= 'El nombre es requerido<br>';
		if(isset($_POST['tbLastName']) and trim($_POST['tbLastName']) <> '')
		{
			$LastName = $_POST['tbLastName'];
		}
		else
			$Error .= 'El apellido es requerido<br>';
		if(isset($_POST['tbUser']) and trim($_POST['tbUser']) <> '')
		{
			$User = $_POST['tbUser'];
		}
		else
			$Error .= 'El usuario es requerido<br>';
		if(isset($_POST['tbPassword']) and trim($_POST['tbPassword']) <> '')
		{
			if(isset($_POST['tbPassword2']) and trim($_POST['tbPassword2']) <> '')
			{
				if($_POST['tbPassword'] == $_POST['tbPassword2'])
				{
					$Password = $_POST['tbPassword'];
				}
				else
					$Error .= 'Las contraseñas no coinciden<br>';
			}
			else
				$Error .= 'No verificaste tu Contraseña<br>'; 
		}
		else
			$Error .= 'La contraseña es requerida<br>';
		if(isset($_POST['tbMail']) and trim($_POST['tbMail']) <> '')
		{
			$Mail = $_POST['tbMail'];
		}
		else
			$Error .= 'El mail es requerido';
		if($FirstName <> '' && $LastName <> '' && $User <> '' && $Password <> '' && $Mail <> '')
		{
			$Index = new Index(); 
			$DBConn = $Index -> ConnectDB();
			
			$Query = 'insert into udtuser (FirstName, LastName, UserName, 
			Passwrd, Mail, DateFrom, Active, ShowAlways) values (
			\''. $FirstName .'\',
			\''. $LastName .'\',
			\''. $User .'\',
			aes_encrypt(\''. $Password .'\',\'index!secure$key\'),
			\''. $Mail .'\',
			Now(),
			1,
			0)';
			
			mysql_query($Query,$DBConn);
			mysql_close($DBConn);
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
    	<div style="width:700px;border:1px solid #003366;">
        <form method="post" action="NewUser.php">
        	<table>
            	<tr>
                	<td style="text-align:right;">
                    	Nombre:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="text" name="tbFirstName" id="tbFirstName" value="<?php echo Value('tbFirstName','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right;">
                    	Apellido:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="text" name="tbLastName" id="tbLastName" value="<?php echo Value('tbLastName','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right;">
                    	Usuario:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="text" name="tbUser" id="tbUser" value="<?php echo Value('tbUser','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right;">
                    	Contraseña:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="password" name="tbPassword" id="tbPassword" value="<?php echo Value('tbPassword','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right;">
                    	Verifica Contraseña:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="password" name="tbPassword2" id="tbPassword2"  value="<?php echo Value('tbPassword2','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td style="text-align:right;">
                    	E-Mail:
                    </td>
                    <td style="text-align:left;">
                   	  <input type="text" name="tbMail" id="tbMail" value="<?php echo Value('tbMail','P');?>" />
                    </td>
                </tr>
                <tr>
                	<td colspan="2"><input type="submit" name="btnSaveUser" id="btnSaveUser" value="Enviar" /></td>
                </tr>
				<tr>
					<td colspan="2">
						<?php if(isset($Error)) { echo $Error;} ?>
					</td>
				</tr>
            </table>
            </form>
        </div>
    </body>
</html>