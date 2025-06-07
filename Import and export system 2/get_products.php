<?php
session_start();
include 'database_connection.php';

$query = "SELECT * FROM products WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();

$options = "<option value=''>Select product</option>";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row['id'] . "' 
                    data-unit-price='" . $row['unit_cost'] . "' 
                    data-profit-per-piece='" . $row['profit_margin'] . "'>"
        . $row['product_name'] .
        "</option>";
}
echo $options;
