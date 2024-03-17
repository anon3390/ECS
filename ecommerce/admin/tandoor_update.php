<!DOCTYPE html>
<html class="no-js">
    <head>
    


   <center> <h1 >TANDOOR</h1></center>
    <div class="container-fluid">
    
        <div class ="main">
            <br>
            <br>

<?php

include("conn.php");

if (isset($_GET['submit'])) 
{
    
    $myname = $_GET['name1'];
    $myprice = $_GET['price1'];
    $mydescription = $_GET['description1'];

    $query = mysqli_query($con , "update tandoor_deals set Price='$myprice',Description='$mydescription' where Name = '$myname'");
}

?>
<?php
if (isset($_GET['update'])) {
    $update = $_GET['update'];
    $query1 = mysqli_query($con ,"select * from tandoor_deals where Name = '$update'");
    while ($row1 = mysqli_fetch_array($query1)) 
    {
        echo "<form class='form' method='get'>";
        echo "<h2>Update Form</h2>";
        echo "<br />";
    
        echo"<input class='input' type='text' name='name1' value='{$row1['Name']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Price:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='price1' value='{$row1['Price']}' />";
        echo "<br />";
        echo "<label>" . "Description:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='description1' value='{$row1['Description']}' />";
        echo "<br />";
        echo "<br />";
        echo "<input class='submit' type='submit' name='submit' value='change ' />";
        echo "</form>";

    }
}

if (isset($_GET['submit'])) {
echo '<div class="form" id="form3"><br><br><br><br><br><br>
<Span>Data Updated Successfuly......!!</span></div>';
header("Location:tandoor_menu.php");
}
?>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>
    <!--  Scripts
    ================================================== -->
    </body>
</html>
