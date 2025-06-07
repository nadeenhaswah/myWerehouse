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
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="options">
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option1.png" alt="">
                            </div>
                            <a href="add_goods.php">Add Goods</a>
                        </div>
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option2.png" alt="">
                            </div>
                            <a href="display_goods.php">Disply Goods</a>
                        </div>
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option3.png" alt="">
                            </div>
                            <a href="branches.php">Branches</a>
                        </div>
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option4.png" alt="">
                            </div>
                            <a href="export_to_branches.php">Export To Branches</a>
                        </div>
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option6.png" alt="">
                            </div>
                            <a href="export_operation.php">Export operation</a>
                        </div>
                        <div class="option">
                            <div class="bg-img">
                                <img src="images/option5.png" alt="">
                            </div>
                            <a href="statistics.php">Statistics</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/main_dashbord.js"></script>
    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}
?>