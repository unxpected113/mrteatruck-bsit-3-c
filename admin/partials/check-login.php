<?php
if(!isset($_SESSION['user']))
{
    $_SESSION['not-login-message'] = "<div class='error text-center'>Please Login to Access the Admin Panel</div>";
    header('location:'.SITEURL.'admin/login.php');
}

?>