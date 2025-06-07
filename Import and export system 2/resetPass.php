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
    <link rel="stylesheet" href="css/resetPass.css">
    <title>MyWarehouse</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="reset_password.php" method="POST">
                    <h2>Reset Password</h2>
                    <div class="input-field">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" calss="username" placeholder="Username" name="username" autocapitalize="off">
                    </div>
                    <?php
                    if (isset($user_err)) {
                        echo "<sapn  class='error'>$user_err</span>";
                    }
                    ?>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="New Password" name="new_password">
                    </div>
                    <?php if (isset($password_err)) {
                        echo "<span class='error'>$password_err</span>";
                    } ?>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Confirm New Password" name="confirm_new_password">
                    </div>
                    <?php
                    if (isset($confirm_password_err)) {
                        echo "<span  calss='error'>$confirm_password_err</span>";
                    }
                    ?>
                    <input type="submit" value="Reset Password" class="btn solid">

                </form>
            </div>
        </div>
    </div>
</body>

</html>