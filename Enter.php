<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
include 'Base.php';

if(isset($_POST['Register'])){
	if(uploadValid($_FILES["Input_Picture"])){
		$handle=fopen($registrations,"a+") or print "UNABLE TO OPEN REGISTRATIONS FILE";
		if (move_uploaded_file($_FILES["Input_Picture"]["tmp_name"], basename($_FILES["Input_Picture"]["name"]))){
			fwrite($handle, $_POST['name']."\t");
			fwrite($handle, sha1($_POST['password'])."\t");
			fwrite($handle, $_FILES['Input_Picture']["name"]);
			fwrite($handle, "\n");
			print "The file ". basename($_FILES["Input_Picture"]["name"]). " has been uploaded. And the user has been created successfully.";

		}
		else
		{ 
			print "Sorry, the file was not moved. The user is not created";
			unlink($targetPosition);
		}
		fclose($handle);
	}
	else print "Sorry, there was an error uploading your file. The user is not created";
}

if(isset($_POST['Sign_in'])){
	$handle=fopen($registrations,"r") or print "UNABLE TO OPEN FILE";
	$found=false;
	while(! (feof($handle) || $found) ) {
		$line=fgets($handle);
		if($line!=null)
		{
			$elements=explode("\t",$line);
			if($elements[0]===$_POST['name'] && sha1($_POST['password'])===$elements[1])
			{	
				print $elements[0]."\t".$elements[2]."\n";
				echo "<img src=\"".$elements[2]."\" alt=Error>";
				$found=true;
			}
		}
	}
	if(!$found) print "User not found. Wrong password or user name.";
	fclose($handle);
}

?>
</body>
</html>


