<?php
include('C:\xampp\htdocs\Bootstrap\conn.php');

if (isset($_POST['loginbtn'])) {
    $mail = $_POST['mail'];
    $pass = $_POST['passs'];

    // create a session for store login informtion
    session_start();
    $_SESSION['email'] = $mail;
    $_SESSION['pass'] = $pass;

    $query = "select password from user where email='$mail'";
    $result = mysqli_query($con, $query);
    $rows = mysqli_affected_rows($con);
    $psw = mysqli_fetch_row($result);

    if ($rows > 0) {
        if (password_verify($pass, $psw[0])) {
            // echo "Login";            
            $_SESSION['message'] = "Login Successfully!";
            $_SESSION['icon'] = "success";
            $_SESSION['title'] = "Success...";
            header("Location: http://localhost/bootstrap/login/index.php");
            exit();
        } else {
            // echo "Password Is Wrong";
            $_SESSION['message'] = "Password Is Incorrect!";
            $_SESSION['icon'] = "error";
            $_SESSION['title'] = "Error...";
            $_SESSION['pass'] = "";
            header("Location: http://localhost/bootstrap/login/index.php");
            exit();
        }
    } else {
        // echo "User Not Found";
        $_SESSION['message'] = "Email Not Found";
        $_SESSION['icon'] = "error";
        $_SESSION['title'] = "Error...";
        $_SESSION['email'] = "";
        $_SESSION['pass'] = "";
        header("Location: http://localhost/bootstrap/login/index.php");
        exit();
    }
}
