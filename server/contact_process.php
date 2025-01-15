<?php
include 'connection.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      // Insert Data into Database
      $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
      $stmt->bind_param("sss", $name, $email, $message);

      if ($stmt->execute()) {
          // Redirect to the homepage after successful submission
          header('Location: ../contact.php');
          exit();
      } else {
          // Redirect back to contact page with an error message
          header('Location: contact.php?status=error');
          exit();
      }

      $stmt->close();
  }

  $conn->close();
?>