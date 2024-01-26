<?php
include('C:\xampp\htdocs\Bootstrap\conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

            require 'C:\xampp\htdocs\Bootstrap\PHPMailer\PHPMailer.php';
            require 'C:\xampp\htdocs\Bootstrap\PHPMailer\SMTP.php';
            require 'C:\xampp\htdocs\Bootstrap\PHPMailer\Exception.php';

            $umail = $_SESSION['mail'];

            $otp = rand(1111, 9999);
            session_start();
            $_SESSION['otp'] = $otp;
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'hp004086@gmail.com';
                $mail->Password   = 'jkofloznkmebgcnv';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                $mail->setFrom('hp004086@gmail.com', 'IMS');
                $mail->addAddress($umail);

                $mail->isHTML(true);
                $mail->Subject = 'IMS(Inventory Managment System)';
                $mail->Body    = 'Your Email Varification OTP is ' . $otp . ' </b><br><br> This mail is send by the HARSH';

                if ($mail->send()) {
?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success...',
                            text: 'Otp Send Successfully!',
                        });
                    </script>
                <?php
                }
            } catch (Exception $e) {
                ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: '<?php echo "OTP could not be sent. Please Check your internet connection or enter valid email ID" ?>',
                    });
                </script>
<?php

            }

            header("Location: http://localhost/bootstrap/OTP/index.php");
            exit();
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
