<?php
include('front-partials/sessions.php');
include('front-partials/log.php');
?>

<html>
    
    <head>
        <title>User Profile - Mr. Tea Truck</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
      
    <div class="login">
        <h1 class="text-center">User Profile</h1>
        <form action="" method="POST" class="text-center">
        <br><br>
       <table>
       <tr>
           <legend>Full Name</legend>
            <div class="txt_field">
            <input type="text" name="full_name" value="<?php echo $row['full_name'];?>" required readonly>
            <span></span>
            
           </tr>
           <tr>
               <legend>Address</legend>
           <div class="txt_field">
                <input type="text" name="address" value="<?php echo  $row['address'];?>"required readonly>
                <span></span>
                
           </tr>
           <tr>
               <legend>Username</legend>
           <div class="txt_field">
                <input type="text" name="user" value="<?php echo  $row['user'];?>"required readonly>
                <span></span>
               
           </tr>
           <tr>
               <legend>Contact</legend>
           <div class="txt_field">
                <input type="text" name="contact" value="<?php echo $row['contact']; ?>"required readonly>
                <span></span>
                
       </table>


        
        <br><br><br>
        <a href="<?php echo SITEURL;?>update-profile.php" class="btn-front">Update Profile</a>
        <br><br>
        </form>
    </div>
</html>