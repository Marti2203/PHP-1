<?php
$registrations="registrations.txt";
function uploadValid($info)
{
	$targetPosition=basename($info["name"]);
	$imageFileType = pathinfo($targetPosition,PATHINFO_EXTENSION);
	$uploadOk = true;
	
    	if(getimagesize($info["tmp_name"])===false)
		$uploadOk = false;
	/* if (file_exists($targetPosition)) {
	    	print "Sorry, file already exists.";
	    	$uploadOk = false;
	} */
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	    	print "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    	$uploadOk = false;
	}
	return $uploadOk;
} ?>
