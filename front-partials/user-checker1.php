<?php
include('config/constants.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
 $username=mysqli_real_escape_string($conn,$_POST['user']);
 $password=mysqli_real_escape_string($conn,$_POST['pass']);
 $res = mysqli_query($conn,"SELECT * FROM users where $username='user'");
 $rows = mysqli_num_rows($res);
 if ($rows!=$username) {
  header("location: index.php?remark_login=failed");
 }
 $sql="SELECT id FROM users WHERE user='$username' and pass='$password'";
 $result=mysqli_query($conn,$sql);
 $row=mysqli_fetch_array($result);
 $active=$row['active'];
 $count=mysqli_num_rows($result);
 if($count==1) {
  $_SESSION['login_user']=$username;
  header('location:'.SITEURL.'log-in.php');
 }
}
?>