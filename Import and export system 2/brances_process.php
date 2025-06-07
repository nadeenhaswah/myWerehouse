<?php
session_start();
include('database_connection.php');
if (!isset($_SESSION['id'])) {
    header("Location: logIn.php");
    exit();
}

// update or edit branch 
if (isset($_POST['update'])) {
    $branche_id = mysqli_real_escape_string($conn, $_POST['id']);
    echo $branche_id;
    $branche_name = htmlspecialchars($_POST['branch_name']);
    echo $branche_name;
    $location = htmlspecialchars($_POST['location']);
    $manager_name = htmlspecialchars($_POST['manager_name']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $query = "UPDATE branches SET branch_name = ?, location = ?, manager_name = ?, contact_number = ? 
    WHERE id = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssi", $branche_name, $location, $manager_name, $contact_number, $branche_id);
    if ($stmt->execute()) {
        header("Location:branches.php");
        exit();
    }
}


// if ($stmt->execute()) {
//     header("Location:branches.php");
//     exit();
// } else {
//     die("Error: " . $stmt->error);
// }


//delete brance
if (isset($_POST['delete_branche'])) {
    $branche_id = mysqli_real_escape_string($conn, $_POST['delete_branche']);

    $query = " DELETE FROM branches
    WHERE id ='$branche_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        header("Location: branches.php");
    }
}



if (!isset($_SESSION['id'])) {
    header("Location: logIn.php");
    exit();
}

$flag = 0;
if (isset($_POST['Add'])) {
    $branche_name = htmlspecialchars($_POST['branch_name']);
    $location = htmlspecialchars($_POST['location']);
    $manager_name = htmlspecialchars($_POST['manager_name']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $user_id = $_SESSION['id'];

    // if (empty($branche_name) || empty($location)) {
    //     $err = "This Field required <br>";
    //     $flag = 1;
    // }

    $sql = "INSERT INTO branches (user_id,branch_name , location, manager_name,contact_number)
    VALUES ($user_id,'$branche_name','$location','$manager_name','$contact_number')";

    $stmt = mysqli_query($conn, $sql);
    if ($stmt) {
        header('Location:branches.php');
    }
    // if ($flag == 0) {


    // } else {
    //     include('branches.php');
    // }
}
