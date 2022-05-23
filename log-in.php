<?php include('front-partials/user-checker.php');?>

<html>
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Mr. Tea Truck</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
      
    <div class="login">
        <h1 class="text-center">User Log-In</h1>
    

    <?php
      
        if(isset($_SESSION['add']))
       {
           echo $_SESSION['add'];
           unset($_SESSION['add']);
        }
      if(isset($_SESSION['login']))
      {
          echo $_SESSION['login'];
          unset($_SESSION['login']);
      }
      if(isset($_SESSION['not-login']))
      {
          echo $_SESSION['not-login'];
          unset($_SESSION['not-login']);
      }
      if(isset($_SESSION['update']))
      {
          echo $_SESSION['update'];
          unset($_SESSION['update']);
      }
      

    ?>

        <form action="" method="POST" class="text-center">

        <div class="txt_field">
        <input type="text" required name="user"><br><br>
        <span></span>
        <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" required name="password">
          <span></span>
          <label>Password</label>
        </div>
        <a href="create-account.php">Create Account</a>
        <br><br><br>
        <input type="submit" name="submit" value="Login" class="btn-front">
        <br><br>
        </form>
    </div>
     

<?php
if(isset($_POST['submit']))
{
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $raw_password = md5($_POST['pass']);
    $password = mysqli_real_escape_string($conn, $raw_password);
 
    $sql = "SELECT * FROM users WHERE user='$user' AND pass='$password'";
    
    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if($count==1)
    {
        $_SESSION['login'] = "<div class='text-white'>Login Successfully.</div>";
        $_SESSION['user'] = $user;

        header('location:'.SITEURL.'index.php');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'log-in.php');
    }

}

?>