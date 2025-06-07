<?php
session_start();
include('database_connection.php');


if (isset($_POST['branch_id'])) {
    $branch_id = $_POST['branch_id'];


    $query = "SELECT * FROM branches WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $branch_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $branch = $result->fetch_assoc();

    $_SESSION['branch_id-selected'] = $branch['id'];
    $_SESSION['branch-selected'] = $branch['branch_name'];
    $_SESSION['branch-location'] = $branch['location'];
    // echo   $branch['branch_name'];
    // echo  $_SESSION['branch-selected'];

    header('Location:select_goods_to_export.php');
}

// if(isset($_POST['sava_export'])){

//     $user_id = $_SESSION['id']; 
//     $product_ids = $_POST['product_id'];
//     $arrival_dates = $_POST['arrival_date'];
//     $quantities = $_POST['quantity'];
//     $total_costs = $_POST['total_cost'];
//     $total_profits = $_POST['total_profit'];

//     for ($i = 0; $i < count($product_ids); $i++) {
//         $product_id = $product_ids[$i];
//         $arrival_date = $arrival_dates[$i];
//         $quantity = $quantities[$i];
//         $total_cost = $total_costs[$i];
//         $total_profit = $total_profits[$i];


//     $query = "INSERT INTO exports (user_id, product_id, branch_id, arrival_date, quantity, total_cost, total_profit)
//         VALUES (?, ?, ?, ?, ?, ?, ?)";
// $stmt = $conn->prepare($query);
// $stmt->bind_param("iiisidd", $user_id, $product_id, $branch_id, $arrival_date, $quantity, $total_cost, $total_profit);

// if ($stmt->execute()) {
//     echo "Export record inserted successfully!";
// } else {
//     echo "Error: " . $stmt->error;
// }
//     }
// }
// else {
//     echo "Invalid request method!";
// }

if (isset($_POST['sava_export'])) {
    $branch_id = $_POST['branch_id'];
    $user_id = $_SESSION['id']; // الحصول على معرف المستخدم من الجلسة
    $product_ids = $_POST['product_id'];
    $arrival_dates = $_POST['arrival_date'];
    $quantities = $_POST['quantity'];
    $total_costs = $_POST['total_cost'];
    $total_profits = $_POST['total_profit'];

    // التحقق من أن جميع الحقول موجودة ولها نفس العدد من العناصر
    if (
        count($product_ids) === count($arrival_dates) &&
        count($arrival_dates) === count($quantities) &&
        count($quantities) === count($total_costs) &&
        count($total_costs) === count($total_profits)
    ) {
        for ($i = 0; $i < count($product_ids); $i++) {
            $product_id = $product_ids[$i];
            $arrival_date = $arrival_dates[$i];
            $quantity = $quantities[$i];
            $total_cost = $total_costs[$i];
            $total_profit = $total_profits[$i];



            // التحقق من كمية المنتج المتوفرة في المخزون
            $query = "SELECT * FROM products WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            if (!$product) {
                echo "Product not found!";
                exit;
            }


            $product_name = $product['product_name'];


            $available_quantity = $product['quantity'];

            if ($quantity > $available_quantity) {
                $_SESSION['message'] = " <strong>Sorry !</strong> Error: Requested quantity ($quantity) exceeds available stock ($available_quantity) for product  $product_name!";
                exit;
            }

            // خصم الكمية المطلوبة من الكمية المتوفرة
            $new_quantity = $available_quantity - $quantity;
            $update_query = "UPDATE products SET quantity = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ii", $new_quantity, $product_id);
            if (!$update_stmt->execute()) {
                echo "Error updating product stock: " . $update_stmt->error;
                exit;
            }





            // إدخال البيانات في جدول exports
            $query = "INSERT INTO exports (user_id, product_id, branch_id, arrival_date, quantity, total_cost, total_profit)
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("iiisidd", $user_id, $product_id, $branch_id, $arrival_date, $quantity, $total_cost, $total_profit);

            if (!$stmt->execute()) {
                echo "Error inserting record: " . $stmt->error;
                exit;
            }
        }

        $_SESSION['message'] = "<strong>Done !</strong> All export records inserted successfully!";
    } else {
        echo "Form data is inconsistent. Please check your inputs!";
        exit;
    }
} else {
    echo "Invalid request method!";
}
