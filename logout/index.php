<?php
session_destroy();
setcookie("email", $_SESSION['email'], time() - 3600 * 24, "/");
setcookie("pass", $_SESSION['pass'], time() - 3600 * 24, "/");

header("Location: http://localhost/bootstrap/login");