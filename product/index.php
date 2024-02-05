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

$query_uid = "select id from user where email='$email'";
$result = mysqli_query($con, $query_uid);
$row = mysqli_fetch_row($result);
if ($row >= 0) {
    $u_id = $row[0];
} else {
    echo "User ID Not found";
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CDN Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CDN Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <title>Product</title>

    <style>
        .table_data {
            margin-top: 60px;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <!-- Sweet alert start -->
    <?php
    // session_start();
    if (isset($_SESSION['product_message']) && $_SESSION['product_message'] != '') {
        if (isset($_SESSION['product_message']) && $_SESSION['product_message'] == 'Product Added Successfully!') {
    ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['product_message']; ?>',
                }).then(function() {
                    location.reload();
                });
            </script>
        <?php
            unset($_SESSION['product_message']);
        } else {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['product_message']; ?>',
                });
            </script>
        <?php
            unset($_SESSION['product_message']);
        }
    }


    if (isset($_SESSION['message']) && $_SESSION['message'] != '') {
        if (isset($_SESSION['message']) && $_SESSION['message'] == 'Product Update Successfully!') {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['message']; ?>',
                }).then(function() {
                    location.reload();
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
                    text: '<?php echo $_SESSION['message']; ?>',
                }).then(function() {
                    location.reload();
                });
            </script>
        <?php
            unset($_SESSION['message']);
        }
    }

    if (isset($_SESSION['delete_message']) && $_SESSION['delete_message'] != '') {
        if (isset($_SESSION['delete_message']) && $_SESSION['delete_message'] == 'Product Deleted Successfully!') {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['delete_message']; ?>',
                }).then(function() {
                    location.reload();
                });
            </script>
        <?php
            unset($_SESSION['delete_message']);
        } else {
        ?>
            <script>
                Swal.fire({
                    icon: '<?php echo $_SESSION['icon']; ?>',
                    title: '<?php echo $_SESSION['title']; ?>',
                    text: '<?php echo $_SESSION['delete_message']; ?>',
                }).then(function() {
                    location.reload();
                });
            </script>
    <?php
            unset($_SESSION['delete_message']);
        }
    }
    ?>
    <!-- Sweet alert end -->


    <!-- Modal start For Add Product -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="command.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">User Email</label>
                            <input type="text" value="<?php echo $email; ?>" class="form-control" name="u_email" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User ID</label>
                            <input type="text" value="<?php echo $u_id; ?>" class="form-control" name="u_id" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="p_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="number" class="form-control" name="p_qty" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mode of Sell</label>
                            <select class="form-select" name="p_mos" required>
                                <option value="pieces" selected>Pieces</option>
                                <option value="kg">K.g</option>
                                <option value="liter">Liter</option>
                            </select>
                        </div>
                        <input type="submit" name="btn_product_add" class="btn btn-primary" value="Add">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End For Add Product -->


    <!-- Modal start For Edit Product -->
    <div class="modal fade" id="edit_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="command.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">User Email</label>
                            <input type="text" value="<?php echo $email; ?>" class="form-control" name="u_email" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product ID</label>
                            <input type="text" id="id" class="form-control" name="p_id" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="p_name" id="p_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Qty</label>
                            <input type="text" class="form-control" name="p_qty" id="p_qty" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mode of Sell</label>
                            <select class="form-select" name="p_mos" id="p_type" required>
                                <option value="pieces" selected>Pieces</option>
                                <option value="kg">K.g</option>
                                <option value="liter">Liter</option>
                            </select>
                        </div>
                        <input type="submit" name="btn_product_edit" class="btn btn-primary" value="Update Product">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End For Edit Product -->


    <!-- Modal start For Delete Product -->
    <div class="modal fade" id="delete_product" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="command.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="delete_p_id" id="d_id">
                        <h4>Are you sure? delete this product?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" name="yes_btn" data-bs-dismiss="modal">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End For Delete Product -->


    <!-- Table Start -->
    <div class="table_data">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product
                                <div class="float-end">
                                    <input class="form-control-sm" style="margin-right: 20px;" type="text" placeholder="Search">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Add Product
                                    </button>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Qty</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select id,product_name,qty,typeofsell from product where user_id='$u_id'";
                                    $product_show_result = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_row($product_show_result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row[0] . "</td>";
                                        echo "<td>" . $row[1] . "</td>";
                                        echo "<td>" . $row[2] . "</td>";
                                        echo "<td>" . $row[3] . "</td>";
                                        echo "<td> 
                                                <button type='button' class='btn btn-success btn-sm editbtn' data-bs-toggle='modal' data-bs-target='#edit_product'>Edit</button>
                                                <button type='button' class='btn btn-danger btn-sm deletebtn' data-bs-toggle='modal' data-bs-target='#delete_product'>Delete</button>
                                             </td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->


    <script>
        $(document).ready(function() {
            $('.editbtn').on('click', function() {
                $('#edit_product').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                // console.log(data);
                $('#id').val(data[0]);
                $('#p_name').val(data[1]);
                $('#p_qty').val(data[2]);
                $('#p_type').val(data[3]);
            });

            $('.deletebtn').on('click', function() {
                $('#delete_product').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();

                // console.log(data);
                $('#d_id').val(data[0]);
            });
        });
    </script>
</body>

</html>

<?php
require('C:\xampp\htdocs\Bootstrap\footer\index.php');
?>