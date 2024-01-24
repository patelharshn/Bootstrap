<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CDN Css Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- CDN Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        if (isset($_SESSION['message']) && $_SESSION['message'] == 'Login Successfully!') {
            setcookie("email", $_SESSION['email'], time() + 3600 * 24 ,"/");
            setcookie("pass", $_SESSION['pass'], time() + 3600 * 24,"/");
            ?>
                <script>
                    Swal.fire({
                        icon: '<?php echo $_SESSION['icon']; ?>',
                        title: '<?php echo $_SESSION['title']; ?>',
                        text: '<?php echo $_SESSION['message']; ?>',
                     }).then(function() {
                        window.location.href = "http://localhost/bootstrap/index.php";
                    });
                </script>
            <?php
            unset($_SESSION['message']);
        } else {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['message'] ?>',
                });
            </script>
    <?php
            unset($_SESSION['message']);
        }
    }
    ?>
    <section class="vh-100 mt-56" style="background-color: #eeee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign In</p>

                                    <form class="mx-1 mx-md-4" action="sql.php" method="post">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <?php
                                                if (isset($_SESSION['email'])) {
                                                ?>
                                                    <input type="email" id="form3Example3c" name="mail" value="<?php echo $_SESSION['email'];?>" class="form-control" required />
                                                <?php
                                                    unset($_SESSION['email']);
                                                } else {
                                                ?>
                                                    <input type="email" id="form3Example3c" name="mail" value="" class="form-control" required />
                                                <?php
                                                }
                                                ?>
                                                <!-- <input type="email" id="form3Example3c" name="mail" class="form-control" required /> -->
                                                <label class="form-label" for="form3Example3c">Email</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">

                                                <?php
                                                if (isset($_SESSION['pass'])) {
                                                ?>
                                                    <input type="password" id="form3Example4c" class="form-control" value="<?php echo $_SESSION['pass']; ?>" name="passs" required />
                                                <?php
                                                    unset($_SESSION['pass']);
                                                } else {
                                                ?>
                                                    <input type="password" id="form3Example4c" class="form-control" value="" name="passs" required />
                                                <?php
                                                }
                                                ?>
                                                <!-- <input type="password" id="form3Example4c" class="form-control" name="passs" required /> -->
                                                <label class="form-label" for="form3Example4c">Password</label>
                                            </div>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <!-- <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required /> -->
                                            <label class="form-check-label" for="form2Example3">
                                                New User? <a href="../signup/index.php">Create a new account</a>
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg" name="loginbtn">Login</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="../Images/logo.webp" class="img-fluid" alt="IMS">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script CDN Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>