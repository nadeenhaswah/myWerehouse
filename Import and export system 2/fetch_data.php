<?php
session_start();
include('database_connection.php');

$query = "
    SELECT 
        CONCAT(branches.branch_name, ' (', branches.location, ')') AS branch_label, 
        SUM(exports.total_profit) AS total_profit 
    FROM exports 
    INNER JOIN branches ON exports.branch_id = branches.id 
    GROUP BY exports.branch_id
";

$result = $conn->query($query);

$branch_labels = [];
$branch_profits = [];

while ($row = $result->fetch_assoc()) {
    $branch_labels[] = $row['branch_label'];
    $branch_profits[] = $row['total_profit'];
}

// إعادة البيانات بصيغة JSON
echo json_encode([
    'branches' => $branch_labels, // تعديل الاسم ليطابق ما تم تعبئته
    'profits' => $branch_profits  // تعديل الاسم ليطابق ما تم تعبئته
]);
