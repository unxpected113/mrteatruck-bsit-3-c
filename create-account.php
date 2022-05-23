<?php include('config/constants.php');?>

<html>
    
    <head>
        <title>Create Account - Mr. Tea Truck</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
      
    <div class="login">
        <h1 class="text-center">Create Account</h1>
        <?php
            if(isset($_SESSION['exist']))
            {
                echo $_SESSION['exist'];
                unset($_SESSION['exist']);
            }
        ?>
    

        <form action="" method="POST" class="text-center">
        <div class="txt_field">
        <input type="text" required name="full_name"><br><br>
        <span></span>
        <label>Full Name</label>
        </div>
        <div class="txt_field">
        <input type="text" required name="address"><br><br>
        <span></span>
        <label>Address</label>
        </div>
        <div class="txt_field">
        <input type="text" required name="contact"><br><br>
        <span></span>
        <label>Contact Number</label>
        </div>
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
        
        <br><br><br>
        <input type="submit" name="submit" value="Create Account" class="btn-add">
        <br><br>
        </form>
    </div>
     

    <?php

    if(isset($_POST['submit']))
    {
       
        $sql3 = "SELECT * FROM users WHERE user = '".$_POST['user']."'";
        $select = mysqli_query($conn, $sql3);
         if(mysqli_num_rows($select)) 
         {
             $_SESSION['exist'] = "<div class='error text-center'>User already Exist.</div>";
             header("location:".SITEURL.'create-account.php');
         }
         else
         {
             
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $user = $_POST['user'];
        $password = md5($_POST['pass']); 

        $sql = "INSERT INTO users SET
            full_name = '$full_name',
            address = '$address',
            contact = '$contact',
            user = '$user',
            pass = '$password'
        ";
        
        
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        
        if($res==TRUE)
        {
            
            $_SESSION['add'] = "<div class='text-center'>Account has Successfully Created.</div>";
            header("location:".SITEURL.'log-in.php');
             
        }
        else
        {
            
            $_SESSION['add'] = "<div class='error text-center'>Failed to Create Account.</div>";
            
            header("location:".SITEURL.'create-account.php');
        }
    }
}
    

?>
