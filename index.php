<?php require("App_Config/GC.php"); ?>
<?php 
	if(!isset($_SESSION)) 
	{
		session_start();
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<title><?php echo $ApplicationName; ?></title>
<link rel="stylesheet" type="text/css" href="CSS/Style.css" />
<link rel="stylesheet" type="text/css" href="CSS/login.css" />
<link rel="stylesheet" type="text/css" href="CSS/messages.css" />
<link rel="stylesheet" type="text/css" href="CSS/lightwindow.css" />
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
  <section id="mainContent">
    <article id="login">
      <?php 
        require("login.php");
      ?>
    </article>
    <article id="messages">
      <?php 
        require("messages.php");
      ?>
    </article>
  </section>
  <footer>
    <small>Copyright &copy; 2013. Todos los derechos reservados. Oscar Aceves.</small>
  </footer>
  <!-- JavaScript -->

  <script src="Scripts/prefixfree.min.js"></script>
  <script src="Scripts/jquery-2.0.0.js"></script>
  <script src="Scripts/prototype.js"></script>
  <script src="Scripts/effects.js"></script>
  <script src="Scripts/lightwindow.js"></script>
  <script src="Scripts/codigito.js"></script>
</body>
</html>
