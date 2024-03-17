<!DOCTYPE html>
<html class="no-js">
    <head>



  

   <center> <h1 >KOFFIE CHALET</h1></center>

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

    $query1 = mysqli_query( $con, "delete from koffiechalet_menu where Starters='$del'");

}

?>
</div><?php

    if (isset($_GET['Starters'])) {
    $name = $_GET['Starters'];
    $query1 = mysqli_query($con ,"select * from koffiechalet_menu where Starters = '$starter'");
    while ($row1 = mysqli_fetch_array($query1)) 
    {
        echo "<form class='form' method='get'>";
        echo "<h2>Delete Form</h2>";
        echo "<br />";
    
        echo"<input class='input' type='text' name='starter' value='{$row1['Starters']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Main_course:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='maincourse' value='{$row1['Main_course']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Salads:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='salad' value='{$row1['Salads']}'readonly/>";
        echo "<br />";
        echo "<label>" . "Deserts:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='desert' value='{$row1['Deserts']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Drinks:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='drink' value='{$row1['Drinks']}'readonly/>";
        echo "<br />";
        echo "<br />";
        echo "</form>";
        echo "<b><a href='koffiechalet_delete.php?del={$row1['Starters']}'><input class='btn btn-danger' type='button' name='submit' value='Delete'/></a></b>"; 


    }

if (isset($_GET['Delete'])) {
echo '<div class="form" id="form3"><br><br><br><br><br><br>
<Span>Data deleted Successfuly......!!</span></div>';
header("Location:koffMenu.php");
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
       <b><a href='koffie_chaletMenu.php'>BACK TO MENU</a></b>


    </body>
</html>
