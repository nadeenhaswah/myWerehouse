<?php
session_start();
include('database_connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    // echo "Session ID: " . $id . "<br>";
    // echo "Session Username: " . $_SESSION['username'] . "<br>";

    $query = "SELECT username, email FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // if ($result->num_rows > 0) {
    //     $user = $result->fetch_assoc();
    //     echo "Username: " . $user['username'] . "<br>";
    //     echo "Email: " . $user['email'] . "<br>";
    // } else {
    //     echo "No user found with this ID.";
    // }
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
        <link rel="stylesheet" href="css/update_info.css">
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


        <div class="form-container">
            <form action="update_process.php" class="sign-up-form" method="POST">
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
                <h1 class="signupHead">Update Information</h1>
                <div class="input-field">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" calss="username" placeholder="Username" autocapitalize="off"
                        value="<?php echo htmlspecialchars($username); ?>" name="username">
                </div>
                <?php
                if (isset($_SESSION['usererror'])): ?>
                    <p class="error"><?= $_SESSION['usererror'] ?> </p>
                <?php unset($_SESSION['usererror']);
                endif; ?>

                <div class="input-field">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" calss="email" placeholder="email"
                        name="email">
                </div>

                <?php
                if (isset($_SESSION['email_err'])): ?>
                    <p class="error"><?= $_SESSION['email_err'] ?> </p>
                <?php unset($_SESSION['email_err']);
                endif; ?>

                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Password" name="password">
                </div>

                <?php
                if (isset($_SESSION['password_err'])): ?>
                    <p class="error"><?= $_SESSION['password_err'] ?> </p>
                <?php unset($_SESSION['password_err']);
                endif; ?>


                <div class="input-field">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" name="confirm_password">
                </div>
                <?php
                if (isset($_SESSION['confirm_password_err'])): ?>
                    <p class="error"><?= $_SESSION['confirm_password_err'] ?> </p>
                <?php unset($_SESSION['confirm_password_err']);
                endif; ?>

                <input type="submit" value="Update" class="btn update-btn solid">
            </form>
            <div class="back">

                <a href="dashbord.php">
                    <p>Back to the main page </p>
                </a>
            </div>
        </div>
        <!-- <div class="loading hidden">
            <div class="spinner-border text-white"></div>
        </div> -->
        <!-- <div class="success_message hidden">
            <div class="alert alert-success alert-dismissible fade show ">
                <button class="btn-close" data-bs-dismiss="alert"></button>
                <p><strong>Update Successful! <i class="fa-solid fa-circle-check"></i></strong></p>
            </div>
        </div> -->
        <script src="js/update.js"></script>

    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}



?>