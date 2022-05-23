<?php

@include 'config/constants.php';

if(isset($_POST['add_to_cart'])){
   $id = $_POST['id'];
   $name = $_POST['name'];
   $price = $_POST['price'];
   $image = $_POST['image'];
   $qty =  1;

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, qty) VALUES('$name', '$price', '$image', '$qty')");
      $message[] = 'product added to cart succesfully';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


   <link rel="stylesheet" href="css/cart.css">
</head>
<body>
   
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'front-partials/header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">Menu</h1>

   <div class="box-container">

      <?php
      
      $select_products = mysqli_query($conn, "SELECT * FROM `tbl_food`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
         <img src="images/food/<?php echo $fetch_product['image_name'];?>" alt="Fries" class="img-responsive img-curve">
            <h3><?php echo $fetch_product['title']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="id" value="<?php echo $fetch_product['id']; ?>">
            <input type="hidden" name="name" value="<?php echo $fetch_product['title']; ?>">
            <input type="hidden" name="price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="image" value="<?php echo $fetch_product['image_name']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>


<script src="js/script.js"></script>

</body>
</html>