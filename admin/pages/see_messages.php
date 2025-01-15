<?php
include('../../server/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>See Messages</title>
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

        .message-container {
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

        .no-messages {
            text-align: center;
            color: #6c757d;
            font-size: 1.2rem;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h1>User Messages</h1>
    <div class="message-container">

    <?php
    // Fetch all messages from the database
    $query = "SELECT * FROM `contact_messages` ORDER BY `submitted_at` DESC";
    $result = mysqli_query($conn, $query);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-hover">';
        echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Submitted At</th></tr></thead>';
        echo '<tbody>';
        
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['email']) . '</td>';
            echo '<td>' . htmlspecialchars($row['message']) . '</td>';
            echo '<td>' . $row['submitted_at'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div class="no-messages">No messages found.</div>';
    }
    ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
