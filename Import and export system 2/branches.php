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
        <link rel="stylesheet" href="css/baranches.css">
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
                <li><a href="#">Update Information</a></li>
                <li><a href="log_out.php">Log Out</a></li>
            </ul>
        </aside>
        <div class="container branchesContainer">
            <div class="row">
                <div class="col-12">
                    <div class="container headingContainer">
                        <div class="row">
                            <div class="col-12">
                                <header class="heading">
                                    <h2>Branches</h2>
                                </header>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row branchInfo">
                <div class="col-5 formContainer">
                    <form action="brances_process" method="POST">
                        <legend>Add Branche</legend>
                        <div class="filed">
                            <label>Branch Name</label>
                            <input type="text" name="branch_name">
                        </div>
                        <?php
                        if (isset($err)) {
                            echo "<sapn  class='error'>$err</span>";
                        }
                        ?>
                        <div class="filed">
                            <label>Location</label>
                            <input type="text" name="location">
                        </div>
                        <?php
                        if (isset($err)) {
                            echo "<sapn  class='error'>$err</span>";
                        }
                        ?>
                        <div class="filed">
                            <label>Manager Name</label>
                            <input type="text" name="manager_name" placeholder="Optional">
                        </div>
                        <div class="filed">
                            <label>Contact Number </label>
                            <input type="text" name="contact_number" placeholder="Optional">
                        </div>
                        <div class="btn ">
                            <button class="btn btn-outline-light" name="Add" type="submit">Add Branche</button>
                        </div>
                    </form>
                </div>
                <?php
                $query = "SELECT id,branch_name, location, manager_name, contact_number FROM branches WHERE user_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                ?>
                <div class="col-7">
                    <table class="table  table-sm table-striped table-hover" id="branchesTable">
                        <thead>
                            <tr>
                                <th>Branche Name</th>
                                <th>Branche Location</th>
                                <th>Manager Name</th>
                                <th>Contact Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['branch_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                                    <td><?php echo htmlspecialchars($row['manager_name'] ?: "N/A"); ?></td>
                                    <td><?php echo htmlspecialchars($row['contact_number'] ?: "N/A"); ?></td>
                                    <td>
                                        <a href="branches_update.php?id=<?= $row['id']; ?>" class="btn btn-edit btn-sm text-light">Update</a>

                                        <!-- <form action="brances_process.php" method="POST" class="d-inline">
                                            <button href="#" type="submit" class="btn btn-danger btn-sm text-light"
                                                name="delete_branche" value="<?= $row['id']; ?>">Delete</button>

                                        </form> -->
                                        <button class="btn btn-delete btn-sm delete-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleModal"
                                            data-branch-id="<?= $row['id']; ?>">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            <?php } ?>

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
        <!-- Modal for Delete-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header switch">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Branch</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body delete-user switch">
                        <i class="fa-regular fa-circle-xmark"></i>
                        <p>Do you really want to delete this Branch ? You won't be able to recover the data after deletion!</p>
                    </div>
                    <div class="modal-footer switch">
                        <button type="button" aria-label="Close" data-bs-dismiss="modal" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="brances_process.php" method="POST" class="d-inline">
                            <button type="submit" class="btn btn-danger btn-sm text-light"
                                name="delete_branche" id="confirmDeleteInput">Delete</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#branchesTable').DataTable({
                    "ordering": true, // لتفعيل الفرز
                    "searching": true, // لتفعيل البحث
                    "paging": false, // للتنقل بين الصفحات
                    "info": true // لإظهار معلومات عن عدد النتائج
                });
            });

            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    let branchId = $(this).data('branch-id');
                    $('#confirmDeleteInput').val(branchId);
                    $('#exampleModal').modal('show');
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