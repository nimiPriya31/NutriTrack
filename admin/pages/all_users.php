<?php
include('../../server/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        h1 {
            text-align: center;
            color: #343a40;
            margin: 20px 0;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background-color: #007bff;
            color: blue;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f3f5;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .no-users {
            text-align: center;
            color: #6c757d;
            font-size: 1.2rem;
            margin: 20px 0;
        }

        /* Pagination buttons */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #007bff;
            text-decoration: none;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h1>All Users</h1>
    <div class="table-container">

    <?php
    // Fetch all users from the database
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $query);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover">';
        echo '<thead><tr><th>ID</th><th>Full Name</th><th>Username</th><th>Email</th><th>Created At</th></tr></thead>';
        echo '<tbody>';
        
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['fullname'] . '</td>';
            echo '<td>' . $row['username'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['created_at'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="no-users">No users found.</div>';
    }
    ?>

    </div>

   
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
