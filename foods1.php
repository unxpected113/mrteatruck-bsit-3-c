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

<body class="food-menu">

	<div class="hero">
		<nav>
        <a href="https://www.facebook.com/MrTeaTruck" class="logo">Mr. Tea Truck</a>
        <div class="icon right">
			<ul>
				<li><a href="<?php echo SITEURL; ?>">Home</a></li>
				<li><a href="<?php echo SITEURL; ?>foods1.php">Menu</a></li>

				<div class="dropdown">
					<button class="dropbtn">User</button>
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
    
    <body class="food-menu">
        <div class="container">
            <h4 class="text-center">Beverage - Snacks - Add-Ons</h4>
           
            <?php
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                               <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            if($image_name=="")
                                            {
                                                echo "<div class='error'>Image not Availablre</div>";
                                            }
                                            else
                                            {
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Fries" class="img-responsive img-curve">
                                                <?php
                                            }
                                        ?>
                                    
                                    </div>

                                <div class="food-menu-desc">
                                <h4><?php echo $title;?><p class="food-price">₱<?php echo $price;?></p></h4>
                                <p class="food-detail">
                                    <?php echo $description;?>
                                </p>
                       
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php

                    }
                }
                else
                {
                    echo "<div class='error'>Food/Beverage not Found</div>";
                }
            ?>
            

            <div class="clearfix"></div>

            
            </div>
        </div>

            </body>
    



    
</div>
</html>
