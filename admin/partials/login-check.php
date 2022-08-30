<?php
//authorization - Access Control
// check user login or not
if(!isset($_SESSION['user']))//if user session is not set
{
    //user is not logged in
    //redirect to login page with message
    $_SESSION['no login message'] ="<div class='fail text-centre'>Please Login to access Admin panel</div>";
    //redirect to login page
    header("location:".SITEURL.'admin/login.php');
}

?>