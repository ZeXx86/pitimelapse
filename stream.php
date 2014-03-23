<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PiTimelapse</title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#000000" background="img/mainbkg.gif" link="#FFFFFF" vlink="#FFFFFF" alink="#FF0000">

<?php
	$stream_addr = $_SERVER['HTTP_HOST'];
	
	if (strchr ($stream_addr, ":")) {
		$str = explode (":", $stream_addr);
		
		$stream_addr = $str[0];
	}
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/topbkg.gif">
  <tr>
    <td width="50%"><img border="0" src="img/topleft.gif" width="209" height="61"></td>
    <td width="50%">
      <p align="right">Status <br /><img src="<?php $ret = 0; system ("pitimelapse/status.sh", $ret); if ($ret == 0) echo "img/icon-on.png"; else echo "img/icon-off.png"; ?>" width="42px"></td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/linebkg.gif">
  <tr>
    <td width="100%"><font face="Arial" size="2" color="#FFFFFF"><b>&nbsp;&nbsp;
      <a style="text-decoration: none" href="index.php">ABOUT</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none; color: #FF0000" href="stream.php">STREAM</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none" href="list.php">TIMELAPSE</a>&nbsp;&nbsp; |&nbsp;&nbsp;
      <a style="text-decoration: none" href="config.php">CONFIGURATION</a></b></font></td>
  </tr>
</table>
<p style="margin-left: 20"><font size="5" color="#B09000">Live stream</font></p>
<p style="margin-left: 20"><font color="#FFFFFF">MJPEG format</font></p>
<p style="margin-left: 20"><img src="http://<?php echo $stream_addr; ?>:9000/?action=stream" /></p>
<p style="margin-left: 20"><font color="#FFFFFF">&nbsp;</font></p>
<p style="margin-left: 20"><font color="#FFFFFF">&nbsp;</font></p>
<p style="margin-left: 20"><font size="5" color="#B09000">VLC stream</font></p>
<p style="margin-left: 20"><font color="#FFFFFF">http://<?php echo $stream_addr; ?>:9000/?action=stream</font></p>
<p style="margin-left: 20"><font color="#FFFFFF">&nbsp;</font></p>
<p style="margin-left: 20" align="center"><font color="#FFFFFF" face="Arial" size="1">©
2014 Tomáš Jędrzejek</font></p>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/botbkg.gif">
  <tr>
    <td width="100%"><img border="0" src="img/botbkg.gif" width="38" height="13"></td>
  </tr>
</table>

</body>

</html>
