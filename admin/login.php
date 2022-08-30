<?php include('../config/constants.php'); ?>
<html>

<head>

<title> Admin Login </title>
<link rel="stylesheet" href=" ../css/admin.css">
<body>
    <div class = "login">

    <h1 class="text-centre"> Admin Log-In</h1>
    <br>
    <?php

    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no login message'])) 
    {
        echo $_SESSION['no login message'];
        unset($_SESSION['no login message']);
    }

    ?>
    <br><br> 
    <form action="" method="POST" class="text-centre">
    <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter Your username"></td>
            
                </tr>

                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter Your password"></td>
                </tr>
    </table>
            
                 <br>
                 <br>
                 <input type="submit" name="submit" value="Log-In" class="btn-primary">
        


    </form>

    </div>

</body>
</head>
</html>
<?php
 if (isset($_POST['submit'])) {
      $username = $_POST['username'];
       $password = md5($_POST['password']);
     //query for check username and password exsists or not
     $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password= '$password'";
     //exacut the query
     $res = mysqli_query($conn, $sql);

     //count the rows to check
     $count = mysqli_num_rows($res);

     if($count==1) {

         //login success
         $_SESSION['login'] = "<div class ='sucess'> Login Successfully </div>";
         $_SESSION['user']=$username;// check user login or not
         //redirect admin home
        header("location:".SITEURL.'admin/');
     }
     else
     {
        //login fail
        $_SESSION['login'] = "<div class ='fail'> Username or Password is Incorrect.<br>Try Again Later</div>";
        //redirect login page again
        header("location:".SITEURL.'admin/login.php');
     }
 }
?>