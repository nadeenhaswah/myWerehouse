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

                            <form action="signup_process.php" class="sign-up-form" method="POST">
                                <h1 class="signupHead">Sign Up</h1>

                                <div class="input-field">
                                    <i class="fa-regular fa-user"></i>
                                    <input type="text" id="username" class="username" placeholder="Username" autocapitalize="off" name="username" oninput="checkUsername()">
                                </div>

                                <?php
                                if (isset($user_err)) {
                                    echo "<span class='error'>$user_err</span>";
                                }
                                ?>

                                <div class="input-field">
                                    <i class="fa-regular fa-envelope"></i>
                                    <input type="email" id="email" class="email" placeholder="Email" name="email" disabled oninput="checkEmail()">
                                </div>

                                <?php
                                if (isset($email_err)) {
                                    echo "<span class='error'>$email_err</span>";
                                }
                                ?>

                                <div class="input-field">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="password" placeholder="Password" name="password" disabled oninput="checkPassword()">
                                </div>

                                <?php if (isset($password_err)) {
                                    echo "<span class='error'>$password_err</span>";
                                } ?>

                                <div class="input-field">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="confirm_password" placeholder="Confirm Password" name="confirm_password" disabled>
                                </div>

                                <?php
                                if (isset($confirm_password_err)) {
                                    echo "<span class='error'>$confirm_password_err</span>";
                                }
                                ?>

                                <input type="submit" value="SignUp" class="btn SignUpbtn solid">
                            </form>

                        </div>
                    </div>
                    <div class="col-8">
                        <img src="images/signup.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkUsername() {
            const username = document.getElementById('username').value.trim();
            document.getElementById('email').disabled = username === "";
            if (username === "") {
                // تعطيل باقي الحقول إذا حذف الاسم
                document.getElementById('password').disabled = true;
                document.getElementById('confirm_password').disabled = true;
            }
        }

        function checkEmail() {
            const email = document.getElementById('email').value.trim();
            document.getElementById('password').disabled = email === "";
            if (email === "") {
                document.getElementById('confirm_password').disabled = true;
            }
        }

        function checkPassword() {
            const password = document.getElementById('password').value.trim();
            document.getElementById('confirm_password').disabled = password === "";
        }
    </script>
</body>

</html>