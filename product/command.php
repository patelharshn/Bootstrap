<?php
include('C:\xampp\htdocs\Bootstrap\conn.php');

// if($con)
// {
//     echo "Connected";
// }
// else
// {
//     echo "not connected";
// }

if (isset($_POST['btn_product_add'])) {
    $umail = $_POST['u_email'];
    $u_id = $_POST['u_id'];
    $pname = $_POST['p_name'];
    $qty = $_POST['p_qty'];
    $mos = $_POST['p_mos'];

    $query_duplicate = "select * from product where product_name='$pname' && user_id='$u_id'";
    $result_duplicate = mysqli_query($con, $query_duplicate);
    $row_duplicate = mysqli_fetch_row($result_duplicate);

    $row_pname = $row_duplicate[1];
    $row_uid = $row_duplicate[4];

    if ($row_pname == $pname && $row_uid == $u_id) {
        session_start();
        $_SESSION['product_message'] = "Product Already Exist...Please Check";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "Error...";
        header("Location: http://localhost/bootstrap/product/index.php");
        exit();
    } else {
        $query = "insert into product(product_name,qty,typeofsell,user_id) values('$pname','$qty','$mos','$u_id')";
        $result = mysqli_query($con, $query);
        $row = mysqli_affected_rows($con);

        if ($row >= 0) {
            session_start();
            $_SESSION['product_message'] = "Product Added Successfully!";
            $_SESSION['icon'] = "success";
            $_SESSION['title'] = "Success...";
            header("Location: http://localhost/bootstrap/product/index.php");
            exit();
        } else {
            session_start();
            $_SESSION['product_message'] = "Product Not Add";
            $_SESSION['icon'] = "error";
            $_SESSION['title'] = "Error...";
            $_SESSION['mail'] = '';
            header("Location: http://localhost/bootstrap/product/index.php");
            exit();
        }
    }
}


if (isset($_POST['btn_product_edit'])) {
    $umail = $_POST['u_email'];
    $p_id = $_POST['p_id'];
    $pname = $_POST['p_name'];
    $qty = $_POST['p_qty'];
    $mos = $_POST['p_mos'];

    session_start();

    $query_edit = "update product set product_name='$pname',qty='$qty',typeofsell='$mos' where id='$p_id'";
    $result = mysqli_query($con, $query_edit);
    $row = mysqli_affected_rows($con);

    if ($row > 0) {
        // echo "Update Product!!";
        $_SESSION['icon'] = "success";
        $_SESSION['title'] = "Success...";
        $_SESSION['message'] = "Product Update Successfully!";
        header("Location: http://localhost/bootstrap/product/index.php");
        exit();
    } else {
        echo "Not Update Product.....";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "Error...";
        $_SESSION['message'] = "Product Not Update...";
        header("Location: http://localhost/bootstrap/product/index.php");
        exit();
    }
}


if (isset($_POST['yes_btn'])) {
    $delete_id = $_POST['delete_p_id'];

    session_start();

    $query_p_id = "delete from product where id='$delete_id'";
    $result = mysqli_query($con, $query_p_id);
    $row = mysqli_affected_rows($con);
    if ($row > 0) {
        // echo "Product Deleted!";
        $_SESSION['icon'] = "success";
        $_SESSION['title'] = "Success...";
        $_SESSION['delete_message'] = "Product Deleted Successfully!";
        header("Location: http://localhost/bootstrap/product/index.php");
        exit();
    } else {
        // echo "Product Not Delete";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "Error...";
        $_SESSION['delete_message'] = "Product Not Deleted...";
        header("Location: http://localhost/bootstrap/product/index.php");
        exit();
    }
}
