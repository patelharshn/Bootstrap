<?php
session_start();
require('C:\xampp\htdocs\Bootstrap\conn.php');

if (!isset($_SESSION['mail'])) {
    header("location: http://localhost/bootstrap/signup/index.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Varification</title>

    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="./style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- CDN Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="./script.js" defer></script>
</head>

<body>
    <div class="container">
        <header>
            <i class="bx bxs-check-shield"></i>
        </header>
        <h4>Enter OTP Code</h4>
        <h5>Otp Send On <?php echo $_SESSION['mail']; ?></h5>
        <form action="index.php" method="post">
            <div class="input-field">
                <input name="1" type="number" />
                <input name="2" type="number" disabled />
                <input name="3" type="number" disabled />
                <input name="4" type="number" disabled />
            </div>
            <button name="btn_verify">Verify OTP</button>
        </form>
    </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['btn_verify'])) {
    $u_otp = $_POST['1'] . $_POST['2'] . $_POST['3'] . $_POST['4'];
    $otp = $_SESSION['otp'];
    if ($otp == $u_otp) {
?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success...',
                text: 'Otp Verify Successfully!',
            });
        </script>
        <?php

        $shop = $_SESSION['shop'];
        $mail = $_SESSION['mail'];
        $uname = $_SESSION['uname'];
        $pass = $_SESSION['pass'];

        $hashpassord = password_hash($pass, PASSWORD_DEFAULT);

        $query_insert = "insert into user(shopname,email,username,password) values('$shop','$mail','$uname','$hashpassord')";
        $result = mysqli_query($con, $query_insert);
        $row = mysqli_affected_rows($con);

        if ($row >= 0) {
            // 
        ?>
            // <script>
                //         Swal.fire({
                //             icon: 'success',
                //             title: 'Success...',
                //             text: 'Registration Successfully!',
                //         });
                //     
            </script>
            // <?php
                unset($_SESSION['shop']);
                unset($_SESSION['mail']);
                unset($_SESSION['uname']);
                unset($_SESSION['pass']);
                unset($_SESSION['otp']);
                $_SESSION['message'] = "SignUp Successfully...Please Login With Email And Password!";
                $_SESSION['icon'] = "success";
                $_SESSION['title'] = "Success...";
                header("Location: http://localhost/bootstrap/login/index.php");
                exit();
            }
        } else {
                ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error...',
                text: 'Incorrect OTP...Please enter valid OTP',
            });
        </script>
<?php
        }
    }
?>