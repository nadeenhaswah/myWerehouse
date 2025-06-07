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
        <link rel="stylesheet" href="css/export_goods.css">
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
        <div class="container headingContainer">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2> Export Goods To <?php echo  $_SESSION['branch-selected'] . "  - " . $_SESSION['branch-location'];
                                                ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container formContainer">
            <div class="row exportRow">
                <div class="col-11">
                    <form action="export_process.php" method="POST">
                        <div id="exportFields">
                            <div class="inputs">
                                <div class="input">
                                    <label>Product Name</label>
                                    <select name="product_id[]" class="form-select " onchange="updatePrice(this)" aria-label="Default select example" required>
                                        <option value="">Select product</option>
                                        <?php
                                        $query = "SELECT * FROM products WHERE user_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("i", $_SESSION['id']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        // while ($row = $result->fetch_assoc()) {
                                        //     echo "<option value='" . $row['id'] . "'>" . $row['product_name'] .  "</option>";
                                        //     // $_SESSION['product_selected'] = $row['product_name'];
                                        // }
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "' 
                                                        data-unit-price='" . $row['unit_cost'] . "' 
                                                        data-profit-per-piece='" . $row['profit_margin'] . "'>"
                                                . $row['product_name'] .
                                                "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input">
                                    <label>Arrival Date</label>
                                    <input type="date" name="arrival_date[]">
                                </div>
                                <div class="input">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity[]" min="1">
                                </div>
                                <div class="input">
                                    <label>Total Cost</label>
                                    <input type="text" name="total_cost[]" readonly>
                                </div>
                                <div class="input">
                                    <label>Total Profit</label>
                                    <input type="text" name="total_profit[]" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-1">
                    <i class="fa-solid fa-circle-plus add-product" onclick="addRow()"></i>
                    <i class="fa-solid fa-circle-minus delete-product" onclick="removeRow(this)"></i>
                </div>
            </div>
        </div> -->
        <div class="container formContainer">
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
            <form action="export_process.php" method="POST" id="exportForm">
                <div id="exportContainer">

                    <div class="row exportRow">
                        <div class="col-11">
                            <div class="inputs">
                                <div class="input">
                                    <input type="hidden" name="branch_id" value="<?php echo $_SESSION['branch_id-selected']; ?>">

                                    <label>Product Name</label>
                                    <select name="product_id[]" class="form-select" onchange="updatePrice(this)" required>
                                        <option value="">Select product</option>
                                        <?php
                                        $query = "SELECT * FROM products WHERE user_id = ?";
                                        $stmt = $conn->prepare($query);
                                        $stmt->bind_param("i", $_SESSION['id']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "' 
                                                data-unit-price='" . $row['unit_cost'] . "' 
                                                data-profit-per-piece='" . $row['profit_margin'] . "'>"
                                                . $row['product_name'] .
                                                "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input">
                                    <label>Arrival Date</label>
                                    <input type="date" name="arrival_date[]">
                                </div>
                                <div class="input">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity[]" min="1" oninput="calculateTotal(this)">
                                </div>
                                <div class="input">
                                    <label>Total Cost</label>
                                    <input type="text" name="total_cost[]" readonly>
                                </div>
                                <div class="input">
                                    <label>Total Profit</label>
                                    <input type="text" name="total_profit[]" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <i class="fa-solid fa-circle-plus add-product" onclick="addRow()"></i>
                            <i class="fa-solid fa-circle-minus delete-product" onclick="removeRow(this)"></i>
                        </div>
                    </div>
                </div>
                <div class="submit-container">
                    <button type="submit" class="btn btn-outline-secondary" name="sava_export">Save Exports</button>
                </div>
            </form>
        </div>
        <!-- <div class="container-fluid backButton">
            <div class="row">
                <div class="col-12">
                    <a href="export_to_branches.php">Back</a>
                </div>
            </div>
        </div> -->
        <a href="export_to_branches.php" class="backButton">Back</a>

        <script src="js/main_dashbord.js"></script>
        <script src="js/export_goods.js"></script>
    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}
?>