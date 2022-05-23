<?php include('front-partials/menu.php');?>
    
    <section class="food-search text-center">
        <div class="container">
        <h2 class="text-center">Explore Beverages and Foods</h2>
        </div>
    </section>


   
    <section class="categories">
        <div class="container">
            
            <?php
                $sql = "SELECT * FROM food_category WHERE active='Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            echo "<div class='error'>Image not Found.</div>";
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Coffee" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                <h3 class="float-text text=white"><?php echo $title;?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not Found.</div>";
                }
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
   


  <?php include('front-partials/footer.php');?>