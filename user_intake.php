<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include('server/connection.php');

$user_id = $_SESSION['user_id'];

// Get lifetime totals
$lifetime_query = "
    SELECT 
        SUM(f.calories * fi.quantity/100) as total_calories,
        SUM(f.protein * fi.quantity/100) as total_protein,
        SUM(f.fat * fi.quantity/100) as total_fat,
        SUM(f.carbohydrates * fi.quantity/100) as total_carbs,
        COUNT(DISTINCT fi.intake_date) as total_days
    FROM food_intake fi
    JOIN foods f ON fi.food_id = f.id
    WHERE fi.user_id = $user_id";

$lifetime_result = mysqli_query($conn, $lifetime_query);
$lifetime_totals = mysqli_fetch_assoc($lifetime_result);

// Get the selected date or default to today's date
$selected_date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Fetch intake for the selected date
$daily_query = "
    SELECT f.food_name, fi.quantity, 
           (f.calories * fi.quantity/100) as calories,
           (f.protein * fi.quantity/100) as protein,
           (f.fat * fi.quantity/100) as fat,
           (f.carbohydrates * fi.quantity/100) as carbohydrates,
           fi.day_name
    FROM food_intake fi
    JOIN foods f ON fi.food_id = f.id
    WHERE fi.user_id = $user_id AND fi.intake_date = '$selected_date'";

$daily_result = mysqli_query($conn, $daily_query);

// Calculate daily totals
$daily_totals = [
    'calories' => 0,
    'protein' => 0,
    'fat' => 0,
    'carbohydrates' => 0
];

while ($row = mysqli_fetch_assoc($daily_result)) {
    $daily_totals['calories'] += $row['calories'];
    $daily_totals['protein'] += $row['protein'];
    $daily_totals['fat'] += $row['fat'];
    $daily_totals['carbohydrates'] += $row['carbohydrates'];
}
mysqli_data_seek($daily_result, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Nutrition Intake | NutriTracks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="user_intake.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <li class="nav-item"><a href="user_intake.php" class="nav-link active"><i class="fas fa-chart-line"></i> Your Intake</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
    </nav>
    <div class="login-signup d-flex gap-2">
        <a href="user_profile.php" class="btn"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['fullname']); ?></a>
        <a href="server/logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>

<div class="container mt-4">
    <!-- Lifetime Stats -->
    <div class="lifetime-stats mb-4">
        <h2 class="text-center mb-3">Lifetime Statistics</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check mb-2" style="font-size: 1.8rem; color: #6c757d;"></i>
                        <h5 class="card-title">Total Days Tracked</h5>
                        <p class="display-6 fw-bold text-secondary"><?= number_format($lifetime_totals['total_days']) ?></p>
                        <p class="text-muted">days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-fire-flame-curved mb-2" style="font-size: 1.8rem; color: #dc3545;"></i>
                        <h5 class="card-title">Total Calories</h5>
                        <p class="display-6 fw-bold text-danger"><?= number_format($lifetime_totals['total_calories']) ?></p>
                        <p class="text-muted">kcal</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-dumbbell mb-2" style="font-size: 1.8rem; color: #28a745;"></i>
                        <h5 class="card-title">Total Protein</h5>
                        <p class="display-6 fw-bold text-success"><?= number_format($lifetime_totals['total_protein'], 1) ?></p>
                        <p class="text-muted">grams</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line mb-2" style="font-size: 1.8rem; color: #17a2b8;"></i>
                        <h5 class="card-title">Daily Average Calories</h5>
                        <p class="display-6 fw-bold text-info"><?= number_format($lifetime_totals['total_calories'] / max(1, $lifetime_totals['total_days']), 0) ?></p>
                        <p class="text-muted">kcal/day</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nutrition Graphs Section -->
    <div class="nutrition-graphs mb-4">
        <h2 class="text-center mb-3">Nutrition Analysis</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Macronutrient Distribution</h5>
                        <canvas id="macroChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Calorie Breakdown by Food</h5>
                        <canvas id="calorieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Daily Intake Section -->
    <div class="daily-intake">
        <div class="row mb-3">
            <div class="col-12">
                <h2 class="text-center mb-3">Daily Intake</h2>
                <form method="GET" action="user_intake.php" class="mb-3">
                    <div class="input-group">
                        <label for="date" class="form-label me-2 my-auto">Select Date:</label>
                        <input type="date" id="date" name="date" class="form-control" value="<?= $selected_date ?>">
                        <button type="submit" class="btn btn-primary ms-2">View Intake</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daily Summary Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-fire-flame-curved mb-2" style="font-size: 1.8rem; color: #dc3545;"></i>
                        <h5 class="card-title">Daily Calories</h5>
                        <p class="display-6 fw-bold text-danger"><?= number_format($daily_totals['calories'], 0) ?></p>
                        <p class="text-muted">kcal</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-dumbbell mb-2" style="font-size: 1.8rem; color: #28a745;"></i>
                        <h5 class="card-title">Daily Protein</h5>
                        <p class="display-6 fw-bold text-success"><?= number_format($daily_totals['protein'], 1) ?></p>
                        <p class="text-muted">grams</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-droplet mb-2" style="font-size: 1.8rem; color: #ffc107;"></i>
                        <h5 class="card-title">Daily Fat</h5>
                        <p class="display-6 fw-bold text-warning"><?= number_format($daily_totals['fat'], 1) ?></p>
                        <p class="text-muted">grams</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-bread-slice mb-2" style="font-size: 1.8rem; color: #17a2b8;"></i>
                        <h5 class="card-title">Daily Carbs</h5>
                        <p class="display-6 fw-bold text-info"><?= number_format($daily_totals['carbohydrates'], 1) ?></p>
                        <p class="text-muted">grams</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Food Items -->
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="text-center mb-3">Detailed Food Items</h3>
            </div>
        </div>
        
        <div class="row g-3">
            <?php
            while ($row = mysqli_fetch_assoc($daily_result)) {
                echo '<div class="col-md-4">';
                echo '<div class="card h-100">';
                echo '<div class="card-body">';
                echo '<div class="d-flex justify-content-between align-items-center mb-2">';
                echo '<h5 class="card-title mb-0">' . htmlspecialchars($row['food_name']) . '</h5>';
                echo '<span class="badge bg-light text-dark">' . ($row['day_name'] ?? '-') . '</span>';
                echo '</div>';
                echo '<div class="nutrition-info">';
                echo '<p><strong><i class="fas fa-weight me-2"></i>Quantity:</strong> ' . number_format($row['quantity'], 0) . ' g</p>';
                echo '<p><strong><i class="fas fa-fire-flame-curved me-2"></i>Calories:</strong> <span class="text-danger">' . number_format($row['calories'], 0) . ' kcal</span></p>';
                echo '<p><strong><i class="fas fa-dumbbell me-2"></i>Protein:</strong> <span class="text-success">' . number_format($row['protein'], 1) . ' g</span></p>';
                echo '<p><strong><i class="fas fa-droplet me-2"></i>Fat:</strong> <span class="text-warning">' . number_format($row['fat'], 1) . ' g</span></p>';
                echo '<p><strong><i class="fas fa-bread-slice me-2"></i>Carbs:</strong> <span class="text-info">' . number_format($row['carbohydrates'], 1) . ' g</span></p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
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
<script>
// Macronutrient Distribution Chart
const macroCtx = document.getElementById('macroChart').getContext('2d');
const macroChart = new Chart(macroCtx, {
    type: 'doughnut',
    data: {
        labels: ['Protein', 'Fat', 'Carbohydrates'],
        datasets: [{
            data: [
                <?php echo $daily_totals['protein']; ?>,
                <?php echo $daily_totals['fat']; ?>,
                <?php echo $daily_totals['carbohydrates']; ?>
            ],
            backgroundColor: [
                '#28a745',  // Green for protein
                '#ffc107',  // Yellow for fat
                '#17a2b8'   // Blue for carbs
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Daily Macronutrient Distribution (grams)'
            }
        }
    }
});

// Calorie Distribution Chart
const calorieCtx = document.getElementById('calorieChart').getContext('2d');
const calorieData = {
    labels: [
        <?php 
        mysqli_data_seek($daily_result, 0);
        while ($row = mysqli_fetch_assoc($daily_result)) {
            echo "'" . addslashes($row['food_name']) . "',";
        }
        ?>
    ],
    datasets: [{
        data: [
            <?php 
            mysqli_data_seek($daily_result, 0);
            while ($row = mysqli_fetch_assoc($daily_result)) {
                echo $row['calories'] . ",";
            }
            ?>
        ],
        backgroundColor: [
            '#4CAF50', '#2196F3', '#FFC107', '#FF5722', '#9C27B0',
            '#795548', '#607D8B', '#E91E63', '#3F51B5', '#009688'
        ]
    }]
};

const calorieChart = new Chart(calorieCtx, {
    type: 'pie',
    data: calorieData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Calorie Distribution by Food Item'
            }
        }
    }
});
</script>
</body>
</html>
