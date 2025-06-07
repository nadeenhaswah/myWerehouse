<?php
include('database_connection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = htmlspecialchars(strtolower($_POST['username']));
    $password = htmlspecialchars($_POST['password']);
}

if (empty($username)) {
    $user_err = "Please Enter The username <br>";
    $flag = 1;
}

// $check_user = "SELECT * FROM users WHERE username='$username'";
// $check_result = mysqli_query($conn, $check_user);
// $num_rows = mysqli_num_rows($check_result);
// if ($num_rows == 0) {
//     $user_err = "Not found username";
//     $flag = 1;
// }

if (empty($password)) {
    $password_err = "Please Enter Password <br>";
    $flag = 1;
    include('logIn.php');
} else {
    // include('logIn.php');
}


// if (!isset($flag)) {
//     $sql = "SELECT id,username,password,email FROM users WHERE username = '$username' AND password = '$password'";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);

//     if ($row['username'] === $username && $row['password'] === $password) {
//         $_SESSION['username'] = $row['username'];
//         $_SESSION['id'] = $row['id'];
//         header('Location:dashbord.php');
//         exit();
//     } else {
//         $user_err = "Wrong password or username";
//         include('logIn.php');
//         exit();
//     }
// }
if (!isset($flag)) {
    $sql = "SELECT id, username, password, email FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['username'] === $username && $row['password'] === $password) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header('Location:dashbord.php');
            exit();
        } else {
            $user_err = "Wrong password or username";
            include('logIn.php');
            exit();
        }
    } else {
        $user_err = "Wrong password or username";
        include('logIn.php');
        exit();
    }
}
