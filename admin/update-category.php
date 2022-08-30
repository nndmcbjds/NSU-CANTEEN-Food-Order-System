<?php include('partials/menu.php');?>

<div class ="main-content">
<div class= "wrapper">

    <h1>Update Category</h1>

    <br>
    <br><br>

    <?php
        if(isset($_GET['id']))
        {
                //echo "get data";
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-cat-found'] = "<div class ='fail'> Category Not found</div>";
                    header('location:'.SITEURL.'admin/mange-category.php');
                }
        }

        else
        {
            header('location:'.SITEURL.'admin/mange-category.php');
        }
    ?>
<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">

    <tr>
        <td> Title:</td>
        <td>
            <input type="text" name ="title" value="<?php echo $title ?> ">
        </td>
    </tr>

     <tr>
         <td>Current Image:</td>
         <td>
            <?php
            if($current_image != "")
            {
                            // displaying image
                            ?>
                             <img src=" <?php echo SITEURL;?>images/category/<?php echo $current_image; ?> "width ="100px" >
                               
                            <?php

            }
            else
            {
                        echo "<div class = 'fail'>Image Not Added.</div>";
            }
            ?>
         </td>
     </tr>
     <tr>
        

     </tr>

     <tr>
    <td>Select Image:</td>
    <td>
        <input type="file" name="image">
    </td>
    </tr>

     <tr>
    <td>Featured:</td>
    <td><input <?php if($featured=="Yes") {echo"checked";} ?> type="radio" name="featured" value ="Yes">Yes
    <input <?php if($featured=="No") {echo"checked";} ?> type="radio" name="featured" value ="No">No

</td>

</tr>

<tr>
    <td>Active:</td>
    <td><input <?php if($active=="Yes") {echo"checked";} ?> type="radio" name="active" value ="Yes">Yes
    <input <?php if($active=="No") {echo"checked";} ?> type="radio" name="active" value ="No">No

</td>

</tr>
<tr>
    <td>
        <input type="hidden" name="current_image" vaule="<?php echo $current_image; ?> ">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="submit" name="submit"value="Add Category" class="btn-sec">
</tr>

    </table>
    </form>
    <?php

    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $title=$_POST['title'];
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        ///--------------

        if(isset($_FILES['image']['name']))
        {
            //upload image
           $image_name = $_FILES['image']['name'];
    
    
            // rename image
            // empty image
            if($image_name != "")
            {
    
            $ext = end(explode('.',$image_name));
            $image_name = "food_category_".rand(0000,9999).'.'.$ext;                     
    
            $source_path =$_FILES['image']['tmp_name'];
                    $destination_path= "../images/category/".$image_name;
    
    
            // up fun
            $upload = move_uploaded_file($source_path, $destination_path);
    
            //check image up
    
            if($upload==false)
            {
                $_SESSION['upload'] ="<div class='fail'> Failed To upload Image .</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
    
                die();
            }
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
     
                            if($remove==false)
                            {
                                $_SESSION['remove'] = "<div class='fail'> Failed to Remove Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                          die();
                            }
                        }
                    }
                    else {
                        $image_name = $current_image;
                    }
     
    }
     
        //------------



        $sql2 = "UPDATE tbl_category SET
        title='$title',
        image_name='$image_name',
        featured= '$featured',
        active= '$active'
        WHERE id=$id
        ";
        $res2=mysqli_query($conn, $sql2);


        if($res==true)
        {
            $_SESSION['update'] = "<div class='sucess'> Category Update Sucessfully.</div>"; 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='fail'> Category Updated Failed.</div>"; 
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }

?>
    </div>


</div>



<?php include('partials/footer.php');?>