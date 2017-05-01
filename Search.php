<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
include 'Base.php';
if(!file_exists($registrations)){print "UNABLE TO OPEN FILE"; die;}
	$handle=fopen($registrations,"r");
	$found=false;
	while(!feof($handle) && !$found) {
		$line=fgets($handle);
		if($line!=null)
		{
			$elements=explode("\t",$line);
			if($elements[0]===$_POST['Name'])
			{	
				print $elements[0];
				echo "<img src=\"".$elements[2]."\">";
				$found=true;
			}
		}
	}
	if(!found) print "NO Such User";
?>
</body>
</html>


