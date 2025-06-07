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
    <link rel="stylesheet" href="css/login_signup.css">
    <title>MyWarehouse</title>
</head>

<body>
    <div class="page-container">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="logo">
                            <a href="index.php"><span>My</span>Warehouse </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="panel-container">
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <div class="form-container">
                            <!-- <form action="logIn_process.php" method="POST">
                                <h2>LogIn</h2>
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
                                    <input type="password" placeholder="Password" name="password">
                                </div>
                                <?php if (isset($password_err)) {
                                    echo "<span class='error'>$password_err</span>";
                                } ?>
                                <input type="submit" value="Login" class="btn solid">
                            </form> -->
                            <form action="logIn_process.php" method="POST">
                                <h2>LogIn</h2>

                                <div class="input-field">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" id="username" class="username" placeholder="Username" name="username" autocapitalize="off" oninput="checkUsername()">
                                </div>

                                <?php
                                if (isset($user_err)) {
                                    echo "<span class='error'>$user_err</span>";
                                }
                                ?>

                                <div class="input-field">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="password" placeholder="Password" name="password" disabled>
                                </div>

                                <?php if (isset($password_err)) {
                                    echo "<span class='error'>$password_err</span>";
                                } ?>

                                <input type="submit" value="Login" class="btn solid">
                            </form>
                            <div class="no-account">
                                <p>Don't have an account ? <a href="signup.php">Register</a></p>
                            </div>
                            <a href="resetPass.php" class="forgetPass">Forget Password </a>

                        </div>
                    </div>
                    <div class="col-8">
                        <img src="images/login.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkUsername() {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');

            passwordInput.disabled = usernameInput.value.trim() === "";
        }
    </script>
</body>

</html>