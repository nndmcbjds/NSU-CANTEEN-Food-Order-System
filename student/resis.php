<?php include('../config/constants.php'); ?>

<html>

<head>

<title> Login </title>
<link rel="stylesheet" href=" ../css/admin.css">
<body>
    <div class = "login">
               <h1 class="text-centre">Resistration form</h1>
               <br>
               <?php
    
                 if(isset($_SESSION['add']))//checking the session work or not
                  {
                     echo $_SESSION['add']; //Display session message
                     unset($_SESSION['add']); //Removing session message
                  }
               ?>

               <form action="" method="POST" class="text-centre">

               <table>
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your Student Id"></td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td><input type="Email" name="email" placeholder="Enter Your email@gmail.com"></td>
                </tr>


                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your password"></td>
                </tr>


               </table>
               <br>
                 <br>
                 <input type="submit" name="submit" value="Sign-In" class="btn-primary">
                 <br>
                 <br>
                 Or
                 <br>
                 <br>
                 <a class="btn-primary" href="user_login.php"> Log-In</a>
                </form>

               
        </div>
      

        <?php
        //Process the Value from and Save it in Database
        //Check whether the button is clicked or not

        if(isset($_POST['submit'])){
            //button Clicked
            //echo "Button Clicked";
            //get  the data from from

            $full_name=$_POST['full_name'];
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=md5($_POST['password']); //password encryption with md5

            //SQL Querry to save the data into database
            $sql = "INSERT INTO tbl_student SET 
            full_name='$full_name',
            username = '$username',
            email = '$email',
            password = '$password'";
           
            //Execute Query and save Data into database
            $res = mysqli_query($conn,$sql) or die(mysqli_error());

            //Check whether the(Query is Executed) data is inserted or not and display appropiate message
            if($res==TRUE)
            {
                //Data Inserted
                //echo"Data Inserted";
                //create a Session variable to display message
                $_SESSION['add']="<div class ='sucess'>Resistration Successfully</div>";
                //Redirect page to manage admin
                header("location:".SITEURL.'student/resis.php');
            }
            else
            {
                //Failed to Insert data
                //echo"Failed to insert data";
                //create a Session variable to display message
                $_SESSION['add']="<div class ='fail'>Failed to Resistration </div>";
                //Redirect page to Add admin
                header("location:".SITEURL.'student/resis.php');
            }
        }


        ?>