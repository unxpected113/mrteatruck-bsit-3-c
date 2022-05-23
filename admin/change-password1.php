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
                    <h3 class="fs-4 mb-3">Change Password</h3>
                    <div class="col">
                        
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                            <tbody>
                            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
                
            ?>
            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td>
                            <input type="password" name="current_password" placeholder="Current Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password:</td>
                        <td>
                            <input type="password" name="new_password" placeholder="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td>
                            <input type="password" name="confirm_password" placeholder="Confirm Password">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-add">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>
    
<?php 
    if(isset($_POST['submit']))
    {
        //echo "button clicked";
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    //echo"password match";
                    $sql2="UPDATE tbl_admin SET
                    password='$new_password'
                    WHERE id=$id
                    ";
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2=true)
                    {
                        $_SESSION['change-password'] = "<div class='success'>Password Changed Successfully. </div>";
                        header('location:'.SITEURL.'admin/manage-admin1.php');
                    }
                    else
                    {
                        $_SESSION['change-password'] = "<div class='error'>Failed to Change Password. </div>";
                        header('location:'.SITEURL.'admin/manage-admin1.php');
                    }
                }
                else
                {
                    $_SESSION['password-not-match'] = "<div class='error'>Password didn't Match. </div>";
                    header('location:'.SITEURL.'admin/manage-admin1.php');
                }
            }
            else
            {
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                header('location:'.SITEURL.'admin/manage-admin1.php');
            }
        }

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