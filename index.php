<?php
ob_start();
require_once('navbar/index.php');

session_start();
if (!isset($_COOKIE['email']) && !isset($_COOKIE['pass'])) {
    header("Location: ./login/index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS</title>

    <!-- Css CDN bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500&display=swap');

        body {
            display: block;
            font-family: 'Roboto Mono', monospace;
        }

        .container1 {
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .btn-circle.btn-xl {
            width: 100px;
            height: 100px;
            padding: 13px 18px;
            border-radius: 60px;
            /* font-size: 20px; */
            font-size: x-large;
            text-align: center;
            margin-bottom: 10px;
        }

        button i {
            transition: all 0.65s;
        }

        button:hover i {
            font-size: xx-large;
            transform: rotateY(360deg);
        }

        .row {
            text-align: center;
        }

        .heading {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="cover-container text-center text-white bg-dark d-flex w-100 vh-100 p-3 mx-auto flex-column justify-content-center">
        <section class="py-5 text-center container">
            <div class="row py-lg-9">
                <div class="col-lg-9 col-md-8 mx-auto">
                    <h1 class="fw-bold fs-1">Inventory Management System</h1>
                    <p class="lead fs-5 text-lowercase mt-4">Manage The Inventory like add product , pruchase product , Sell product , Return Product</p>
                    <p class="fs-5 fw-bold text-uppercase">Hi,
                        <?php
                        $email = $_COOKIE['email'];
                        $username = strstr($email, '@', true);
                        echo $username;
                        ?>
                    </p>
                </div>
            </div>
        </section>
    </div>


    <!-- Card -->
    <div class="container container1">
        <h1 class="heading fw-bold fs-1" style="text-align: center;">Our Services</h1>
        <div class="row justify-content-md-center">
            <div class="col-md">
                <a href="./product/index.php" class="nav-link">
                    <button type="button" class="btn btn-success btn-circle btn-xl">
                        <i class="fa-solid fa-cart-flatbed"></i>
                    </button>
                    <p>Product</p>
                </a>
            </div>
            <div class="col-md">
                <a href="#" class="nav-link">
                    <button type="button" class="btn btn-success btn-circle btn-xl">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>
                    <p>Pruchase</p>
                </a>
            </div>
            <div class="col-md">
                <a href="#" class="nav-link">
                    <button type="button" class="btn btn-success btn-circle btn-xl">
                        <i class="fa-brands fa-sellsy"></i>
                    </button>
                    <p>Sales</p>
                </a>
            </div>
            <div class="col-md">
                <a href="#" class="nav-link">
                    <button type="button" class="btn btn-success btn-circle btn-xl">
                        <i class="fa-solid fa-rotate-left"></i>
                    </button>
                    <p>Return</p>
                </a>
            </div>
        </div>
    </div>


</body>

</html>

<?php
require_once('footer/index.php');
?>