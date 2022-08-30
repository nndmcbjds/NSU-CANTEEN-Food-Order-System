<?php include('partials/menu.php');?>

<div class ="main-content">
<div class= "wrapper">
    <h1>Update Admin</h1>

    <br>
    <br>
    <?php
        //get id of seleted admin
        $id=$_GET['id'];
        //sql query
        $sql="SELECT * FROM tbl_admin WHERE id=$id";
        //excute  query 
        $res=mysqli_query($conn,$sql);
        // check 
        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
               //get the details
               //  echo"Admin Available";
              $row=mysqli_fetch_assoc($res);
              $full_name=$row['full_name'];
              $username=$row['username'];
            }
            else{ 
                //redirect to manage admin  page
                header('location'.SITEURL.'admin/manage-admin.php');
            }
        }

    ?>
<form action="" method = "POST">
    <table class="tbl-30">
<tr>
<td>FullName</td>
<td> 
    <input type="text" name="full_name" value="<?php echo $full_name; ?>">
</td>

</tr>
<tr>
    <td>UserName</td>
<td> 
    <input type="text" name="username" value="<?php echo $username; ?>">
</td>

</tr>
<tr>
    <td colspan="2">
        <input type ="hidden" name="id" value="<?php echo $id;?>">
    <input type="submit" name="submit"value="Update Admin" class="btn-sec">
</tr>
</table>


</form>

</div>
</div>
<?php
 // check button is clik or not 
 if(isset($_POST['submit']))
 {
     //echo "Button Clicked";
     //get for update
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

     // sql for update admin 

     $sql="UPDATE tbl_admin SET 
     full_name='$full_name',
     username='$username'
     WHERE id=$id";
     
     
     //excutaue qurey
     $res=mysqli_query($conn,$sql);
     // check query excutate
     if($res==TRUE)
     {
        $_SESSION['update'] = "<div class='sucess'> Update Admin  Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else{
        // "admin not delete";
        $_SESSION['update'] = "<div class = 'fail'> Failed to Admin Update.Try Again Later . </div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

 }
?>

<?php include('partials/footer.php');?>