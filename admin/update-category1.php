<?php include('partials/dash.php');?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/dash.css" />
    <title>Bootstap 5 Responsive Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class=""></i>Mr. Tea Truck</div>
            <div class="list-group list-group-flush my-3">
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="manage-category1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-project-diagram me-2"></i>Food Categories</a>
                <a href="manage-food1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i 
                        class="fas fa-shopping-cart me-2"></i>Manage Products</a>
                <a href="manage-admin1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-user-secret me-2"></i>Admins</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
      
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $sql = "SELECT * FROM tbl_food";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                            ?>
                            <h1 class="fs-2"><?php echo $count; ?></h1>
                                <p class="fs-5">Foods</p>
                            </div>
                            <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $sql2 = "SELECT * FROM tbl_order";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                            ?>
                            <h1 class="fs-2"><?php echo $count2; ?></h1>
                            <p class="fs-5">Orders</p>
                            </div>
                            <i class="fas fa-truck fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                            <?php
                                $sql4 = "SELECT SUM(total) as Total FROM tbl_order WHERE status='Delivered'";
                                $res4 = mysqli_query($conn, $sql4);
                                $row4 = mysqli_fetch_assoc($res4);
                                $total_revenue = $row4['Total'];
                            ?>
                                <h1 class="fs-2">₱<?php echo $total_revenue; ?></h1>
                                <p class="fs-5">Revenue</p>
                            </div>
                            <i
                                class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
               

                    <div class = "main-content">
    <div class = "wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                $sql = "SELECT * FROM food_category WHERE id = $id";
                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                ?>
                                    <image src="<?php echo SITEURL?>images/category/<?php echo $current_image;?>" width="150px">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type=submit name="submit" value="Update Category" class="btn-add">
                    </td>
                </tr>

            </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    $title = $_POST['title'];
                    $id = $_POST['id'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                   if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        if($image_name != "")
                        {
                            $ext = end(explode('.',$image_name));
                            $image_name = "Food_Category_".rand(0000,9999).'.'.$ext;
        
        
                            $source_path = $_FILES['image']['tmp_name'];
        
                            $destination_path = "../images/category/".$image_name;
        
                            $upload = move_uploaded_file($source_path,$destination_path);
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            }
                            if($current_image != "")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
    
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to Remove Current Image</div>";
                                    header('location:'.SITEURL.'admin/manage-category.php');
                                    die(); 
                                } 
                            }
                            
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    $sql2 = "UPDATE food_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
                    
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==true)
                    {
                        $_SESSION['update'] = "<div>Category has Successfully Updated</div>";
                        header('location:'.SITEURL.'admin/manage-category1.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                        header('location:'.SITEURL.'admin/manage-category1.php');
                    }

                   
                }
            
            
            ?>

        </div>


</div>
                </div>

            </div>
        </div>
    </div>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>