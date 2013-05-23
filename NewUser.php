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
			Passwrd, Mail, DateFrom, Active) values (
			\''. $FirstName .'\',
			\''. $LastName .'\',
			\''. $User .'\',
			aes_encrypt(\''. $Password .'\',\'index!secure$key\'),
			\''. $Mail .'\',
			Now(),
			1)';
			echo $Query;
			mysql_query($Query,$DBConn);
			mysql_close($DBConn);
			header('Location:index.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title><?php echo $ApplicationName; ?></title>
<link rel="stylesheet" href="CSS/Style.css" type="text/css" />
<link rel="stylesheet" href="CSS/user.css" type="text/css" />
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
	    		<h2>Nuevo Usuario:</h2>
		        <form method="post" action="NewUser.php">
		                	<label for="tbFirstName">Nombre:</label>
		                    <input type="text" class="TextBox" name="tbFirstName" id="tbFirstName" value="<?php echo Value('tbFirstName','P');?>" autofocus required/>
		                	<label for="tbLastName">Apellido:</label>
		                   	<input type="text" class="TextBox" name="tbLastName" id="tbLastName" value="<?php echo Value('tbLastName','P');?>" required/>
		                	<label for="tbUser">Usuario:</label>
		                   	<input type="text" class="TextBox" name="tbUser" id="tbUser" value="<?php echo Value('tbUser','P');?>" required/>
		                	<label for="tbPassword">Contraseña:</label>
		                   	<input type="password" class="TextBox" name="tbPassword" id="tbPassword" value="<?php echo Value('tbPassword','P');?>" required/>
		                	<label for="tbPassword2">Verifica Contraseña:</label>
							<input type="password" class="TextBox" name="tbPassword2" id="tbPassword2" value="<?php echo Value('tbPassword2','P');?>" required/>
		                	<label for="tbMail">E-Mail:</label>
		                   	<input type="text" class="TextBox" name="tbMail" id="tbMail" value="<?php echo Value('tbMail','P');?>" required/>
							<input type="submit" name="btnSaveUser" id="btnSaveUser" value="Enviar" />
							<p id="Error">
								<?php if(isset($Error)) { echo $Error;} ?>
							</p>
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