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
        <link rel="stylesheet" href="css/add_goods.css">
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
                            <img class="add_goods-bg" src="images/add_goods_bg.png" alt="">

                            <form action="add_goods_process.php" method="POST">
                                <fieldset>

                                    <legend>Edit Product </legend>
                                    <input type="hidden" name="id" value="<?= $product_id; ?>">
                                    <div class="filed">
                                        <label>Product Name </label>
                                        <input type="text" name="productName" value="<?= $product['product_name']; ?>">
                                    </div>
                                    <div class="filed">
                                        <label>Quantity </label>
                                        <input type="text" name="quantity" value="<?= $product['quantity']; ?>">
                                    </div>
                                    <div class="filed">
                                        <label>Unit Cost </label>
                                        <input type="text" name="unit_cost" value="<?= $product['unit_cost']; ?>">
                                    </div>
                                    <div class="filed">
                                        <label>Profit per piece </label>
                                        <input type="text" name="profit_margin" value="<?= $product['profit_margin']; ?>">
                                    </div>
                                    <div class="filed">
                                        <label>Import Location </label>
                                        <input type="text" name="import_location" value="<?= $product['import_location']; ?>">
                                    </div>
                                    <div class="filed">
                                        <label>Arrival Date </label>
                                        <input type="date" name="arrival_date" value="<?= $product['arrival_date']; ?>">
                                    </div>
                                    <div class="btns">
                                        <a href="display_goods.php">Back</a>
                                        <button type="submit" class="add" name="edit">Edit</button>
                                    </div>
                                </fieldset>
                            </form>
                    <?php
                }
            }
                    ?>
                        </div>
                    </div>
                </div>
                <!-- <div class="success_message hidden">
                    <div class="alert alert-success alert-dismissible fade show ">
                        <button class="btn-close" data-bs-dismiss="alert"></button>
                        <p><strong>Edited Successful! <i class="fa-solid fa-circle-check"></i></strong></p>
                    </div>
                </div> -->

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