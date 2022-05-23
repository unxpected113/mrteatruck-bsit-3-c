<?php include('../config/constants.php')?>
<html>
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Mr. Tea Truck</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
      
    <div class="login">
        <h1 class="text-center">Login</h1>
    

        <?php
      
      if(isset($_SESSION['login']))
      {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }
      if(isset($_SESSION['not-login-message']))
      {
          echo $_SESSION['not-login-message'];
          unset($_SESSION['not-login-message']);
      }

    ?>

        <form action="" method="POST" class="text-center">

        <div class="txt_field">
        <input type="text" required name="username"><br><br>
        <span></span>
        <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password">
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login" class="btn-add">
        <br><br>
        </form>
    </div>
     

<?php
if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);
 
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $_SESSION['login'] = "<div class='update'>Login Successfully.</div>";
        $_SESSION['user'] = $username;

        header('location:'.SITEURL.'admin/dashboard.php');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

}

?>