<?php
include('../config/constants.php');
//echo "Delete Page"
if(isset($_GET['id'])AND isset($_GET['image_name']))
{
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    if($image_name != "")
    {
        $path ="../images/category/".$image_name;
        $remove =unlink($path);

        if($remove==false)
        {
            $_SESSION['remove'] = "<div class='error'> Failed to remove Category Image.</div>";
            header('location:'.SITEURL.'admin/manage-caterory.php');
            die();
        }
    }

    $sql = "DELETE FROM food_category WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div>Category has Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category1.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category1.php');
    }

}
else
{
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>