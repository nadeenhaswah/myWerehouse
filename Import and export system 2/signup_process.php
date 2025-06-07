<?php
include('database_connection.php');

$username = $email = $password = $confirm_password = "";
$user_err = $email_err = $password_err = $confirm_password_err = "";
$flag = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars(strtolower($_POST['username']));
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);


    if (empty($username)) {
        $user_err = "Please Enter The username <br>";
        $flag = 1;
    } elseif (strlen($username) < 6) {
        $user_err = " Your username needs to have a minimum of 6 letters <br>";
        $flag = 1;
    } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
        $user_err = "Please Enter A valid username not a number <br>";
        $flag = 1;
    }

    $check_user = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_user);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) {
        $user_err = " sorry username already exists";
        $flag = 1;
    }

    if (empty($email)) {
        $email_err = "Please Enter An Email <br>";
        $flag = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please Enter A valid Email <br>";
        $flag = 1;
    }

    if (empty($password)) {
        $password_err = "Please Enter Password <br>";
        $flag = 1;
        // include('signup.php');
    } elseif (strlen($password) < 6) {
        $password_err = " Your password needs to have a minimum of 6 letters <br>";
        $flag = 1;
        // include('signup.php');
    }

    if (empty($confirm_password)) {
        $confirm_password_err = "Please Rewrite Password <br>";
        $flag = 1;
        include('signup.php');
    } elseif ($confirm_password !== $password) {
        $confirm_password_err = "Password Not Match <br>";
        $flag = 1;
    }
}
if ($flag == 0) {
    $stmt = $conn->prepare("INSERT INTO  users (username,email,password)
        VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();

    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // $sql = "INSERT INTO users (username,email,password,confirm_password)
    // VALUES ('$username','$email',' $hashed_password','$confirm_password')";
    // mysqli_query($conn, $sql);
    header('location:logIn.php');
} else {
    include('signup.php');
}
