<?php include('partials/menu.php');?>
<?php
 
if (isset($_GET['id'])) {
    # code...
    $id = $_GET['id'];
 
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
 
    $res2 = mysqli_query($conn, $sql2);
 
    $row2 = mysqli_fetch_assoc($res2);
 
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
    
}
 
else
{
    header('location:'.SITEURL.'admin/manage-food.php');
}
?>
<div class ="main-content">
<div class= "wrapper">
    <h1>Update Food</h1><br>
    <br>
    <br>
    <form action="" method="POST" enctype = "multipart/form-data">
 
 
<table class ="tbl-30">
 
<tr>
 
<td>Title: </td>
<td>
    <input type="text" name="title" value="<?php echo $title; ?>">
</td>
</tr>
<tr>
<td>Description: </td>
<td>
    <textarea name="description" cols="30" rows="5" <?php echo  $description; ?>></textarea>
</td>
</tr>
<tr>
 
<td>Price:</td>
<td>
    <input type="number" name ="price" value="<?php echo $price; ?>">
</td>
</tr>
<tr>
    <td>Current Image:</td>
    <td><?php
    if ($current_image == "") {
        # code...
        echo "<div class='fail'> Image Not Available .</div>";
 
 
    }
    else
    {
        ?>
           <img src=" <?php echo SITEURL;?>images/food/<?php echo $current_image; ?> " width ="100px" >
          <?php
    }
   
    ?>
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
     $category_id=$row['id'];
     $category_title=$row['title'];
     
     //echo "<option value='$category_id'>$category_title</option>";

     ?>
     <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
    <input type="submit" name="submit"value="Add Category" class="btn-sec">
</tr>
 
            </table>
            </form>
            <?php
 
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $current_image=$_POST['current_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
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
                    if($current_image!="")
                    {
                        $remove_path = "../images/food/".$current_image;
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
 
 
 
 
    $sql3 = "UPDATE tbl_food SET
    title='$title',
    description='$description',
    price = $price,
    image_name = '$image_name',
    category_id= '$category',
    featured= '$featured',
    active= '$active'
    WHERE id=$id
    ";
    $res3=mysqli_query($conn, $sql3);
 
 
    if($res3==true)
    {
        $_SESSION['update'] = "<div class='sucess'> Food Update Sucessfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='fail'> Food Updated Failed.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
 
?>
 
 
 
</div>
</div>
<?php include('partials/footer.php');?>
 
 
 
