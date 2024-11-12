<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the submitted data in the session
    $_SESSION['entries'][] = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'course' => $_POST['course'],
        'campus' => $_POST['campus']
    ];

    // Redirect to the show details page
    header('Location: showDetails.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Add Form</title>
    <?php include('../layout/style.php'); ?>
    <style>
        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298); /* Softer blue gradient */
            color: #e6e6e6;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .form-container {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(30, 44, 62, 0.85); /* Darker background with transparency */
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 22px;
            color: #87cefa; /* Light blue for headings */
            border-bottom: 2px solid #87cefa;
            padding-bottom: 10px;
        }

        .form-container label {
            display: block;
            font-size: 14px;
            margin-top: 15px;
            color: #b0c4de; /* Light steel blue for labels */
        }

        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            font-size: 15px;
            border: 1px solid #87cefa; /* Light blue border */
            border-radius: 6px;
            background-color: #f0f8ff; /* Alice blue */
            color: #333;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="number"]:focus,
        .form-container select:focus {
            outline: 2px solid #4682b4; /* Steel blue focus */
        }

        .form-container button[type="submit"],
        .form-container button[type="reset"] {
            width: 48%;
            padding: 10px;
            margin-top: 20px;
            font-size: 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: #fff;
            background: linear-gradient(135deg, #4682b4, #5f9ea0); /* Gradient for buttons */
            transition: background-color 0.3s;
        }

        .form-container button[type="submit"]:hover,
        .form-container button[type="reset"]:hover {
            background: linear-gradient(135deg, #5f9ea0, #4682b4); /* Reverse gradient on hover */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 20px;
            }

            .form-container h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .form-container h2 {
                font-size: 18px;
            }

            .form-container button[type="submit"],
            .form-container button[type="reset"] {
                width: 100%;
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
                <div class="container-fluid px-4">
                    <div class="form-container">
                        <h2>Add Form</h2>
                        <form action="" method="POST">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="Enter name" required>

                            <label for="age">Age:</label>
                            <input type="number" id="age" name="age" placeholder="Enter age" required>

                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" required>
                                <option value="">Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>

                            <label for="course">Course:</label>
                            <select name="course" id="course" required>
                                <option value="">Select course</option>
                                <option value="BSIS">BSIS</option>
                                <option value="BEED">BEED</option>
                                <option value="BSAIS">BSAIS</option>
                                <option value="POLSCI">POLSCI</option>
                                <option value="BSIT">BSIT</option>
                                <option value="BSTM">BSTM</option>
                            </select>

                            <label for="campus">Campus:</label>
                            <select name="campus" id="campus" required>
                                <option value="">Select campus</option>
                                <option value="Gasan Campus">Gasan Campus</option>
                                <option value="Torijos Campus">Torrijos Campus</option>
                                <option value="Boac Campus">Boac Campus</option>
                                <option value="Santa Cruz Campus">Santa Cruz Campus</option>
                            </select>

                            <button type="submit" name="submit">Submit</button>
                            <button type="reset">Clear</button>
                        </form>
                    </div>
                </div>
            </main>
            <?php include('../layout/footer.php'); ?>
        </div>
    </div>
    <?php include('../layout/script.php'); ?>
</body>
</html>
