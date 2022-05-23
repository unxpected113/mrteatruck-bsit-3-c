<?php include('front-partials/menu.php');?>
<?php include('front-partials/log.php');?>

    <?php
        if(isset($_GET['food_id']))
        {
            $food_id = $_GET['food_id'];
            
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                header('location:'.SITEURL);
            }
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <section class="food-search">
        
            <h2 class="text-center text-white">Confirm your order.</h2>

            <form action="" method = "POST" class="order">
                <fieldset>
                <?php
                    $sql2="SELECT * FROM users where id=$loggedin_id";
                    $res2=mysqli_query($conn,$sql2);
                ?>
                    <?php
                    if($res==true)
                            {
                                $count2 = mysqli_num_rows($res2);

                                if($count==1)
                                {
                                    $row=mysqli_fetch_assoc($res2);
                                    $full_name = $row['full_name'];
                                    $username = $row['user'];
                                    $contact = $row['contact'];

                                }
                                else
                                {
                                    header('location:'.SITEURL.'order.php');
                                }
                            }
                        
                        ?>
                    <legend class="text-white text-center">Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3 class="text-white"><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price1">₱<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                
                    <legend class="text-white text-center">Delivery Details</legend>
                    <br>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" class="input-responsive" required value="<?php echo $row['full_name'];?>">

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="" class="input-responsive" required value="<?php echo $row['contact'];?>">

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="3" placeholder="" class="input-responsive" required ><?php echo $row['address'];?></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
                if(isset($_POST['submit']))
                {
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date("Y-m-d");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_address = $_POST['address'];

                    $sql3 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = '$qty',
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_address = '$customer_address'
                    ";
               

                    $res3 = mysqli_query($conn, $sql3);

                    if($res3==true)
                    {
                        $_SESSION['order'] = "<div class='text-white'>Order Successfully Placed.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] = "<div class='text-white'>Order Failed.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>

    </section>
    


    

