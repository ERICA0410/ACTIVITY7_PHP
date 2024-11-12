<?php
session_start();

// Check if email and password are set in the session
if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
    header('location:../login.php');
    exit();
}

// Initialize session variable to store entries if it doesn't exist
if (!isset($_SESSION['entries'])) {
    $_SESSION['entries'] = [];
}

// Check if a delete request has been made
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteIndex = (int)$_GET['delete'];
    if (isset($_SESSION['entries'][$deleteIndex])) {
        unset($_SESSION['entries'][$deleteIndex]);
        $_SESSION['entries'] = array_values($_SESSION['entries']);
    }
}

// Check if an update request has been made
if (isset($_GET['update']) && is_numeric($_GET['update'])) {
    $updateIndex = (int)$_GET['update'];
    $updateEntry = $_SESSION['entries'][$updateIndex]; // Get the entry to update
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Student Details</title>
    <?php include('../layout/style.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Softer blue gradient */
            color: #e6e6e6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: rgba(30, 44, 62, 0.85); /* Darker background with transparency */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
        }

        .table-container h2 {
            font-size: 26px;
            color: #87cefa; /* Light blue for headings */
            margin-bottom: 20px;
            border-bottom: 2px solid #87cefa;
            padding-bottom: 10px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
        }

        .table-container th, .table-container td {
            padding: 12px;
            text-align: left;
        }

        .table-container th {
            background-color: #4682b4;
            color: #fff;
        }

        .table-container td {
            background-color: rgba(0, 0, 0, 0.2);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-update {
            background-color: #f39c12;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn-update:hover {
            background-color: #e67e22;
        }

        /* Modal Styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            .table-container {
                padding: 20px;
                margin: 20px;
            }

            .btn-update, .btn-delete {
                width: 100%;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <?php include('../layout/header.php'); ?>

    <div id="layoutSidenav">
        <?php include('../layout/navigation.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="table-container">
                    <h2>Student Information</h2>
                    <table id="datatablesSimple" class="display">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Course</th>
                                <th>Campus</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['entries'] as $index => $entry): ?>
                                <tr>
                                    <td><?php echo $entry['name']; ?></td>
                                    <td><?php echo $entry['age']; ?></td>
                                    <td><?php echo $entry['gender']; ?></td>
                                    <td><?php echo $entry['course']; ?></td>
                                    <td><?php echo $entry['campus']; ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Update Button (opens modal) -->
                                            <button class="btn btn-update" onclick="openModal(<?php echo $index; ?>)">Update</button>
                                            <!-- Delete Button -->
                                            <a href="?delete=<?php echo $index; ?>" onclick="return confirm('Are you sure you want to delete this entry?');">
                                                <button class="btn btn-delete">Delete</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>

    <!-- Modal for Updating Student Info -->
    <div id="updateModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Update Student Information</h2>
            <?php if (isset($updateEntry)): ?>
                <form method="POST" action="update-entry.php?index=<?php echo $updateIndex; ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $updateEntry['name']; ?>" required><br><br>
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="<?php echo $updateEntry['age']; ?>" required><br><br>
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" required>
                        <option value="Male" <?php echo ($updateEntry['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($updateEntry['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select><br><br>
                    <label for="course">Course:</label>
                    <input type="text" id="course" name="course" value="<?php echo $updateEntry['course']; ?>" required><br><br>
                    <label for="campus">Campus:</label>
                    <input type="text" id="campus" name="campus" value="<?php echo $updateEntry['campus']; ?>" required><br><br>
                    <button type="submit" class="btn btn-update">Update</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../layout/script.php'); ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable();
        });

        // Open the modal for updating
        function openModal(index) {
            var modal = document.getElementById('updateModal');
            modal.style.display = "block";
            // You can pass the index and use it to fetch data or handle it in a form
        }

        // Close the modal
        function closeModal() {
            var modal = document.getElementById('updateModal');
            modal.style.display = "none";
        }

        // Close modal if clicked outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('updateModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
