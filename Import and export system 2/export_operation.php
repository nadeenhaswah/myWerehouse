<?php
session_start();
include('database_connection.php');
if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];

?>

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
        <link rel="stylesheet" href="css/main_dashbord.css">
        <link rel="stylesheet" href="css/operation_export.css">
        <!-- datatables  -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <title>MyWarehouse</title>
    </head>

    <body>

        <button class="sideBar-toggle">
            <i class="fa-solid fa-bars"></i>
        </button>
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1 class="logo">MyWarehouse</h1>
                <button class="colse-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <ul class="links">
                <li><a href="dashbord.php">HOME</a></li>
                <li><a href="update_info.php">Update Information</a></li>
                <li><a href="log_out.php">Log Out</a></li>
            </ul>
        </aside>
        <?php

        ?>
        <?php
        // $query = "SELECT * FROM exports WHERE user_id = ?";
        // $stmt = $conn->prepare($query);
        // $stmt->bind_param("i", $_SESSION['id']);
        // $stmt->execute();
        // $result = $stmt->get_result();


        $query = "SELECT 
                    b.branch_name, b.location,
                    p.product_name, 
                    e.quantity, 
                    e.total_cost, 
                    e.total_profit, 
                    e.arrival_date, 
                    e.created_at
                FROM exports e
                INNER JOIN branches b ON e.branch_id = b.id
                INNER JOIN products p ON e.product_id = p.id
                WHERE e.user_id = ?
            ";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_SESSION['id']); // تحديد المستخدم الحالي
        $stmt->execute();
        $result = $stmt->get_result();

        ?>
        <div class="container containerOperationExport">
            <div class="row">
                <div class="col-12">
                    <table class="table  table-bordered table-hover table-striped" id="exportsTable">
                        <thead>
                            <tr>
                                <th class="table-warning">Branch Name</th>
                                <th class="table-warning">Product Name</th>
                                <th class="table-warning">Product Quantity</th>
                                <th class="table-warning">Total Cost </th>
                                <th class="table-warning">Total Profit </th>
                                <th class="table-warning">Delivery time </th>
                                <th class="table-warning">Data entry date </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>

                                    <td><?php echo htmlspecialchars($row['branch_name']) . "-" . htmlspecialchars($row['location']); ?></td>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars(number_format($row['total_cost'], 2)); ?> </td>
                                    <td><?php echo htmlspecialchars(number_format($row['total_profit'], 2)); ?> </td>
                                    <td><?php echo htmlspecialchars($row['arrival_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="container-fluid backButton">
            <div class="row">
                <div class="col-12">
                    <a href="dashbord.php">Back</a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#exportsTable').DataTable({
                    "ordering": true, // لتفعيل الفرز
                    "searching": true, // لتفعيل البحث
                    "paging": false, // للتنقل بين الصفحات
                    "info": true // لإظهار معلومات عن عدد النتائج
                });
            });
        </script>
        <script src="js/main_dashbord.js"></script>
    </body>

    </html>
<?php

} else {
    header('Location:logIn.php');
    exit();
}
?>