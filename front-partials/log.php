<?php 

    
    if(!isset($_SESSION['user']))
    {
        
        $_SESSION['not-login'] = "<div class='error text-center'>Please login.</div>";
        
        header('location:log-in.php');
    }
    

?>