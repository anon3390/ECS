
<?php
$connection = mysql_connect("localhost", "root", "");
$db = mysql_select_db("ecomm", $connection);
session_start();
$user_check=$_SESSION['login_user'];
$ses_sql=mysql_query("select username from admin where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session =$row['username'];
if(!isset($login_session)){
mysqli_close($connection); 
header('Location: index.php'); }
?>