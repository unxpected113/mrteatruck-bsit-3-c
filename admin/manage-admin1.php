<?php include('partials/dash.php');?>
<!DOCTYPE html>
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
            <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active"><i</i>Dashboard</a>
                <a href="manage-category1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Food Categories</a>
                <a href="manage-food1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Manage Products</a>
                <a href="manage-admin1.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i</i>Admins</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i</i>Logout</a>
            </div>
        </div>
     
        <div class="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Mr. Tea Truck Dashboard</h2>
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
                    <h3 class="fs-4 mb-3">Manage Admin</h3>
                    <div class="col">
                    <?php
                        if(isset($_SESSION['add']))
                        {
                             echo $_SESSION['add'];   
                             unset($_SESSION['add']);
                        }
                        if(isset($_SESSION['delete']))
                        {
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                        }
                        if(isset($_SESSION['update']))
                        {
                                echo $_SESSION['update'];
                                unset($_SESSION['update']);
                        }
                        if(isset($_SESSION['user-not-found']))
                        {
                                echo $_SESSION['user-not-found'];
                                unset($_SESSION['user-not-found']);
                        }
                        if(isset($_SESSION['password-not-match']))
                        {
                                echo $_SESSION['password-not-match'];
                                unset($_SESSION['password-not-match']);
                        }
                        if(isset($_SESSION['change-password']))
                        {
                                echo $_SESSION['change-password'];
                                unset($_SESSION['change-password']);
                        }
                        ?>
                        <br>
                        
                        <a href="add-admin1.php" class="btn-update">Add Admin</a>
                        <br><br>
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql="SELECT * FROM tbl_admin";
                                $res = mysqli_query($conn, $sql);

                                if($res==TRUE)
                                    {
                                        $count = mysqli_num_rows($res);
                                        $sn=1;
                                                
                                        while($rows=mysqli_fetch_assoc($res))
                                        {
                                            $id = $rows['id'];
                                            $full_name = $rows['full_name'];
                                            $username = $rows['username'];
                                                        
                                            ?>
                                            <tr>
                                            <td><?php echo $sn++;?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $username;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL; ?>admin/change-password1.php?id=<?php echo $id ;?>" class="btn-add">Change Password</a>
                                                <a href="<?php echo SITEURL; ?>admin/update-admin1.php?id=<?php echo $id ;?>" class="btn-update">Update Admin</a>
                                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-delete">Delete Admin</a>
                                                                        
                                            </td>
                                            <?php
                                            }
                                        }
                                        else
                                        {

                                        }              
                        ?> 
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
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