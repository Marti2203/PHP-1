<!DOCTYPE html>
<html>
<head> 
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<form method="post" action="Enter.php" enctype="multipart/form-data">
<label for="name" class="label">Name</label>
<input type="text" id="name" name="name"/>
<br/>
<label for="password" class="label">Password</label>
<input type="password" id="password" name="password" />
<div class="btn-group">
<input type="file" id="picture" name="Input Picture" />
<input type="submit" class="button" name="Sign in" id="Sign in" value="Sign in" />
<input type="submit" class="button" name="Register" id="Register" value="Register" />
</form>
<br/><br><br>
<form method="get" action="List.php">
<input type="submit" class="button" value="List All" />
</form>
<form method="post" action="Search.php">
<label for="Name" class="label">Search By Name</label>
<input type="text" id="Name" name="Name"/>
<input type="submit" class="button" name="Search" id="Search" value="Search" />
</form>
</div>
</body>
</html>
