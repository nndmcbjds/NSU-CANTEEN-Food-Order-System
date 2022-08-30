<?php
           include('../config/constants.php');
           //Destroy the session
           session_destroy();//unset $Session['user]

           //redirect t login page
           header('location:'.SITEURL.'admin/login.php');
?>