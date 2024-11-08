<?php
session_start();
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('Location: ../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store form data in session variable
    $_SESSION['students'][] = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender']
    ];

    // Redirect to the ShowDetails.php page after form submission
    header('Location: showdetails.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard</title>
    <?php include('../layout/style.php'); ?>
</head>
<body class="sb-nav-fixed">

    <?php include('../layout/header.php'); ?>

    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Add Form</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Add Form</li>
                    </ol>
                    <div class="card mb-4" style="width: 500px">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Add User Information
                        </div>
                        <div class="card-body">
                            <!-- Start of the form -->
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" required>
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <!-- End of the form -->
                        </div>
                    </div>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>
</body>
</html>
