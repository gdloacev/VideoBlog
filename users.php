<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/GC.php"); ?>
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
				//header('Location:index.php');
			}
			else
			{
				$LoginError = 'E002: Usuario y/o Contraseña incorrectos';
			}
		}
		else
		{
			$LoginError = 'E001: Usuario y/o Contraseña necesarios';
		}
		unset($_POST['btnLogin']);
	}
	if(isset($_REQUEST['SessionOption']) && $_REQUEST['SessionOption'] == 'Logout' )
	{
		session_destroy();
		$LoginError = 'E003: La sesion ha terminado';
		header('Location:index.php');
	}
?>
<div id="Main">
    <form id="LoginForm" method="post" action="index.php">
        <?php if(!isset($_SESSION['UserName'])) {?>
            <table>
                <tr>
                    <?php if(isset($LoginError)) { ?>
                    <td style="color:#FFFFFF;background:#FF0000;padding:3px;text-align:center;border:1px solid #FF0000;" colspan="4">
                        <?php echo $LoginError; ?>
                    </td>
                    <?php } ?>
                    <td>Usuario</td>
                    <td><input class="TextBox" id="tbUser" name="tbUser" type="text" value="<?php echo Value('tbUser','P'); ?>" /></td>
                    <td>Contraseña</td>
                    <td><input class="TextBox" id="tbPassword" name="tbPassword" type="password" /></td>
                    <td><input type="submit" name="btnLogin" id="btnLogin" value="Entrar" /></td>
                </tr>
            </table>
        <?php } else {?>
            <table>
                <tr>
                    <td>
                        Bienvenido <?php echo Value('FullName','S'); ?> 
                        <a href="login.php?SessionOption=Logout">Salir</a>
                    </td>
                </tr>
            </table>
        <?php }?>
    </form>
</div>