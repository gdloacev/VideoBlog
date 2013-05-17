<?php require("App_Config/GC.php"); ?>
<?php require("App_Config/MainClass.php"); ?>
<?php require("App_Config/Functions.php"); ?>
<?php 	
	if(!isset($_SESSION))
	{
		session_start();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $ApplicationName; ?></title>
<style type="text/css"> 
<!-- 
body  {
	font: 80% Verdana, Arial, Helvetica, sans-serif;
	background: #000000;
	margin: 0; /* it's good practice to zero the margin and padding of the body element to account for differing browser defaults */
	padding: 0;
	text-align: center; /* this centers the container in IE 5* browsers. The text is then set to the left aligned default in the #container selector */
	color: #000000;
}
.twoColFixRtHdr #container {
	width: 780px;  /* using 20px less than a full 800px width allows for browser chrome and avoids a horizontal scroll bar */
	background: #000000;
	margin: 0 auto; /* the auto margins (in conjunction with a width) center the page */
	border: 1px solid #000000;
	text-align: left; /* this overrides the text-align: center on the body element. */
	background-image: url(Images/fondo-pag-doble.jpg);
	background-repeat: repeat-y;
} 
.twoColFixRtHdr #header {
	height: 260px;
} 
.twoColFixRtHdr #header h1 {
	margin: 0; /* zeroing the margin of the last element in the #header div will avoid margin collapse - an unexplainable space between divs. If the div has a border around it, this is not necessary as that also avoids the margin collapse */
	padding: 10px 0; /* using padding instead of margin will allow you to keep the element away from the edges of the div */
}
.twoColFixRtHdr #sidebar1 {
	float: right; /* since this element is floated, a width must be given */
	width: 300px;
}
.twoColFixRtHdr #mainContent {
	margin: 0 100px 0 0; /* the right margin on this div element creates the column down the right side of the page - no matter how much content the sidebar1 div contains, the column space will remain. You can remove this margin if you want the #mainContent div's text to fill the #sidebar1 space when the content in #sidebar1 ends. */
	padding: 0 20px 0 60px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
} 
.twoColFixRtHdr #footer {
	padding: 0 10px 0 20px; /* this padding matches the left alignment of the elements in the divs that appear above it. */
	background:#000000;
} 
.twoColFixRtHdr #footer p {
	margin: 0; /* zeroing the margins of the first element in the footer will avoid the possibility of margin collapse - a space between divs */
	padding: 10px 0; /* padding on this element will create space, just as the the margin would have, without the margin collapse issue */
	color: #FFFFFF;
	font-size: 9px;
	text-align: center;
}
.center {
	text-align: center;
	font-size: 12px;
}
.fltrt { /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class should be placed on a div or break element and should be the final element before the close of a container that should fully contain a float */
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
#negrita {
	font-size: 14px;
	font-weight: bold;
}
--> 
</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixRtHdr #sidebar1 { width: 220px; }
</style>
<![endif]--><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixRtHdr #sidebar1 { padding-top: 30px; }
.twoColFixRtHdr #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<link rel="stylesheet" type="text/css" href="CSS/lightwindow.css" />
<!--<link rel="stylesheet" type="text/css" href="CSS/default.css" />-->

<!-- JavaScript -->
<script type="text/javascript" src="javascript/prototype.js"></script>
<script type="text/javascript" src="javascript/effects.js"></script>
<script type="text/javascript" src="javascript/lightwindow.js"></script>
</head>

<body class="twoColFixRtHdr">

<div id="container">
  <div id="header">
    <h1 align="center"><img src="Images/martinmain3.png" alt="" width="760" height="257" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="293,120,350,149" href="index.php" />
<area shape="rect" coords="362,121,518,148" href="index_other.php" />
<area shape="rect" coords="528,119,628,148" href="videos/videoblog.htm" />
<area shape="rect" coords="642,121,747,146" href="#" /><area shape="rect" coords="589,176,747,282" href="reproductor/seleccionaalbum.htm" />
</map></h1>
  <!-- end #header --></div>
  <p>&nbsp;</p>
  <div id="mainContent">
    <?php 
				if(isset($_REQUEST['id']))
				{
					$Index = new Index(); 
					$DBConn = $Index -> ConnectDB();
					
					$Query = 
					'select
						m.id,
						u.id as \'UserId\',
						m.Message,
						concat(cast(case
							when month(m.DateFrom) = 1 then \'Enero\'
							when month(m.DateFrom) = 2 then \'Febrero\'
							when month(m.DateFrom) = 3 then \'Marzo\'
							when month(m.DateFrom) = 4 then \'Abril\'
							when month(m.DateFrom) = 5 then \'Mayo\'
							when month(m.DateFrom) = 6 then \'Junio\'
							when month(m.DateFrom) = 7 then \'Julio\'
							when month(m.DateFrom) = 8 then \'Agosto\'
							when month(m.DateFrom) = 9 then \'Septiembre\'
							when month(m.DateFrom) = 10 then \'Octubre\'
							when month(m.DateFrom) = 11 then \'Noviembre\'
							when month(m.DateFrom) = 12 then \'Diciembre\'
						end as char), \' \', day(m.DateFrom), \', \', year(m.DateFrom)) as \'Date\',
						date_format(m.DateFrom,\'%r\') as \'Time\',
						m.Title,
						concat_ws(\' \',u.FirstName,u.LastName) as \'Name\',
						t.idType
					from 
						udtthread t
						join udtmessage m
							on t.id = m.idThread
						join udtuser u
							on m.idUser = u.id
					where
						t.id = ' . $_REQUEST['id'] . '
					order by
						m.DateFrom desc';
					
					$Results = mysql_query($Query,$DBConn);
					
					if(mysql_num_rows($Results) > 0)
					{
						while($row = mysql_fetch_array($Results))
						{ ?>
            <div id="Messages">
              <div id="negrita">
                <?php 
											echo 'Asunto:' . ' <span>' . $row['Title'] . '</span><br>';
											echo 'Por:' . ' <span>' . $row['Name'] . '</span><br>';
											echo 'Fecha:' . ' <span>' . $row['Date'] . ' - ' . $row['Time'] . '</span>'; 
										?>
              </div>
              <div>
                <?php
										$row['Message']=str_replace(chr(13),"<br>",$row['Message']);
										echo $row['Message'];
									?>
              </div>
              <?php	
									$QueryImages = 
									'select 
										mi.Title,
										mi.Path
									from 
										udtmessageimages mi
										join udtmessage m 
											on mi.idMessage = m.id
									where m.id = ' . $row['id'];
									
									$DBConn2 = $Index -> ConnectDB();
									$ImageResults = mysql_query($QueryImages,$DBConn2);
									
									if(mysql_num_rows($ImageResults) > 0)
									{?>
              <div style="margin-top:14px;text-align:center;">
                <?php
											while($rowImage = mysql_fetch_array($ImageResults))
											{?>
                <a target="_blank" class="lightwindow page-options" href="Images/<?php echo $rowImage['Path'];?>"> <img style="height:25%;width:25%;" alt="<?php echo $rowImage['Title']; ?>" src="Images/<?php echo $rowImage['Path'];?>" /> </a>
                <?php } ?>
              </div>
              <?php }
									if(isset($_SESSION['UserId']) and $_SESSION['UserId'] == 1)
									{ ?>
              <div style="width:100%;margin-top:10px;text-align:right;background:#99CCFF;"> Herramientas de Usuario: <a href="MessageDelete.php?id=<?php echo $row['id'];?>">Borrar</a>, <a href="MessageEdit.php?id=<?php echo $row['id'];?>">Modificar</a> </div>
              <?php }
									if(isset($_SESSION['UserId']) and $row['idType'] = 1)
									{ ?>
              <div style="width:100%;margin-top:10px;text-align:right;background:#99CCFF;"> Herramientas de Usuario: <a href="Reply.php?id=<?php echo $_REQUEST['id'];?>">Responder</a> </div>
              <?php } ?>
            </div>
    	    <?php }
						mysql_free_result($Results);
						mysql_close($DBConn);
					}
					else
					{
						mysql_free_result($Results);
						mysql_close($DBConn);
					}
				}
				else
				{
					header('Location:index.php');
				}
			?>

	<!-- end #mainContent --></div>
	<!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p>Copyright &copy; 2009. Todos los derechos reservados. Martin Valverde.</p>
    <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
