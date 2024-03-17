
<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: users.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ECS ADMIN PORTAL</title>

<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="main">
	<div class="img-bg">


<br><br>
<div id="login" span style="margin-left: 700px">
<h2>Admin Login</h2>
<form action="" method="post">
	<br><br>
<br><br>
<label><span>UserName :</span></label>
<input id="name" name="username" placeholder="username" type="text">
<br><br>
<label><span>Password :</span></label>
<input id="password" name="password" placeholder="**********" type="password">
<br><br>

<br>
<input name="submit" type="submit" value=" Login ">
<span><?php echo "<script type='text/javascript'>alert('$error');</script>"; ?></span>
<br>

</form>

</div>
<br><br>
<h1 span style="color: #000000;text-align:center; background-color: #ffffff;font-size: 80px">E COMFORT SPOT</h1>
</div>
</body>
</html>