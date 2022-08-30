<?php include('partials/menu.php');?>

<div class ="main-content">
<div class= "wrapper">
    <h1>Change Password</h1>
    <br>
    <br>

    <?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }
    ?>
    <form action="" method = "POST">

    <table class ="tbl-30">
            <Tr>
                <td>Current Password</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </Tr>
            <tr>

            <td>New Password</td>
            <td>
            <input type="password" name="new_password" placeholder="New Password">
            </td>
            </tr>
            <tr>
                <td> Confirm Password:</td>
                <td>
                <input type="password" name="confirm_password" placeholder="Confirm Password">
                </td>
            </tr>
            <tr>
             <td colspan="2">
                 <input type="hidden" name="id" value ="<?php echo $id; ?>">
                 <input type="submit" name="submit"value="Change Password" class="btn-sec">
            </tr>
             </table>
               </div>
             </div>


<?php
 // check button is clik or not 
 if(isset($_POST['submit']))
 {
     //echo "Button Clicked";
     //get for update
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);
    
    // password exists or not 
    $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

     
     
     //excutaue qurey
     $res=mysqli_query($conn, $sql);
     // check query excutate
     if($res==TRUE)
     {
         // check aviable or not 
            $count=mysqli_num_rows($res);
            if($count==1) {
                //user exists and password can be cahnged
                if($new_password==$confirm_password){
                //echo "match";
                $sql2="UPDATE tbl_admin
                     SET password='$new_password' 
                    WHERE id=$id";
                    $res=mysqli_query($conn, $sql2);
                    if ($res==TRUE) {
                        $_SESSION['Password Change'] = "<div class = 'sucess'>  Password Changed Successfully. </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    }
                    else {
                        $_SESSION['Password Not Change'] = "<div class = 'fail'> Failed to Change Password.Try Again Later . </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }

                }
                else {
                    //echo "didn't match"
                    $_SESSION['Password Not Match'] = "<div class = 'fail'> Password Not Matched.Try Again Later . </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                           
                }
            }
            else {
                //user does not exists and password can not cahnged
                $_SESSION['User not found'] = "<div class = 'fail'> Failed to Admin Update.Try Again Later . </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
     }


 
?>

<?php include('partials/footer.php');?>