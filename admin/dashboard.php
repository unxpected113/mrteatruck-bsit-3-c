<?php 
include('partials/dash.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../css/dash.css" />
    <title>Mr. Tea Truck Admin Panel</title>
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
                <h3 class="fs-1 mb-3">Orders</h3>
                
                   <?php
                        if(isset($_SESSION['update']))
                        {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                        }
                    ?>
                        <table class="table bg-white rounded table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="10">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Orders</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                $sn = 1; //initiial number for serial number

                                if($count>0)
                                {
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                                $id = $row['id'];
                                                $customer_name = $row['customer_name'];
                                                $customer_contact = $row['customer_contact'];
                                                $customer_address = $row['customer_address'];
                                                $qty = $row['qty'];
                                                $price = $row['price'];
                                                $total = $row['total'];
                                                $order_date = $row['order_date'];
                                                $status = $row['status'];
                                               

                                                ?>
                                                 <tr>
                                                 <td><?php echo $sn++; ?></td>
                                                        <td><?php echo $customer_name; ?></td>
                                                        <td><?php echo $customer_contact; ?></td>
                                                        <td><?php echo $customer_address; ?></td>
                                                        <td><?php echo $qty; ?></td>
                                                        <td><?php echo $price; ?></td>
                                                        <td><?php echo $total; ?></td>
                                                        <td><?php echo $order_date; ?></td>
                                                        <td>
                                                                <?php 
                                                                        if($status=="Ordered")
                                                                        {
                                                                                echo "<label>$status</label>";
                                                                        }
                                                                        elseif($status=="On Delivery")
                                                                        {
                                                                                echo "<label>$status</label>";
                                                                        }
                                                                        elseif($status=="Delivered")
                                                                        {
                                                                                echo "<label>$status</label>";
                                                                        }
                                                                        elseif($status=="Cancelled")
                                                                        {
                                                                                echo "<label>$status</label>";
                                                                        }
                                                                ?>
                                                        </td>
                                                        
                                        

                                                        <td>
                                                                <a href="<?php echo SITEURL ;?>admin/update-order1.php?id=<?php echo $id; ?>" class="btn-update">Update </a>
                                                                
                                                        </td>
                                                </tr>
                                                <?php
                                        }
                                }
                                else
                                {
                                        echo "<tr><td> colspan='12' class='error'>Order not Available.</td></td>";
                                }

                        ?>


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