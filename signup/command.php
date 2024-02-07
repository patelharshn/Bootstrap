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
                $mail->Subject = 'IMS(Inventory Managment System) email verification';
                $mail->Body    = "<div style='font-family: Helvetica,Arial,sans-serif;min-width:700px;overflow:auto;line-height:2'>
                <div style='margin:50px auto;width:600px;padding:20px 0'>
                  <div style='border-bottom:1px solid #eee'>
                    <a style='font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600'>Inventory Management System</a>
                  </div>
                  <p style='font-size:1.1em'>Hi,</p>
                  <p>We received a request to verify your email address. <br/>Your verification code is:</p>
                  <h2 style='background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;'>$otp</h2>
                  <p style='font-size:0.9em;'>
                    This OTP is valid for 5 minutes.
                    <br/>
                    If you did not request this code, it is possible that someone else is trying to access your account. <br/><b>Do not forward or give this code to anyone.</b>
                    <br/>
                    <br/>
                    Sincerely yours,
                    <br/>
                    The IMS Project team</p>
                  <hr style='border:none;border-top:1px solid #eee' />
                  <div style='padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                    <p>This email can't receive replies.</p>
                  </div>
                  <div style='float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300'>
                    <p>Ganpat University</p>
                    <p>Dcs, Kherva</p>
                    <p>India</p>
                  </div>
                </div>
              </div>";

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
