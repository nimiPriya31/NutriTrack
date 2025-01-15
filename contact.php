<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NutriTracks - Contact</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="contact.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="c_script.js" defer></script>
  </head>
  <body>
    <header class="d-flex align-items-center justify-content-between bg-white p-3 shadow-sm">
      <div class="logo">
        <i class="fas fa-leaf text-success"></i>
        <h1 class="mb-0">NutriTracks</h1>
      </div>
      <nav class="d-flex justify-content-center flex-grow-1">
        <ul class="nav justify-content-center">
          <li class="nav-item"><a href="menu.php" class="nav-link"><i class="fas fa-search"></i> Search Items</a></li>
          <li class="nav-item"><a href="recipes.php" class="nav-link"><i class="fas fa-utensils"></i> Recipes</a></li>
          <li class="nav-item"><a href="user_intake.php" class="nav-link"><i class="fas fa-chart-line"></i> Your Intake</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link active"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
      </nav>
      <div class="login-signup d-flex gap-2">
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="user_profile.php" class="btn">
            <i class="fas fa-user"></i>
            <?php echo htmlspecialchars($_SESSION['fullname']); ?>
          </a>
          <a href="server/logout.php" class="btn btn-logout">
            <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
        <?php else: ?>
          <a href="login.html" class="btn">
            <i class="fas fa-sign-in-alt"></i>
            Login
          </a>
        <?php endif; ?>
      </div>
    </header>
    <main>
      <div class="hero">
        <div class="hero-content">
          <h2>Get in Touch</h2>
          <p class="hero-description">Have questions or feedback? We'd love to hear from you!</p>
        </div>
      </div>
      <div class="contact-container">
        <form action="server/contact_process.php" method="POST" class="contact-form">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />
          </div>

          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>
          </div>

          <button type="submit" class="btn btn-submit">
            <i class="fas fa-paper-plane"></i>
            Send Message
          </button>
        </form>
      </div>
    </main>
    <footer class="bg-dark text-white text-center p-4">
        <div class="container-fluid">
            <h5>NutriTracks</h5>
            <p>Your go-to platform for tracking nutrition and exploring healthy recipes.</p>
            <div class="social-icons">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
            </div>
            <p>&copy; <?php echo date("Y"); ?> NutriTracks. All rights reserved.</p>
        </div>
    </footer>
  </body>
</html>
