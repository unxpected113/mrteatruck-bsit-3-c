<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mr. Tea Truck</title>
	<link rel="stylesheet" href="css/styles.css">
	
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
</head>


<body class="index-body">
	<div class="hero">
		<nav>
        <a href="https://www.facebook.com/MrTeaTruck" class="logo">Mr. Tea Truck</a>
        <div class="icon right">
			<ul>
				<li><a href="<?php echo SITEURL; ?>">Home</a></li>
				<li><a href="foods1.php">Menu</a></li>
				<div class="dropdown">
					<a class="dropbtn">User</button>
					<div class="dropdown-content">
						<a href="<?php echo SITEURL; ?>log-in.php">Log-in</a>
						<a href="<?php echo SITEURL; ?>user-profile.php">My Account</a>
						<a href="<?php echo SITEURL; ?>log-out.php">Log-Out</a>
						
					</div>
					</div>
			</ul>
			</div>
            <div class="icon">
			</div>
			
		</nav>
		</div>
    </body>
		<div class="right-sidebar"></div>
		<div class="content">
			<div class="left">
				<h4>DISCOVER</h4>
				<h3> Drinks<br> & Delicious Bites</h3>
				<?php
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
					if(isset($_SESSION['order']))
					{
						echo $_SESSION['order'];
						unset ($_SESSION['order']);
					}
	  			?>
				<form action="<?php echo SITEURL; ?>food-search1.php" method="POST">
					<input type="text" name="text" placeholder="Search Coffee, MilkTea, Bites" required>
					<input type="submit" name="submit" value="Search">
				</form>
			</div>
			<div class="right">
				<img src="images/img/PP.png" class="drinks">
			</div>
		</div>
	</div>


</html>
