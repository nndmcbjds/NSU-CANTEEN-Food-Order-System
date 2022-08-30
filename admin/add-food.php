<?php include('partials/menu.php');?>

<div class ="main-content">
<div class= "wrapper">
    <h1>Add  Food</h1>
    <br><br>
<?php
    if(isset($_SESSION['upload']))//checking the session work or not
    {
        echo $_SESSION['upload']; //Display session message
        unset($_SESSION['upload']); //Removing session message
    }
    ?>
    <form action="" method="post" enctype = "multipart/form-data">


    <table class ="tbl-30">

    <tr>

    <td>Title: </td>
    <td>
        <input type="text" name="title" placeholder = "Enter Your Food Title ">
    </td>
    </tr>
    <tr>
    <td>Description: </td>
    <td>
        <textarea name="description" cols="30" rows="5" placeholder = "Enter Your Food description. "></textarea>
    </td>
    </tr>
    <tr>

    <td>Price:</td>
    <td>
        <input type="number" name ="price">
    </td>
    </tr>
    <tr>
        <td>Select Image:</td>
        <td>
            <input type="file" name="image">
        </td>
        </tr>


        <tr>
            <td>Category:</td>
            <td>
                <select name="category">
                    <?php
                     $sql="SELECT * FROM tbl_category WHERE active='yes'";

                        $res = mysqli_query($conn, $sql);
                         $count = mysqli_num_rows($res);

                       if($count>0)
                        {
                          while($row=mysqli_fetch_assoc($res))
                         {
                             $id=$row['id'];
                             $title=$row['title'];
                    ?>

                        <option value="<?php echo $id;?>"><?php echo $title; ?></option>
                  <?php
                           }
                         }
                     else{
                     ?>
                         <option value="0">No category Found.</option>
                   <?php
                         }

                     ?>
                    
                </select>
            </td>
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
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
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
        if(isset($_FILES['image']['name']))
                {
                    //upload image
                   $image_name = $_FILES['image']['name'];


                    // rename image
                    // empty image
                    if($image_name != "")
                    {

                    $ext = end(explode('.',$image_name));
                    $image_name = "food_Image_".rand(0000,9999).'.'.$ext;                  

                    $source_path =$_FILES['image']['tmp_name'];
                    $destination_path= "../images/food/".$image_name;


                    // up fun
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check image up

                    if($upload==false)
                    {
                        $_SESSION['upload'] ="<div class='fail'> Failed To upload Image .</div>";
                        header('location:'.SITEURL.'admin/manage-food.php');

                        die();
                    }

                }
            }

            else {
                //dont up
                $image_name="";
            }
            $sql2="INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name='$image_name',
            category_id = $category,
            featured = '$featured',
        active = '$active'
            ";

$res2=mysqli_query($conn, $sql2);
if($res2==true){
  
    $_SESSION['add'] ="<div class='sucess'> Category Added Successfully.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    $_SESSION['add'] ="<div class='fail'> Category Added Failed.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

}

?>

</div>
</div>



<?php include('partials/footer.php');?>