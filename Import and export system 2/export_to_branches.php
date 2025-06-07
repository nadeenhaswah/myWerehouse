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
        <link rel="stylesheet" href="css/export_to_branches.css">
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
        // echo $_SESSION['id'];
        // echo $_SESSION['username'];
        // $user_id = $_SESSION['id'];

        // $sql = "SELECT * FROM branches
        // WHERE user_id ='$user_id'";

        // $result = mysqli_query($conn, $sql);

        // if (mysqli_num_rows($result) > 0) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         echo $row['id'] . "<br>";
        //         echo $row['user_id'] . "<br>";
        //         echo $row['branch_name'] . "<br>";
        //         echo $row['location'] . "<br>";
        //     }
        // }

        // $sql = "SELECT * FROM products
        // WHERE user_id ='$user_id'";

        // $result = mysqli_query($conn, $sql);

        // if (mysqli_num_rows($result) > 0) {
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         echo $row['product_name'] . " : " . $row['quantity'] . "<br>";
        //     }
        // }

        ?>

        <div class="container headingContainer">
            <div class="row">
                <div class="col-12">
                    <div class="heading">
                        <h2>Export to Branches</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p>Please select the branch you want to export the goods to from the list : </p>
                </div>
                <div class="col-6">
                    <form action="export_process.php" method="POST">
                        <select id="branchList" name="branch_id" class="form-select " aria-label="Default select example" required>
                            <option value="">Select Branch</option>
                            <?php
                            $query = "SELECT id, branch_name, location FROM branches WHERE user_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $_SESSION['id']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['id'] . "'>" . $row['branch_name'] . " - " . $row['location'] . "</option>";
                                $_SESSION['branch_selected'] = $row['branch_name'];
                            }
                            ?>
                        </select>
                        <button type="submit" name="select_branch" class="btn btn-outline-secondary">GO</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid video-container">
            <video autoplay loop muted>
                <source src="images/video.mp4">
            </video>
        </div>
        <div class="container-fluid backButton">
            <div class="row">
                <div class="col-12">
                    <a href="dashbord.php">Back</a>
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