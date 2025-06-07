<?php
session_start();
include('database_connection.php');
$flag = 0;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $newPass = $_POST['new_password'];
    $ConfirmNewPass = $_POST['confirm_new_password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        if (empty($newPass)) {
            $password_err = "Please Enter Password <br>";
            $flag = 1;
            // include('signup.php');
        } elseif (strlen($newPass) < 6) {
            $password_err = " Your password needs to have a minimum of 6 letters <br>";
            $flag = 1;
            // include('signup.php');
        }

        if (empty($ConfirmNewPass)) {
            $confirm_password_err = "Please Rewrite Password <br>";
            $flag = 1;
            include('signup.php');
        } elseif ($ConfirmNewPass !== $newPass) {
            $confirm_password_err = "Password Not Match <br>";
            $flag = 1;
        }


        $updateQuery = "UPDATE users SET password = ? WHERE username = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param('ss', $newPass, $username);

        if ($stmt->execute()) {
            header('location:logIn.php');
        }
    } else {
        $user_err = "Username not found.";
        $flag = 1;
    }

    if ($flag == 0) {

        header('location:logIn.php');
    } else {
        include('resetPass.php');
    }
}
