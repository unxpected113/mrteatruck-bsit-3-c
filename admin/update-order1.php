<?php include('partials/dash.php');?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/dash.css" />
    <title>Dashboard</title>
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
               

                <div class="row my-5">
                <h3 class="fs-4 mb-3">Orders</h3>
                
                   
                        <table class="table bg-white rounded table-hover">
                            <thead>
                               
                            </thead>
                            <tbody>
                              <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    header('location:'.SITEURL.'admin/dashboard.php');
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/dashboard.php');
            }
        ?>

                            <form action="" method="POST">
                                <table class="tbl">
                                    <tr>
                                        <td>Food Name</td>
                                        <td><b><?php echo $food; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td><b><?php echo $price; ?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" required readonly>
                    </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <select name="status">
                                                <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                                                <option <?php if($status=="On Delivery"){echo "selected";}?>value="On Delivery">On Delivery</option>
                                                <option <?php if($status=="Delivered"){echo "selected";}?>value="Delivered">Delivered</option>
                                                <option <?php if($status=="Cancelled"){echo "selected";}?>value="Cancelled">Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Name:</td>
                                        <td>
                                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Contact:</td>
                                        <td>
                                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer Address:</td>
                                        <td>
                                            <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                                            <input type="submit" name="submit" value="Update Order" class="btn-add">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        <?php 
                            if(isset($_POST['submit']))
                            {
                                $id = $_POST['id'];
                                $qty = $_POST['qty'];
                                $price = $_POST['price'];
                                $total = $price * $qty;
                                $status = $_POST['status'];
                                $customer_name = $_POST['customer_name'];
                                $customer_contact = $_POST['customer_contact'];
                                $customer_address = $_POST['customer_address'];

                                $sql2 = "UPDATE tbl_order SET
                                   
                                    qty = $qty,
                                    price = $price,
                                    total = $total,
                                    status = '$status',
                                    customer_name = '$customer_name',
                                    customer_contact = '$customer_contact',
                                    customer_address = '$customer_address'
                                    WHERE id=$id;
                                ";

                                $res2 = mysqli_query($conn, $sql2);

                                if($res2==true)
                                    {
                                        $_SESSION['update'] = "<div>Order has Successfully Updated.</div>";
                                        header('location:'.SITEURL.'admin/dashboard.php');
                                    }
                                    else
                                    {
                                        $_SESSION['update']= "<div class='error'>Failed to Update Order.</div>";
                                        echo mysqli_error($conn);
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