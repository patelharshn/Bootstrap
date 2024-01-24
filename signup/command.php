<?php
include('C:\xampp\htdocs\Bootstrap\conn.php');

if (isset($_POST['btn_reg'])) {
    $uname = $_POST['uname'];
    $shop = $_POST['shop'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    $hashpassord = password_hash($pass, PASSWORD_DEFAULT);

    session_start();
    $_SESSION['uname'] = $uname;
    $_SESSION['shop'] = $shop;
    $_SESSION['mail'] = $mail;
    $_SESSION['pass'] = $pass;
    $_SESSION['cpass'] = $cpass;

    if ($pass == $cpass) {
        $query = "select email from user where email='$mail'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($result);

        if ($row <= 0) {
            $query_insert = "insert into user(shopname,email,username,password) values('$shop','$mail','$uname','$hashpassord')";
            $result = mysqli_query($con, $query_insert);
            $row = mysqli_affected_rows($con);

            if ($row >= 0) {
                session_start();
                $_SESSION['message'] = "Register Successfully!";
                $_SESSION['icon'] = "success";
                $_SESSION['title'] = "Success";
                header("Location: http://localhost/bootstrap/signup/index.php");
                exit();
            }
        } else {
            session_start();
            $_SESSION['message'] = "Mail Is Alredy Register";
            $_SESSION['icon'] = "error";
            $_SESSION['title'] = "error";
            $_SESSION['mail'] = '';
            header("Location: http://localhost/bootstrap/signup/");
            exit();
        }
    } else {
        session_start();
        $_SESSION['message'] = "Password Is Not Match";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "error";
        $_SESSION['cpass'] = '';
        $_SESSION['pass'] = '';
        header("Location: http://localhost/bootstrap/signup/index.php");
        exit();
    }
}
