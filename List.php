<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php	
$registrations="registrations.txt";
if(!file_exists($registrations)){ print "No registrations"; die;}
$handle=fopen($registrations,"r")  ;
	$counter=0;
	while(!feof($handle)) {
		$line=fgets($handle);
		if($line!=null)
		{
			$elements=explode("\t",$line);
			print $elements[0]."\t".$elements[1];
			echo "<img src=\"".$elements[2]."\"alt=Error>
				<form method=\"post\" action=\"Edit.php\"> 
				<input type=\"hidden\" name=\"ID\" value=" .$counter."\">
				<input type=\"submit\" class=\"button\" name=\"Edit\" id=\"Edit\" value=\"Edit\"/> 
				</form> 
				<br/> <br/>";
		}
		$counter++;
	}
	fclose($handle);

	?>
</body>
</html>
