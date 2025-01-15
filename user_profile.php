<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include('server/connection.php');

$user_id = $_SESSION['user_id'];

// Fetch user information
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user_data = $user_result->fetch_assoc();

// Get user statistics
$stats_query = "
    SELECT 
        COUNT(DISTINCT fi.intake_date) as total_days_tracked,
        COUNT(fi.id) as total_entries,
        SUM(f.calories * fi.quantity/100) as total_calories,
        SUM(f.protein * fi.quantity/100) as total_protein,
        SUM(f.fat * fi.quantity/100) as total_fat,
        SUM(f.carbohydrates * fi.quantity/100) as total_carbs,
        MAX(fi.intake_date) as last_tracked_date
    FROM food_intake fi
    JOIN foods f ON fi.food_id = f.id
    WHERE fi.user_id = ?";

$stmt = $conn->prepare($stats_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats_result = $stmt->get_result();
$user_stats = $stats_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | NutriTracks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --secondary-color: #2196F3;
            --text-color: #333;
            --background-color: #f9f9f9;
            --card-background: #ffffff;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--background-color);
            line-height: 1.6;
            color: var(--text-color);
        }

        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin: 0;
        }

        nav ul {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s;
            position: relative;
            padding: 0.5rem 1rem;
            border-radius: 5px;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        nav a:hover::after {
            width: 100%;
        }

        nav a:hover {
            color: var(--primary-color);
        }

        nav ul li a,
.nav-link {
    position: relative;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    color: var(--text-color) !important;
    text-decoration: none;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s;
}

nav ul li a:hover,
.nav-link:hover {
    color: var(--primary-color) !important;
}

        .login-signup .btn:hover {
            transform: translateY(-2px);
            background-color: var(--primary-color);
            color: white;
        }

        .login-signup .btn-logout {
    background-color: #dc3545 !important;
    color: white;
}

        .btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            color: white;
        }

        .btn-logout {
            background-color: var(--text-color);
            color: white;
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: var(--shadow);
        }

        .profile-avatar i {
            font-size: 80px;
            color: var(--primary-color);
        }

        .stats-card {
            background: var(--card-background);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            box-shadow: var(--shadow);
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 2rem;
            margin-top: 3rem;
        }

        footer h5 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .social-icons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin: 1rem 0;
        }

        .social-icon {
            color: white;
            font-size: 1.5rem;
            transition: color 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            color: var(--primary-color);
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            nav ul {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .login-signup {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
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
            <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
    </nav>
    <div class="login-signup d-flex gap-2">
        <a href="user_profile.php" class="btn"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['fullname']); ?></a>
        <a href="server/logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<div class="profile-header">
    <div class="container text-center">
        <div class="profile-avatar">
            <i class="fas fa-user"></i>
        </div>
        <h2><?php echo htmlspecialchars($user_data['fullname']); ?></h2>
        <p class="mb-0"><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($user_data['email']); ?></p>
        <p><i class="fas fa-user-tag me-2"></i><?php echo htmlspecialchars($user_data['username']); ?></p>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-md-6">
            <h3 class="mb-4">Account Information</h3>
            <div class="stats-card">
                <p><strong>Member Since:</strong> <?php echo date('F j, Y', strtotime($user_data['created_at'])); ?></p>
                <p><strong>Last Activity:</strong> <?php echo $user_stats['last_tracked_date'] ? date('F j, Y', strtotime($user_stats['last_tracked_date'])) : 'No activity yet'; ?></p>
                <p><strong>Total Days Tracked:</strong> <?php echo number_format($user_stats['total_days_tracked']); ?></p>
                <p><strong>Total Food Entries:</strong> <?php echo number_format($user_stats['total_entries']); ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <h3 class="mb-4">Nutrition Overview</h3>
            <div class="stats-card">
                <div class="row text-center">
                    <div class="col-6 mb-4">
                        <i class="fas fa-fire-flame-curved stats-icon text-danger"></i>
                        <h4><?php echo number_format($user_stats['total_calories']); ?></h4>
                        <p class="text-muted">Total Calories</p>
                    </div>
                    <div class="col-6 mb-4">
                        <i class="fas fa-dumbbell stats-icon text-success"></i>
                        <h4><?php echo number_format($user_stats['total_protein'], 1); ?>g</h4>
                        <p class="text-muted">Total Protein</p>
                    </div>
                    <div class="col-6">
                        <i class="fas fa-droplet stats-icon text-warning"></i>
                        <h4><?php echo number_format($user_stats['total_fat'], 1); ?>g</h4>
                        <p class="text-muted">Total Fat</p>
                    </div>
                    <div class="col-6">
                        <i class="fas fa-bread-slice stats-icon text-info"></i>
                        <h4><?php echo number_format($user_stats['total_carbs'], 1); ?>g</h4>
                        <p class="text-muted">Total Carbs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="stats-card">
                <h3 class="mb-4">Quick Actions</h3>
                <div class="d-flex gap-3">
                    <a href="user_intake.php" class="btn btn-success flex-grow-1">
                        <i class="fas fa-plus-circle me-2"></i>Track New Food
                    </a>
                    <a href="menu.php" class="btn btn-primary flex-grow-1">
                        <i class="fas fa-search me-2"></i>Browse Foods
                    </a>
                    <a href="contact.php" class="btn btn-info text-white flex-grow-1">
                        <i class="fas fa-envelope me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 