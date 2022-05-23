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
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i</i>Dashboard</a>
                <a href="manage-category1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Food Categories</a>
                <a href="manage-food1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Manage Products</a>
                <a href="manage-admin1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Admins</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i</i>Logout</a>
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
               

                <div class="row my-5">
                <h3 class="fs-4 mb-3">Update Food</h3>
                
                  
                        <table class="table bg-white rounded table-hover">
                           
                            </thead>
                            <tbody>
                            <?php
                            if(isset($_GET['id']))
                            {
                                $id = $_GET['id'];

                                $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
                                $res2 = mysqli_query($conn,$sql2);
                                $row2 = mysqli_fetch_assoc($res2);

                                $title = $row2['title'];
                                $description = $row2['description'];
                                $price = $row2['price'];
                                $current_image = $row2['image_name'];
                                $current_category = $row2['category_id'];
                                $featured = $row2['featured'];
                                $active = $row2['active'];

                            }
                            else
                            {
                                header('location:'.SITEURL.'admin/manage-food1.php');
                            }

                        ?>

                        <div class="main-content">
                            <div class="wrapper">
                               
                                

                                <form action="" method="POST" enctype="multipart/form-data">
                                    <table class="tbl">
                                        <td>Title: </td>
                                        <td>
                                            <input type="text" name="title" value="<?php echo $title;?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Description: </td>
                                        <td>
                                            <textarea name="description"  cols="30" rows="6"><?php echo $description; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price: </td>
                                        <td>
                                            <input type="number" name="price" value ="<?php echo $price;?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Current Image: </td>
                                        <td>
                                        <?php
                                            if($current_image == "")
                                                {
                                                    echo "<div class='error'>Image not Added</div>";
                                                }
                                                else
                                                {
                                            
                                                ?>
                                                    <image src="<?php echo SITEURL?>images/food/<?php echo $current_image;?>" width="150px">
                                                <?php
                                                }
                                                ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Select New Image: </td>
                                        <td>
                                            <input type="file" name="image">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Category: </td>
                                        <td>
                                            <select name="category">
                                                <?php
                                                    $sql = "SELECT * FROM food_category WHERE active='Yes'";
                                                    $res = mysqli_query($conn, $sql);
                                                    $count = mysqli_num_rows($res);

                                                    if($count>0)
                                                    {
                                                        while($row=mysqli_fetch_assoc($res))
                                                        {
                                                            $category_title = $row['title'];
                                                            $category_id = $row['id'];

                                                            ?>
                                                            <option <?php if($current_category==$category_id){echo "Selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='0'>Category not Available.</option>";
                                                    }

                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Featured: </td>
                                        <td>
                                            <input <?php if($featured =="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                                            <input <?php if($featured =="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Active: </td>
                                        <td>
                                            <input <?php if($active =="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                                            <input <?php if($active =="No"){echo "checked";}?> type="radio" name="active" value="No">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" name="id" value="<?php echo $id ;?>">
                                            <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">
                                            <input type=submit name="submit" value="Update Food" class="btn-add">
                                        </td>
                                    </tr>
                                    </table>
                                </form>

                                <?php
                                if(isset($_POST['submit']))
                                {
                                    $id = $_POST['id'];
                                    $title = $_POST['title'];
                                    $description = $_POST['description'];
                                    $price = $_POST['price'];
                                    $current_image = $_POST['current_image'];
                                    $category = $_POST['category'];
                                    $featured = $_POST['featured'];
                                    $active = $_POST['active'];

                                    if(isset($_FILES['image']['name']))
                                    {
                                        $image_name = $_FILES['image']['name'];

                                        if($image_name!="")
                                        {
                                            //image available
                                            //upload new image
                                            //rename image
                                            $ext = end(explode('.',$image_name)); // change food name extension
                                            $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
                                            $src_path = $_FILES['image']['tmp_name']; //image source
                                            $dest_path = "../images/food/".$image_name; //image destination
                                            $upload = move_uploaded_file($src_path, $dest_path);

                                            if($upload==false)
                                            {
                                                $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image.</div>";
                                                header('location'.SITEURL.'admin/manage-food1.php');
                                                die();
                                            }
                                            if($current_image!="")
                                            {
                                                //remove image and replace new image
                                                $remove_path = "../images/food/".$current_image;
                                                $remove = unlink($remove_path);

                                                if($remove==false)
                                                {
                                                    $_SESSION['remove-failed'] = "<div class='error'>Failed to Remove Current Image.</div>";
                                                    header('location'.SITEURL.'admin/manage-food1.php');
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
                                    //update database
                                    $sql4 = "UPDATE tbl_food SET
                                        title = '$title',
                                        description = '$description',
                                        price = $price,
                                        image_name = '$image_name',
                                        category_id = '$category',
                                        featured = '$featured',
                                        active = '$active'
                                        WHERE id=$id
                                    ";
                                    //execute 
                                    $res4 = mysqli_query($conn, $sql4);

                                    if($res4==true)
                                    {
                                        $_SESSION['update-food'] = "<div>Food/Beverage has Successfully Updated.</div>";
                                        header('location'.SITEURL.'admin/manage-food1.php');
                                    }
                                    else
                                    {
                                        $_SESSION['update-food'] = "<div class='error'>Failed to Update Food/Beverage.</div>";
                                        header('location'.SITEURL.'admin/manage-food1.php');
                                    }
                                }
                                ?>

                            </div>
                        </div>


                            </tbody>
                        </table>
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