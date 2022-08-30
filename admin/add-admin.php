<?php include('partials/menu.php');?>

        <div class="main-content">
          <div class= "wrapper">
               <h1>Add Admin</h1>
               <br>
               <?php
    
                 if(isset($_SESSION['add']))//checking the session work or not
                  {
                     echo $_SESSION['add']; //Display session message
                     unset($_SESSION['add']); //Removing session message
                  }
               ?>

               <form action="" method="POST">

               <table>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your username"></td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">

                    </td>
                </tr>

               </table>
               </form>

               
        </div>
      

        <?php include('partials/footer.php');?>

        <?php
        //Process the Value from and Save it in Database
        //Check whether the button is clicked or not

        if(isset($_POST['submit'])){
            //button Clicked
            //echo "Button Clicked";
            //get  the data from from

            $full_name=$_POST['full_name'];
            $username=$_POST['username'];
            $password=md5($_POST['password']); //password encryption with md5

            //SQL Querry to save the data into database
            $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username = '$username',
            password = '$password'";
           
            //Execute Query and save Data into database
            $res = mysqli_query($conn,$sql) or die(mysqli_error());

            //Check whether the(Query is Executed) data is inserted or not and display appropiate message
            if($res==TRUE)
            {
                //Data Inserted
                //echo"Data Inserted";
                //create a Session variable to display message
                $_SESSION['add']="Admin Added Successfully ";
                //Redirect page to manage admin
                header("location:".SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //Failed to Insert data
                //echo"Failed to insert data";
                //create a Session variable to display message
                $_SESSION['add']="Failed to Add Admin ";
                //Redirect page to Add admin
                header("location:".SITEURL.'admin/add-admin.php');
            }
        }


        ?>