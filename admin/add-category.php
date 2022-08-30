<?php include('partials/menu.php');?>
<div class ="main-content">
<div class= "wrapper">
  <h1>Add Category</h1>


  <br><br>
  <?php
    
    if(isset($_SESSION['add']))//checking the session work or not
    {
        echo $_SESSION['add']; //Display session message
        unset($_SESSION['add']); //Removing session message
    }
    if(isset($_SESSION['upload']))//checking the session work or not
    {
        echo $_SESSION['upload']; //Display session message
        unset($_SESSION['upload']); //Removing session message
    }
    
    ?>
  <form action=""method="POST" enctype ="multipart/form-data">

<table class="tbl-30">
<tr>
    <td>Title:</td>
    <td><input type="text" name="title" placeholder="Category Title"></td>
</tr>


<tr>
    <td>Select Image:</td>
    <td><input type="file" name="image"></td>
</tr>
<tr>
    <td>Featured:</td>
    <td><input type="radio" name="featured" value ="Yes">Yes
    <input type="radio" name="featured" value ="No">No

</td>

</tr>

<tr>
    <td>Active:</td>
    <td><input type="radio" name="active" value ="Yes">Yes
    <input type="radio" name="active" value ="No">No

</td>

</tr>
<tr>
    <td colspan="2">
    <input type="submit" name="submit"value="Add Category" class="btn-sec">
</tr>

</table>  
</form> 


<?php
if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
        else
        {
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];

        }
        else
        {
            $active ="No";
        }
              //  print_r($_FILES['image']);
                //die();

                if(isset($_FILES['image']['name']))
                {
                    //upload image
                   $image_name = $_FILES['image']['name'];

                    // auto rename image
                   
                    // empty image
                    if($image_name != "")
                    {
                    //get extension jpg, ,png, etc
                    $ext = end(explode('.',$image_name));
                    //rename 
                    $image_name = "food_category_".rand(0000,9999).'.'.$ext;                  

                    $source_path =$_FILES['image']['tmp_name'];
                    $destination_path= "../images/category/".$image_name;


                    // can upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check image up

                    if($upload==false)
                    {
                        $_SESSION['upload'] ="<div class='fail'> Failed To upload Image .</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');

                        die();
                    }

                }
            }

            else {
                //dont upload image
                 $image_name="";
            }
            
        $sql = "INSERT INTO tbl_category SET
        title ='$title',
        image_name= '$image_name',
        featured = '$featured',
        active = '$active'

        ";

         $res=mysqli_query($conn, $sql);
         if($res==true){
  
                $_SESSION['add'] ="<div class='sucess'> Category Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
             }
            else
               {
                $_SESSION['add'] ="<div class='fail'> Category Added Failed.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                }

}
?>
</div> 
</div>
<?php include('partials/footer.php');?>

