<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php 
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(isset($_POST['btnLogin']))
	{
		if(isset($_POST['tbUser']) && $_POST['tbUser'] <> '' and isset($_POST['tbPassword']) && $_POST['tbPassword'] <> '')
		{
			$Security = new Index();
			if ($Security -> ValidateUser($_POST['tbUser'],$_POST['tbPassword']))
			{
				$_SESSION['UserName'] = $Security -> UserName;
				$_SESSION['FullName'] = $Security -> FullName;
				$_SESSION['Mail'] = $Security -> Mail;
				$_SESSION['Status'] = $Security -> Status;
				$_SESSION['UserId'] = $Security -> UserID;
				//header('Location:index.php');
			}
			else
			{
				$LoginError = 'Usuario y/o Contraseña incorrectos';
			}
		}
		else
		{
			$LoginError = 'Usuario y/o Contraseña necesarios';
		}
	}
	if(isset($_REQUEST['SessionOption']) && $_REQUEST['SessionOption'] == 'Logout' )
	{
		session_destroy();
		$LoginError = 'E003: La sesion ha terminado';
		header('Location:index.php');
	}
?>

        <?php if(!isset($_SESSION['UserName'])) {?>
       	    <form id="loginForm" method="post" action="index.php">
                    <label for="tbUser">Usuario:</label>
                    <input class="TextBox" id="tbUser" name="tbUser" type="text" placeholder="Nombre de Usuario" required autofocus value="<?php echo Value('tbUser','P'); ?>" />
                    <br/>
                    <label for="tbPassword">Contraseña:</label>
                    <input type="password" class="TextBox" id="tbPassword" name="tbPassword" placeholder="Contraseña" autocomplete="off" required/>
                    <br/>
                    <input type="submit" name="btnLogin" id="btnLogin" value="Accesar" />
                    <br/>
                	<a href="NewUser.php">¿No eres usuario?... Registrate</a>
                	<?php if(isset($LoginError)) { ?>
	                	<div id="dialog-message" title="Acceso Denegado">
                    		<p id="Error"><?php echo $LoginError; ?></p>
						</div>
			</form>
                    <?php } ?>
        <?php } else {?>
                <article id="info_usuario">
	                <p>Bienvenido <strong><?php echo Value('FullName','S'); ?></strong></p>
	                <?php if($_SESSION['UserName'] == "admin") { ?>
		                <section>
		                	<ul>
		                		<li><a href="NewThread.php">Nueva Discución</a></li>
		                		<li><a href="login.php?SessionOption=Logout">Cerrar Sesión</a></li>
		                	</ul>
		                </section>
					<?php } else {?>
		                <section>
		                	<ul>
		                		<li><a href="login.php?SessionOption=Logout">Cerrar Sesión</a></li>
		                	</ul>
		                </section>
					<?php }?>
	            </article>
        <?php }?>