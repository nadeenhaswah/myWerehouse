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
        <link rel="stylesheet" href="css/product_details.css">
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
        <?php
        if (isset($_GET['id'])) {
            $product_id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM products WHERE user_id ='$id' and id='$product_id'";
            $query_run = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query_run) > 0) {
                $product = mysqli_fetch_array($query_run);
        ?>

                <div class="container">
                    <div class="row">
                        <div class="col-12 goods_container">
                            <!-- <img class="add_goods-bg" src="images/add_goods_bg.png" alt=""> -->
                            <h2 class="heading">Product details</h2>

                            <div class="product_details_container">

                                <table class="table table-hover table-warning table-striped">
                                    <tr>
                                        <th>Product Name </th>
                                        <td><?= $product['product_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Quantity </th>
                                        <td><?= $product['quantity']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>The number before any export process </th>
                                        <td><?= $product['original_quantity']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price is per piece </th>
                                        <td><?= $product['unit_cost']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price for all parts before any export process </th>
                                        <td><?= $product['original_total_cost']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Profit per piece </th>
                                        <td><?= $product['profit_margin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Profit for all piece </th>
                                        <td><?= $product['total_profit']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Import Location </th>
                                        <td><?= $product['import_location']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date of arrival of goods</th>
                                        <td><?= $product['arrival_date']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Data entry date</th>
                                        <td><?= $product['created_at']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>The date the data was last updated</th>
                                        <td><?= $product['updated_at']; ?></td>
                                    </tr>

                                </table>

                            </div>
                        </div>




                <?php
            }
        }
                ?>
                    </div>
                </div>


                <div class="container-fluid backButton">
                    <div class="row">
                        <div class="col-12">
                            <a href="display_goods.php">Back</a>
                        </div>
                    </div>
                </div>
                <script src="js/add_good.js"></script>
                <script src="js/main_dashbord.js"></script>
    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}
?>