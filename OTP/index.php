<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Varification</title>

    <link rel="shortcut icon" href="favicon.png">

    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- CDN Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (!isset($_SESSION['mail'])) {
        header("location: http://localhost/bootstrap/signup/index.php");
    }

    require 'C:\xampp\htdocs\Bootstrap\PHPMailer\PHPMailer.php';
    require 'C:\xampp\htdocs\Bootstrap\PHPMailer\SMTP.php';
    require 'C:\xampp\htdocs\Bootstrap\PHPMailer\Exception.php';

    $umail = $_SESSION['mail'];

    $otp = rand(1111, 9999);
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
                text: '<?php echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; ?>',
            });
        </script>
    <?php
    }

    ?>

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
<script>
    const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");

    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }
            if (!inputs[3].disabled && inputs[3].value !== "") {
                button.classList.add("active");
                return;
            }
            button.classList.remove("active");
        });
    });

    window.addEventListener("load", () => inputs[0].focus());
</script>

</html>

<?php
if (isset($_POST['btn_verify'])) {
}
?>