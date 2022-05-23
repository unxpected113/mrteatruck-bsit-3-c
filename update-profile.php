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
    <?php
        $sql="SELECT * FROM users where id=$loggedin_id";
        $res=mysqli_query($conn,$sql);
    ?>
           <?php
           if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $full_name = $row['full_name'];
                        $user = $row['user'];
                        $contact = $row['contact'];

                    }
                    else
                    {
                        header('location:'.SITEURL.'user-profile.php');
                    }
                }
            
            ?>
   
        <h1 class="text-center">User Profile</h1>
        <form action="" method="POST" class="text-center">
        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
    ?>
            
            <table>
            <tr>
            <div class="txt_field">
            <input type="text" name="full_name" value="<?php echo $row['full_name'];?>">
            <span></span>
            <label>Full Name</label>
           </tr>
           <div class="txt_field">
                <input type="text" name="address" value="<?php echo  $row['address'];?>">
                <span></span>
                <label>Username</label>
           </tr>
           <tr>
           <div class="txt_field">
                <input type="text" name="user" value="<?php echo  $row['user'];?>">
                <span></span>
                <label>Username</label>
           </tr>
           <tr>
           <div class="txt_field">
                <input type="text" name="contact" value="<?php echo $row['contact']; ?>">
                <span></span>
                <label>Contact</label>
           </tr>
                        
                   
                     
                    
        </table>
                <input type="hidden" name="id" value="<?php echo $loggedin_id; ?>">
                <input type="submit" name="submit" value="Update profile" class="btn-add">
            </form>

      <div class="clearfix"></div>                          

</div>
     
        

<?php 
   if(isset($_POST['submit']))
   {
      
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $user = $_POST['user'];

        $sql2 ="UPDATE users SET
        full_name = '$full_name',
        address = '$address',
        contact = '$contact',
        user = '$user'
        WHERE id='$id'
        ";
        $res2 = mysqli_query($conn, $sql2);
        if($res2==true)
    {
        $_SESSION['update'] = "<div class='success text-center'>Profile Updated</div>";
        header('location:'.SITEURL. 'log-in.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error text-center'>Failed to Update Profile</div>";
        header('location:'.SITEURL. 'update-profile.php');
    }
   }
?>