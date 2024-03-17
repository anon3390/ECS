<!DOCTYPE html>
<html class="no-js">
    <head>
             <link href="css/sb-admin-2.css" rel="stylesheet">


   <center> <h1 >REPORT</h1></center>

  
            <div class="container-fluid">

        <div class ="main">
            <br>
<?php
include("conn.php");
if (isset($_GET['del'])) 
{
    $del = $_GET['del'];
    if (!$del) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

    $query1 = mysqli_query( $con, "DELETE from users where users.email='$del'");
    if ($con->query($query1) === TRUE) {
        echo "Record deleted successfully";

      } else {
        echo "Error deleting record: " . $con->error;
      }
}

?>
</div><?php

header("Location:reportrequest.php");


?>

</center>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
  
    </body>
</html>
