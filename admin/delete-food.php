<?php


include('../config/constants.php');


if(isset($_GET['id']) AND isset($_GET['image_name']))
{
// echo " Deleted";

      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      if($image_name != "")
      {
         $path = "../images/food/".$image_name;
         $remove=unlink($path);
         if($remove==false)
         {
            $_SESSION['remove'] = "<div class ='fail'> Failed to remove FOOD Image.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
         }


      }
      $sql = "DELETE FROM tbl_food WHERE id=$id";
      $res = mysqli_query($conn, $sql);

      if($res== true)
      {
         $_SESSION['delete'] = "<div class ='sucess'> FOOD  Delete Successfully.</div>";
         header('location:'.SITEURL.'admin/manage-food.php');
      }
      else
      $_SESSION['delete'] = "<div class ='fail'> Failed to Delete FOOD . Try Again Later....</div>";
      header('location:'.SITEURL.'admin/manage-food.php');

}

else {
   
    header('location:'.SITEURL.'admin/manage-food.php');

}
?>
