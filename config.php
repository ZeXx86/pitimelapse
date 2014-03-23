<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PiTimelapse</title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#000000" background="img/mainbkg.gif" link="#FFFFFF" vlink="#FFFFFF" alink="#FF0000">

<?php 
	$sh_out = "";
	
	if (isset ($_POST['start'])) {
		exec ("pitimelapse/start.sh", $sh_out);
	} else	
	if (isset ($_POST['stop'])) {
		exec ("pitimelapse/stop.sh", $sh_out);
	} else
	if (isset ($_POST['restart'])) {
		exec ("pitimelapse/stop.sh && pitimelapse/start.sh", $sh_out);
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
      <a style="text-decoration: none" href="index.php">ABOUT</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none" href="stream.php">STREAM</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none" href="list.php">TIMELAPSE</a>&nbsp;&nbsp; |&nbsp;&nbsp;
      <a style="text-decoration: none; color: #FF0000" href="config.php">CONFIGURATION</a></b></font></td>
  </tr>
</table>
<p style="margin-left: 20"><font size="5" color="#B09000">PiTimelapse configuration</font></p>

<?php
	$config_file = "pitimelapse/timelapse.conf";

	if (isset ($_POST['submit'])) {
		$config_data = "# Konfiguracni program pro pitimelapse\n\n
INTERVAL=".$_POST['INTERVAL']."
STREAM=".$_POST['STREAM']."
STORAGE=".$_POST['STORAGE']."
TIMETOLIVE=".$_POST['TIMETOLIVE']."
RESOLUTION_X=".$_POST['RESOLUTION_X']."
RESOLUTION_Y=".$_POST['RESOLUTION_Y']."
FPS=".$_POST['FPS']."
IMGDESC=".$_POST['IMGDESC']."\n";
	
		$fp = fopen ($config_file, 'w') or die ("can't open file");
		fwrite ($fp, $config_data);
		fclose ($fp);
	}

	foreach (file($config_file) as $line) {
		if ($line[0] == '#' || strlen ($line) < 2)
			continue;
			
		$line = strtr ($line, array ('=' => ' '));
		list ($var, $val) = sscanf ($line, "%s %s");

		${$var} = $val;
		
		//echo "$var = $val<br/>";
	}
?>
	
	<form action="config.php" method="post">
	<p style="margin-left: 20"><font color="#FFFFFF">
	Timelapse interval: <input type="number" min="1" max="86400" step="1" value="<?php echo $INTERVAL; ?>" name="INTERVAL"> [seconds]<br />
	Delete older images than: <input type="number" min="1" max="44640" step="1" value="<?php echo $TIMETOLIVE; ?>" name="TIMETOLIVE"> [minutes]<br />
	Image resolution: <input type="number" min="64" max="2592" step="1" value="<?php echo $RESOLUTION_X; ?>" name="RESOLUTION_X">*<input type="number" min="64" max="1944" step="1" value="<?php echo $RESOLUTION_Y; ?>" name="RESOLUTION_Y">px<br />
	Image description: <input type="text" value="<?php echo $IMGDESC; ?>" name="IMGDESC"><br />
	Video FPS: <input type="number" min="1" max="400" step="1" value="<?php echo $FPS; ?>" name="FPS"><br />
	<br />
	Stream directory: <input type="text" value="<?php echo $STREAM; ?>" name="STREAM"><br />
	Timelapse directory: <input type="text" value="<?php echo $STORAGE; ?>" name="STORAGE"><br />
	<br />
	<input type="submit" name="submit" />
	</font></p>
	</form>

	<br />
	<p style="margin-left: 20"><font size="5" color="#B09000">PiTimelapse process</font></p>
	
<?php
	$start = isset ($_POST['start']);
	$stop = isset ($_POST['stop']);
	$restart = isset ($_POST['restart']);
	
	if ($start || $stop || $restart)
		echo "<p style=\"margin-left: 20\"><font color=\"#FFFFFF\">Status:<br /><textarea name=\"status\" cols=\"40\" rows=\"6\">";
	
	echo implode ("\n", $sh_out);
	
	if ($start || $stop || $restart)
		echo "</textarea></font></p>";
?>
	
	<form action="config.php" method="post">
	<p style="margin-left: 20"><font color="#FFFFFF">
	
	<input type="submit" value="Start" name="start" />
	<input type="submit" value="Stop" name="stop" />
	<input type="submit" value="Restart" name="restart" />
	
	</font></p>
	</form>
	
<p style="margin-left: 20" align="center"><font color="#FFFFFF" face="Arial" size="1">©
2014 Tomáš Jędrzejek</font></p>
<table border="0" width="100%" cellspacing="0" cellpadding="0" background="img/botbkg.gif">
  <tr>
    <td width="100%"><img border="0" src="img/botbkg.gif" width="38" height="13"></td>
  </tr>
</table>

</body>

</html>