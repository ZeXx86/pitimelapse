<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>PiTimelapse</title>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginheight="0" marginwidth="0" bgcolor="#000000" background="img/mainbkg.gif" link="#FFFFFF" vlink="#FFFFFF" alink="#FF0000">

<?php
	$img_cnt = 0;
	$dir = new DirectoryIterator ('./timelapse');
	
	$format = "jpg";
		
	$files = array ();
		
	foreach ($dir as $fileinfo) {
		$name = $fileinfo->getFilename ();
	
		if ($name != "." && $name != ".." && !strchr ($name, "~") && strstr ($name, ".$format")) {
			$files[$fileinfo->getMTime()] = $name;
			$img_cnt ++;
		}
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
      <a style="text-decoration: none" href="index.php">ABOUT</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none" href="stream.php">STREAM</a>&nbsp;&nbsp; |&nbsp;&nbsp; <a style="text-decoration: none; color: #FF0000" href="list.php">TIMELAPSE</a>&nbsp;&nbsp; |&nbsp;&nbsp;
      <a style="text-decoration: none" href="config.php">CONFIGURATION</a></b></font></td>
  </tr>
</table>
<p style="margin-left: 20"><font size="5" color="#B09000">Timelapse gallery</font></p>
<p style="margin-left: 20"><font color="#FFFFFF">Image list (<?php echo $img_cnt; ?>)</font></p>    
	<form action="list.php" method="post">
		<p style="margin-left: 20">
		<font color="#FFFFFF">Select each <input type="number" min="1" max="1000" step="1" value="<?php $tickmod = $_POST['tickmod']; if ($tickmod < 1) $tickmod = 1; echo "$tickmod"; ?>" name="tickmod">. image</font><br />
		<font color="#FFFFFF">Start with <input type="number" min="1" max="1000" step="1" value="<?php $imgfirst = $_POST['imgfirst']; if ($imgfirst < 1) $imgfirst = 1; echo "$imgfirst"; ?>" name="imgfirst">. image</font><br />
		<font color="#FFFFFF">End with <input type="number" min="1" max="10000000" step="1" value="<?php $imglast = $_POST['imglast']; if ($imglast < 1 || $imglast > $img_cnt) $imglast = $img_cnt; echo "$imglast"; ?>" name="imglast">. image</font><br />
		<input type="submit" value="Select" /></p>
	</form>
	
	<br />
	
	<form action="generate.php" method="post">
	
	<p style="margin-left: 20">  
	<?php
		ksort ($files);
	
		$i = 0;
	
		echo "<table border=1><tr>";
	
		foreach ($files as $entry) {

			$checked = "";
			if ($i >= $imgfirst-1 && $i < $imglast)
			if (($i % $tickmod) == 0)
				$checked = "checked=true";
		
			echo "<td>		
			<font color=green>".($i+1)." : </font><input type=\"checkbox\" $checked name=\"listmultiple[]\" value=\"$entry\"><font color=\"#FFFFFF\"><a href=\"timelapse/$entry\" title=\"$entry\">$entry</a></font></input></td>";
			
			$i ++;
			
			if (($i % 4) == 0)
				echo "<tr></tr>";
		}
		
		echo "</table>";
	?>
	<br />
	<input type="submit" value="Generate" />
	<input type="reset" value="Reset" />
	</p>
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