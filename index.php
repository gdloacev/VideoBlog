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
	margin: 0 310px 0 0px; /* the right margin on this div element creates the column down the right side of the page - no matter how much content the sidebar1 div contains, the column space will remain. You can remove this margin if you want the #mainContent div's text to fill the #sidebar1 space when the content in #sidebar1 ends. */
	padding: 0 20px 0 40px; /* remember that padding is the space inside the div box and margin is the space outside the div box */
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
    <h1 align="center"><img src="Images/martinmain3.png" alt="" width="760" height="257" border="0" usemap="#Map" />
<map name="Map" id="Map">
  <area shape="rect" coords="635,121,749,150" href="#" />
<area shape="rect" coords="525,121,627,150" href="videos/videoblog.htm" />
<area shape="rect" coords="360,120,512,148" href="index_other.php" />
<area shape="rect" coords="291,122,348,147" href="index.php" />
<area shape="rect" coords="584,180,743,250" href="reproductor/seleccionaalbum.htm" />
</map></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
    <h3>&nbsp;</h3>
    <h3><img src="Images/nuestromasreciente1.png" alt="" width="229" height="39" /></h3>
    <p>
      <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','280','height','186','id','FLVPlayer','src','FLVPlayer_Progressive','flashvars','&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_1&autoPlay=false&autoRewind=false','quality','high','scale','noscale','name','FLVPlayer','salign','lt','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','FLVPlayer_Progressive' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="186" id="FLVPlayer">
        <param name="movie" value="FLVPlayer_Progressive.swf" />
        <param name="salign" value="lt" />
        <param name="quality" value="high" />
        <param name="scale" value="noscale" />
        <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_1&autoPlay=false&autoRewind=false" />
        <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_1&autoPlay=false&autoRewind=false" quality="high" scale="noscale" width="280" height="186" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" />        
</object></noscript>
    </p>
    <p class="center">JOSUE Introducción 1<br />
      <a href="videos/videoblog_1_1_large.htm">Click AQUI</a> para ver en grande</p>
    <p>
      <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0','width','280','height','186','id','FLVPlayer2','src','FLVPlayer_Progressive','flashvars','&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_2&autoPlay=false&autoRewind=false','quality','high','scale','noscale','name','FLVPlayer','salign','lt','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','FLVPlayer_Progressive' ); //end AC code
      </script>
      <noscript>
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="280" height="186" id="FLVPlayer2">
        <param name="movie" value="FLVPlayer_Progressive.swf" />
        <param name="salign" value="lt" />
        <param name="quality" value="high" />
        <param name="scale" value="noscale" />
        <param name="FlashVars" value="&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_2&autoPlay=false&autoRewind=false" />
        <embed src="FLVPlayer_Progressive.swf" flashvars="&MM_ComponentVersion=1&skinName=Clear_Skin_3&streamName=videos/videoblog_1_2&autoPlay=false&autoRewind=false" quality="high" scale="noscale" width="280" height="186" name="FLVPlayer" salign="LT" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" />
        </embed>
            </object>
      </noscript>
</p>
    <p class="center">JOSUE Introducción 2<br />
      <a href="videos/videoblog_1_2_large.htm">Click AQUI</a> para ver en grande</p>
    <p align="center"><img src="Images/calendario.png" alt="" width="229" height="266" border="0" usemap="#Map2" />
<map name="Map2" id="Map2">
  <area shape="rect" coords="167,141,195,163" href="#" />
  <area shape="rect" coords="136,141,164,163" href="#" />
  <area shape="rect" coords="105,141,133,163" href="#" />
  <area shape="rect" coords="74,142,102,164" href="#" />
  <area shape="rect" coords="42,143,70,165" href="#" /><area shape="rect" coords="134,115,163,135" href="#" /><area shape="rect" coords="165,116,192,134" href="#" /><area shape="rect" coords="196,114,221,133" href="#" /><area shape="rect" coords="10,143,38,165" href="#" /></map>
    </p>
    <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
  <!-- end #sidebar1 --></div>
  <div id="mainContent">
    <p>
      <?php 
				require("login.php");
				require("messages.php");
			?>
      
    </p>
    <!-- end #mainContent --></div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
  <div id="footer">
    <p>Copyright &copy; 2009. Todos los derechos reservados. Martin Valverde.</p>
    <!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
