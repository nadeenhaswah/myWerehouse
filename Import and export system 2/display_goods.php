<?php
session_start();
include('database_connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <!-- fontawesome  -->
        <script src="https://kit.fontawesome.com/3e1d046fbe.js" crossorigin="anonymous"></script>
        <!-- webSite icon  -->
        <link rel="shortcut icon" href="images/icon.png">
        <!-- main css  -->
        <link rel="stylesheet" href="css/main_dashbord.css">
        <link rel="stylesheet" href="css/display_goods.css">
        <!-- datatables  -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <title>MyWarehouse</title>
    </head>

    <body>

        <button class="sideBar-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="logo">MyWarehouse</h1>
                <button class="colse-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <ul class="links">
                <li><a href="dashbord.php">HOME</a></li>
                <li><a href="update_info.php">Update Information</a></li>
                <li><a href="log_out.php">Log Out</a></li>
            </ul>
        </aside>

        <!-- <?php
                $sql = "SELECT * FROM products WHERE user_id ='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $t = "<table><tr>";
                    while ($row = $result->fetch_assoc()) {
                        $t = $t . "<td>" . $row['id'] . "</td><td>" . $row['product_name'] . "</td></tr><tr>";
                    }
                    $t = $t . "</tr></table>";
                    echo $t;
                }
                ?> -->
        <div class="container heading">
            <div class="row">
                <div class="col-12">
                    <h2>Goods in the warehouse</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="clo-12">
                    <?php
                    if (isset($_SESSION['message'])) :
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= $_SESSION['message'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    <?php
                        unset($_SESSION['message']);
                    endif;

                    ?>
                    <table class="table table-bordered  table-hover " id="productsTable">

                        <thead>
                            <tr>
                                <th>Product Name </th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Import Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM products WHERE user_id ='$id'";
                            $query_run = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $product) {
                            ?>
                                    <tr>
                                        <td> <?= $product['product_name'] ?></td>
                                        <td> <?= $product['quantity'] ?></td>
                                        <td> <?= $product['unit_cost'] ?></td>
                                        <td> <?= $product['import_location'] ?></td>
                                        <td>
                                            <a href="product_details.php?id=<?= $product['id']; ?>" class="btn btn-readMore btn-sm">Read More</a>
                                            <a href="product_edit.php?id=<?= $product['id']; ?>" class="btn  btn-edit btn-sm">Edit</a>
                                            <!-- <form action="add_goods_process.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_product"
                                                    value="<?= $product['id']; ?>"
                                                    class="btn btn-danger btn-sm">Delete</button>

                                            </form> -->
                                            <button class="btn  btn-delete  btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#exampleModal" data-product-id="<?= $product['id']; ?>"> Delete</button>

                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid backButton">
            <div class="row">
                <div class="col-12">
                    <a href="dashbord.php">Back</a>
                </div>
            </div>
        </div>
        <!-- Modal for Delete-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header switch">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body delete-user switch">
                        <i class="fa-regular fa-circle-xmark"></i>
                        <p>Do you really want to delete this product? You won't be able to recover the data after deletion!</p>
                    </div>
                    <div class="modal-footer switch">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="add_goods_process.php" method="POST" class="d-inline">
                            <button type="submit" name="delete_product" id="confirmDeleteInput"
                                value="<?= $product['id']; ?>"
                                class="btn btn-danger btn-sm">Delete</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#productsTable').DataTable({
                    "ordering": true, // لتفعيل الفرز
                    "searching": true, // لتفعيل البحث
                    "paging": false, // للتنقل بين الصفحات
                    "info": true // لإظهار معلومات عن عدد النتائج
                });
            });

            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    let productId = $(this).data('product-id');
                    $('#confirmDeleteInput').val(productId); // تحديث قيمة المنتج المراد حذفه داخل المودال
                    $('#exampleModal').modal('show'); // عرض المودال
                });
            });
        </script>
        <script src="js/main_dashbord.js"></script>
    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}
?>