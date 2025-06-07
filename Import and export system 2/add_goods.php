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
                <li><a href="#">Update Information</a></li>
                <li><a href="log_out.php">Log Out</a></li>
            </ul>
        </aside>

        <div class="container">
            <div class="row">
                <div class="col-12 goods_container">
                    <img class="add_goods-bg" src="images/add_goods_bg.png" alt="">

                    <form action="add_goods_process.php" method="POST">
                        <fieldset>
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
                            <legend>Add Product </legend>
                            <div class="filed">
                                <label>Product Name </label>
                                <input type="text" name="productName">
                            </div>
                            <div class="filed">
                                <label>Quantity </label>
                                <input type="text" name="quantity">
                            </div>
                            <div class="filed">
                                <label>Unit Cost </label>
                                <input type="text" name="unit_cost">
                            </div>
                            <div class="filed">
                                <label>Profit per piece </label>
                                <input type="text" name="profit_margin">
                            </div>
                            <div class="filed">
                                <label>Import Location </label>
                                <input type="text" name="import_location">
                            </div>
                            <div class="filed">
                                <label>Arrival Date </label>
                                <input type="date" name="arrival_date">
                            </div>
                            <div class="btns">
                                <a href="dashbord.php">Back</a>
                                <button type="submit" class="add" name="add">Add</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="success_message hidden">
            <div class="alert alert-success alert-dismissible fade show ">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <p><strong>Added Successful! <i class="fa-solid fa-circle-check"></i></strong></p>
            </div>
        </div> -->

        <script src="js/add_good.js"></script>
        <script src="js/main_dashbord.js"></script>
    </body>

    </html>
<?php

} else {
    header('location:logIn.php');
    exit();
}
?>