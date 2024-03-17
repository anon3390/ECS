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
  
   
   if(isset($_POST['submit'])) {
      
    $myname = $_POST['name1'];
    $myprice = $_POST['price1'];
    $mydescription = $_POST['description1'];
    
    $sql ="INSERT into tandoor_deals (Name,Price,Description) VALUES('$myname', '$myprice', '$mydescription')";
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
  <label>Name  :</label> <input type = "text" name = "name1" /><br /><br />
  <label>Price :</label> <input type = "text" name = "price1" /><br/><br />
  <label>Description :</label> <input type = "text" name = "description1" /><br/><br />
  
  <input type = "submit" name = "submit" value = "Submit "/><br />
    </div>
</form>


  </div>
</div>
           <br><br>
       <b><a href='tandoor_menu.php'>BACK TO MENU</a></b>


    </body>
</html>
