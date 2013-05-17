<?php require("App_Config/GC.php"); ?>
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
<title>Martin Valverde - Videoblog</title>
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
	padding: 0 20px 0 60px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
	text-align: left;
	width: 650px;
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
--> 
</style>
<!--[if IE 5]>
<style type="text/css"> 
/* place css box model fixes for IE 5* in this conditional comment */
.twoColFixRtHdr #sidebar1 { width: 220px; }
</style>
<![endif]-->
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColFixRtHdr #sidebar1 { padding-top: 30px; }
.twoColFixRtHdr #mainContent { zoom: 1; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_CheckFlashVersion(reqVerStr,msg){
  with(navigator){
    var isIE  = (appVersion.indexOf("MSIE") != -1 && userAgent.indexOf("Opera") == -1);
    var isWin = (appVersion.toLowerCase().indexOf("win") != -1);
    if (!isIE || !isWin){  
      var flashVer = -1;
      if (plugins && plugins.length > 0){
        var desc = plugins["Shockwave Flash"] ? plugins["Shockwave Flash"].description : "";
        desc = plugins["Shockwave Flash 2.0"] ? plugins["Shockwave Flash 2.0"].description : desc;
        if (desc == "") flashVer = -1;
        else{
          var descArr = desc.split(" ");
          var tempArrMajor = descArr[2].split(".");
          var verMajor = tempArrMajor[0];
          var tempArrMinor = (descArr[3] != "") ? descArr[3].split("r") : descArr[4].split("r");
          var verMinor = (tempArrMinor[1] > 0) ? tempArrMinor[1] : 0;
          flashVer =  parseFloat(verMajor + "." + verMinor);
        }
      }
      // WebTV has Flash Player 4 or lower -- too low for video
      else if (userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 4.0;

      var verArr = reqVerStr.split(",");
      var reqVer = parseFloat(verArr[0] + "." + verArr[2]);
  
      if (flashVer < reqVer){
        if (confirm(msg))
          window.location = "http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash";
      }
    }
  } 
}
</script>
<link rel="stylesheet" type="text/css" href="CSS/lightwindow.css" />
<!--<link rel="stylesheet" type="text/css" href="CSS/default.css" />-->

<!-- JavaScript -->
<script type="text/javascript" src="javascript/prototype.js"></script>
<script type="text/javascript" src="javascript/effects.js"></script>
<script type="text/javascript" src="javascript/lightwindow.js"></script>
</head>

<body class="twoColFixRtHdr" onload="MM_CheckFlashVersion('8,0,0,0','Content on this page requires a newer version of Adobe Flash Player. Do you want to download it now?');">

<div id="container">
  <div id="header">
    <h1 align="center"><img src="Images/martinmain3.png" alt="" width="760" height="257" border="0" usemap="#MapMap" />
      <map name="MapMap" id="MapMap">
        <area shape="rect" coords="635,121,749,150" href="#" />
        <area shape="rect" coords="525,121,627,150" href="videos/videoblog.htm" />
        <area shape="rect" coords="360,120,512,148" href="index_other.php" />
        <area shape="rect" coords="291,122,348,147" href="index.php" />
        <area shape="rect" coords="584,180,743,250" href="reproductor/seleccionaalbum.htm" />
      </map>
      <map name="Map" id="Map"><area shape="rect" coords="219,161,281,192" href="index.php" />
<area shape="rect" coords="291,162,348,187" href="#" /><area shape="rect" coords="360,160,512,188" href="#" /><area shape="rect" coords="525,161,627,190" href="#" /><area shape="rect" coords="635,161,749,190" href="#" /></map></h1>
  <!-- end #header --></div>
  <div id="mainContent">
    <p>
    <?php 
				require("login.php");
				require("messages_2.php");
			?>
      <!-- end #mainContent -->     	
    </p>
  </div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p>Copyright &copy; 2009. Todos los derechos reservados. Martin Valverde.</p>
    <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
