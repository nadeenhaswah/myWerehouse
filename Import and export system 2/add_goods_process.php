<?php
session_start();
include('database_connection.php');

if (!isset($_SESSION['id'])) {
    header("Location: logIn.php");
    exit();
}
//delete product
if (isset($_POST['delete_product'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['delete_product']);

    $query = " DELETE FROM products
    WHERE id ='$product_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        header("Location: display_goods.php");
    }
}



// update or edit prodect 
if (isset($_POST['edit'])) {


    $product_id = mysqli_real_escape_string($conn, $_POST['id']);
    // echo  $product_id;

    $product_name = htmlspecialchars($_POST['productName']);
    $quantity = intval($_POST['quantity']);
    $unit_cost = floatval($_POST['unit_cost']);
    $profit_margin = floatval($_POST['profit_margin']);
    $import_location = htmlspecialchars($_POST['import_location']);
    $arrival_date = date('Y-m-d', strtotime($_POST['arrival_date']));

    $query = "UPDATE products SET  product_name='$product_name', quantity='$quantity', unit_cost='$unit_cost',
    profit_margin='$profit_margin', import_location='$import_location', arrival_date='$arrival_date'
    WHERE id ='$product_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $_SESSION['message'] = "<strong>Done !</strong> Edited successfully";

        header("Location: display_goods.php");
    }
}



if (isset($_POST['add'])) {
    $product_name = htmlspecialchars($_POST['productName']);
    $quantity = intval($_POST['quantity']);
    $unit_cost = floatval($_POST['unit_cost']);
    $profit_margin = floatval($_POST['profit_margin']);
    $import_location = htmlspecialchars($_POST['import_location']);
    $arrival_date = date('Y-m-d', strtotime($_POST['arrival_date']));




    // if (empty($product_name) || empty($quantity) || empty($unit_cost) || empty($profit_margin) || empty($import_location) || empty($arrival_date)) {
    //     die("All fields are required.");
    // }

    $original_quantity = $quantity;
    $original_total_cost = $quantity * $unit_cost;

    $query = "INSERT INTO products (user_id, product_name, quantity, original_quantity, arrival_date, unit_cost, original_total_cost, profit_margin, import_location)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("isiisddss", $_SESSION['id'], $product_name, $quantity, $original_quantity, $arrival_date, $unit_cost, $original_total_cost, $profit_margin, $import_location);

    if ($stmt->execute()) {
        $_SESSION['message'] = "<strong>Done !</strong> Added successfully";
        header("Location:add_goods.php");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
}
