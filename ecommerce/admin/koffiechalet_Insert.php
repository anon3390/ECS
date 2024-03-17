<!DOCTYPE html>
<html class="no-js">
    <head>


  

   <center> <h1 >KOFFIE</h1></center>

    <div class="container-fluid">
    
        <div class ="main">
            <br>
            <br>
<?php

include("conn.php");
    
   
   if(isset($_POST['submit'])) {
      
        $starter = $_POST['starter1'];
        $maincourse = $_POST['maincourse1'];
        $salad = $_POST['salad1'];
        $desert = $_POST['desert1'];
        $drink = $_POST['drink1'];

        $sql ="INSERT into koffiechalet_menu (Starters,Main_course,Salads,Deserts,Drinks)
        VALUES('$starter' ,'$maincourse','$salad','$desert','$drink')";
if(mysqli_query($con, $sql))
{
    echo "Records added successfully.";
} 
else
{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}
   }
?>


<form action ="#" method = "post">
    <label>Starters  :</label> <input type = "text" name = "starter1" /><br /><br />
    <label>Main_course :</label> <input type = "text" name = "maincourse1" /><br/><br />    
    <label>Salads :</label> <input type = "text" name = "salad1" /><br/><br />  
    <label>Deserts :</label> <input type = "text" name = "desert1" /><br/><br />    
    <label>Drinks :</label> <input type = "text" name = "drink1" /><br/><br />  
    
    <input type = "submit" name = "submit" value = "Submit "/><br />
        </div>
</form>
       <br><br>
       <b><a href='koffie_chaletMenu.php'>BACK TO MENU</a></b>

    </div>

    <!--  Scripts
    ================================================== -->

    <!-- jQuery -->
    
    </body>
</html>
