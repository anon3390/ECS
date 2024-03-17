<!DOCTYPE html>
<html class="no-js">
    <head>
        

   <center> <h1 >KFC</h1></center>

  
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

    $query1 = mysqli_query( $con, "delete from kfc_deals where Name='$del'");

}

?>
</div><?php

    if (isset($_GET['Name'])) {
    $name = $_GET['Name'];
    $query1 = mysqli_query($con ,"select * from kc_deals where Name = '$myname'");
    while ($row1 = mysqli_fetch_array($query1)) 
    {
        echo "<form class='form' method='get'>";
        echo "<h2>Delete Form</h2>";
        echo "<br />";
        echo "<label>" . "Name:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='name1' value='{$row1['Name']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Price:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='price1' value='{$row1['Price']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Description:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='description1' value='{$row1['Description']}' readonly/>";
        echo "<br />";
        echo "<br />";
        echo "</form>";
        echo "<b><a href='kfc_delete.php?del={$row1['Name']}'><input class='btn btn-danger' type='button' name='submit' value='Delete'/></a></b>"; 


    }

if (isset($_GET['Delete'])) {
echo '<div class="form" id="form3"><br><br><br><br><br><br>
<Span>Data deleted Successfuly......!!</span></div>';
header("Location:kfc.php");
}
}
?>

</center>

<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
   <p>DELETED!</p>

       <br><br>
       <b><a href='kfc_menu.php'>BACK TO MENU</a></b

    </body>
</html>
