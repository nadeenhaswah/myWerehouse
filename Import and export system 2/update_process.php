<?php
session_start();
include('database_connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];

    $flag = 0;



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // $id = $_SESSION['user_id'];
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        if (empty($username)) {
            $_SESSION['usererror'] = "<strong>Sorry !</strong>Please Enter The username <br>";
            $flag = 1;
        } elseif (strlen($username) < 6) {
            $_SESSION['usererror'] = " <strong>Sorry !</strong>Your username needs to have a minimum of 6 letters <br>";
            $flag = 1;
        } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
            $_SESSION['usererror'] = "<strong>Sorry !</strong>Please Enter A valid username not a number <br>";
            $flag = 1;
        }

        if (empty($email)) {
            $_SESSION['email_err'] = "<strong>Sorry !</strong>Please Enter An Email <br>";
            $flag = 1;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['email_err'] = "<strong>Sorry !</strong>Please Enter A valid Email <br>";
            $flag = 1;
        }

        if (!empty($password)) {
            $query = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $username, $email, $password, $id);
        } else {
            // $query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
            // $stmt = $conn->prepare($query);
            // $stmt->bind_param("ssi", $username, $email, $user_id);
            $_SESSION['password_err'] = "<strong>Sorry !</strong>Please Enter Password <br>";
            $flag = 1;
            // include('update_info.php');

        }
        if (empty($confirm_password)) {
            $_SESSION['confirm_password_err'] = "Please Rewrite Password <br>";
            $flag = 1;
        } elseif ($confirm_password !== $password) {
            $_SESSION['confirm_password_err']  = "Password Not Match <br>";
            $flag = 1;
        }

        if ($flag == 0) {
            $stmt->execute();
            $_SESSION['message'] = "<strong>Done</strong>You Information Updated successfully<br>";
            header("Location:update_info.php");
        } else {
            header("Location:update_info.php");
        }
    }
} else {
    header('Location:logIn.php');
    exit();
}
