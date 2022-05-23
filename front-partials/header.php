<header class="header">

   <div class="flex">
   <link rel="stylesheet" href="css/cart.css">

   <a href="https://www.facebook.com/MrTeaTruck" class="logo">Mr. Tea Truck</a>

      <nav class="navbar">
         <a href="index.php">Home</a>
         <a href="food.php">Menu</a>
         <a href="user-profile.php">User</a>
         
      </nav>

      <?php
      
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>