<?php
ob_start();
require('C:\xampp\htdocs\Bootstrap\navbar\index.php');
include('C:\xampp\htdocs\Bootstrap\conn.php');

session_start();
if (!isset($_COOKIE['email']) && !isset($_COOKIE['pass'])) {
    header("Location: http://localhost/bootstrap/login/index.php");
    exit;
}

$email = $_COOKIE['email'];

$query_uid = "select * from user where email='$email'";
$result = mysqli_query($con, $query_uid);
$row = mysqli_fetch_row($result);
if ($row >= 0) {
    $u_id = $row[0];
    $shop = $row[1];
    $email = $row[2];
    $username = $row[3];
} else {
    echo "User ID Not found";
}


if (isset($_POST['update_btn'])) {

    $user_id = $u_id;
    $name = $_POST['uname'];
    $shop = $_POST['shop'];
    $mobile_no = $_POST['phone'];
    $state    = $_POST['state'];
    $pincode =    $_POST['pincode'];

    $fname = $_FILES['profileimg']['name'];
    $ftemp = $_FILES['profileimg']['tmp_name'];
    $path = "../Images/profile/" . $fname;

    $query_profile = "insert into profile values('$user_id','$mobile_no','$state','$pincode','$path')";
    $result_img = mysqli_query($con, $query_profile);
    $row = mysqli_affected_rows($con);

    if ($row > 0) {
        if (move_uploaded_file($ftemp, $path)) {
            echo "Img Uploaded";
        } else {
            echo "Not Uploaded";
        }
    } else {
        echo "Not Update";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .box {
            align-items: center;
            justify-content: center;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            cursor: pointer;
            display: block;
        }
    </style>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row box">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="btn btn-primary btn-file">Browse<input type="file" name="profileimg" required></span><span class="font-weight-bold"><?php echo $username; ?></span><span class="text-black-50"><?php echo $email; ?></span><span> </span></div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Details</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Name <i class="fa-solid fa-asterisk fa-2xs" style="color: #ff0000; opacity:70%;"></i></label><input type="text" class="form-control" name="uname" placeholder="Name" value="<?php echo $username; ?>" required></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Mobile Number <i class="fa-solid fa-asterisk fa-2xs" style="color: #ff0000; opacity:70%;"></i></label><input type="text" class="form-control" name="phone" minlength="10" maxlength="10" placeholder="Enter Mobile Number" value="" required></div>
                            <div class="col-md-12 mt-2"><label class="labels">Shop Name <i class="fa-solid fa-asterisk fa-2xs" style="color: #ff0000; opacity:70%;"></i></label><input type="text" class="form-control" name="shop" placeholder="Enter Shop Name" value="<?php echo $shop; ?>" required></div>
                            <div class="col-md-12 mt-2"><label class="labels">Pincode <i class="fa-solid fa-asterisk fa-2xs" style="color: #ff0000; opacity:70%;"></i></label><input type="text" class="form-control" name="pincode" minlength="6" maxlength="6" placeholder="Enter Pincode" value="" required></div>
                            <div class="col-md-12 mt-2"><label class="labels">State <i class="fa-solid fa-asterisk fa-2xs" style="color: #ff0000; opacity:70%;"></i></label><input type="text" class="form-control" name="state" placeholder="Enter State name" value="" required></div>
                            <div class="col-md-12 mt-2"><label class="labels">Email ID</label><input type="text" class="form-control" name="email" placeholder="Enter Email I'd" value="<?php echo $email; ?>" disabled></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="update_btn">Update Profile</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>