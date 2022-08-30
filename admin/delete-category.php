<?php

//check id and image name
include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
// echo " Deleted";

      
//get value
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

     //check img file is avilable or not
      if($image_name != "")
      {
         //img avilable
         $path = "../images/category/".$image_name;
         //remove img
         $remove = unlink($path);
         if($remove==false)
         {
            //session message
            $_SESSION['remove'] = "<div class ='fail'> Failed to remove Category Image.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
            die();//stop process
         }


      }
      $sql = "DELETE FROM tbl_category WHERE id=$id";
      $res = mysqli_query($conn, $sql);

      //check delete or not
      if($res== true)
      {
         $_SESSION['delete'] = "<div class ='sucess'> Category Image Delete Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
      }
      else
           $_SESSION['delete'] = "<div class ='fail'> Failed to Delete Category Image. Try Again Later....</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

}

else {
   
   header('location:'.SITEURL.'admin/manage-category.php');

}
?>
