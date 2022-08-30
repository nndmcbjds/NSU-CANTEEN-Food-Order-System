<?php

include('../config/constants.php');
 // get the id of the admin  
$id=$_GET['id'];
 //Create SQL qurey to delete admin
 $sql = "DELETE FROM tbl_admin WHERE id=$id";
 
 
 //excute query
$res=mysqli_query($conn,$sql);

//Redirect to manage admin page with message(success/error)
//Check whether the query executed successfully or not

if($res == TRUE)
{
    //Query Excuted successfully and Admin Deleted
//Create Session variable to display message
$_SESSION['delete'] = "<div class='sucess'>Admin Deleted Successfully.</div>";
//Redirect to manage admin page 
header('location:'.SITEURL.'admin/manage-admin.php');

}
else{
   // Falied to delte admin";
   $_SESSION['delete'] = "<div class = 'fail'> Failed to Admin Delete.Try Again Later . </div>";
   header('location:'.SITEURL.'admin/manage-admin.php');
   
}
?>