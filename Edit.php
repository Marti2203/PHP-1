
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php

include 'Base.php';
if(isset($_POST['Edit']))
{
	if(!file_exists($registrations)){ print "Error with opening registrations file."; die;}
	$handle=fopen($registrations,"r");
	$counter=0;
	while(!feof($handle)) {
		$line=fgets($handle);
		if($line!=null && $counter==$_POST['ID'])
		{
			$elements=explode("\t",$line);
			echo "<form method=\"post\" action=\"Edit.php\" enctype=\"multipart/form-data\">
				<label for=\"name\" class=\"label\">Name</label> ".$elements[0]."
				<br/>
				<label for=\"passwordOld\" class=\"label\">OLD Password</label> 
				<input type=\"password\" id=\"passwordOld\" name=\"passwordOld\" />
				<label for=\"passwordNew\" class=\"label\">New Password</label> 
				<input type=\"password\" id=\"passwordNew\" name=\"passwordNew\" />
				<div class=\"btn-group\">
				<input type=\"file\" id=\"picture\" name=\"Input Picture\" />
				<input type=\"hidden\" name=\"ID\" value=\"" .$counter."\">
				<input type=\"submit\" class=\"button\" name=\"Update\" id=\"Update\" value=\"Update\"/ >
				</form>";
		}
		$counter++;
	}
	fclose($handle);
}
if(isset($_POST['Update']))
{
	if(!file_exists($registrations)){ print "Error with opening registrations file."; die;}
	$handle=fopen($registrations,"r");
	$temp=fopen("registrations_temp.txt","w") or print "UNABLE TO CREATE TEMP FILE";
	$targetPosition=basename($_FILES["Input_Picture"]["name"]);
	$counter=0;
	$success=false;
	while(!feof($handle)) {
		$line=fgets($handle);
		if($line!=null && $counter==$_POST['ID'])
		{
			$elements=explode("\t",$line);
			if(sha1($_POST['passwordOld'])!=$elements[1]){
				print "Passwords do not match, update unsuccessful.";
				break;
			}

			fwrite($temp, $elements[0]."\t");
			fwrite($temp, sha1($_POST['passwordNew'])."\t");

			if(uploadValid($_FILES["Input_Picture"])){
				if (move_uploaded_file($_FILES["Input_Picture"]["tmp_name"], $targetPosition)){
					fwrite($temp, $_FILES['Input_Picture']["name"]);
					print "The file ". basename($_FILES["Input_Picture"]["name"]). " has been uploaded. And the user has been updated successfully.";
				}
				else
				{ 
					print "Sorry, the file was not moved. The user picture is not updated";
					fwrite($temp, $elements[2]);
					unlink($targetPosition);
				}
			}
			else {
				print "Sorry, there was an error uploading your file. The user picture is not updated.";
				fwrite($temp, $elements[2]);
			}
			$success=true;
			fwrite($temp, "\n");
		}
		else fwrite($temp,$line);		
		$counter++;
	}
	fclose($handle);
	fclose($temp);

	if($success){
		if(rename("registrations_temp.txt",$registrations))
			print "SUCCESS";
		else print "FAIL";
	}
}
?>
</body>
</html>
