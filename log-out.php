<?php
include('config/constants.php');

session_destroy();

header('location:log-in.php');

?>