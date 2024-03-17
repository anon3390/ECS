<!DOCTYPE html>
<html class="no-js">
    <head>
     

   <center> <h1 >KOFFIE CHALET</h1></center>

  
        <div class="container-fluid">
    
        <div class ="main">
            <br>
            <br>

<?php

include("conn.php");

if (isset($_GET['submit'])) 
{
    
        $starter = $_GET['starter'];
        $maincourse = $_GET['maincourse'];
        $salad = $_GET['salad'];
        $desert = $_GET['desert'];
        $drink = $_GET['drink'];
        
    $query = mysqli_query($con , "update koffiechalet_menu set Main_course ='$maincourse',
    Salads = '$salad',Deserts='$desert',Drinks='$drink' where Starters = '$starter'");
}

?>
<?php
if (isset($_GET['update'])) {
    $update = $_GET['update'];
    $query1 = mysqli_query($con ,"select * from koffiechalet_menu where Starters= '$update'");
    while ($row1 = mysqli_fetch_array($query1)) 
    {
        echo "<form class='form' method='get'>";
        echo "<h2>Update Form</h2>";
        echo "<br />";
        echo"<input class='input' type='text' name='starter' value='{$row1['Starters']}' readonly/>";
        echo "<br />";
        echo "<label>" . "Main_course:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='maincourse' value='{$row1['Main_course']}' />";
        echo "<br />";
        echo "<label>" . "Salads:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='salad' value='{$row1['Salads']}'/>";
        echo "<br />";
        echo "<label>" . "Deserts:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='desert' value='{$row1['Deserts']}' />";
        echo "<br />";
        echo "<label>" . "Drinks:" . "</label>" . "<br />";
        echo"<input class='input' type='text' name='drink' value='{$row1['Drinks']}' />";
        echo "<br />";
        echo "<br />";
        echo "<input class='submit' type='submit' name='submit' value='change ' />";
        echo "</form>";

    }
}

if (isset($_GET['submit'])) {
echo '<div class="form" id="form3"><br><br><br><br><br><br>
<Span>Data Updated Successfuly......!!</span></div>';
header("Location:koffiechalet_menu.php");
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
