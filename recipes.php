<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes | NutriTracks</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="c_script.js" defer></script>
    <style>
        /* Keep all the existing CSS styles from recipes.html */
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
            font-weight: bold;
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

        .recipe-card {
            background: var(--card-background);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: var(--shadow);
            position: relative;
            padding: 1.5rem;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
        }

        .recipe-stats {
            display: flex;
            gap: 1rem;
            font-size: 0.9rem;
            color: #666;
            margin-top: 0.5rem;
        }

        .nutrition-badge {
            background-color: #f5f5f5;
            padding: 0.5rem;
            border-radius: 10px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .nutrition-badge:hover {
            background-color: #e0e0e0;
        }

        .search-filters {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .recipe-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .recipe-tag {
            background: #e0e0e0;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.8rem;
            color: #666;
        }

        nav ul li a.active {
            background: rgba(76, 175, 80, 0.1);
            color: var(--primary-color);
        }
    </style>
</head>
<body>

<?php
require_once 'server/connection.php';

// Fetch foods from database
$query = "SELECT * FROM foods ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

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

<main class="container py-5">
    <!-- Search and Filters -->
    <div class="search-filters mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" id="searchInput" placeholder="Search foods...">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="categoryFilter">
                    <option value="">All Categories</option>
                    <?php
                    $categories_query = "SELECT DISTINCT category FROM foods";
                    $categories_result = mysqli_query($conn, $categories_query);
                    while ($category = mysqli_fetch_assoc($categories_result)) {
                        echo "<option value='" . htmlspecialchars($category['category']) . "'>" . htmlspecialchars($category['category']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="foodTypeFilter">
                    <option value="">All Food Types</option>
                    <?php
                    $types_query = "SELECT DISTINCT food_type FROM foods";
                    $types_result = mysqli_query($conn, $types_query);
                    while ($type = mysqli_fetch_assoc($types_result)) {
                        echo "<option value='" . htmlspecialchars($type['food_type']) . "'>" . htmlspecialchars($type['food_type']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <!-- Food Grid -->
    <div class="row g-4" id="foodGrid">
        <?php
        while ($food = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-6 col-lg-4 food-item" 
                 data-category="<?php echo htmlspecialchars($food['category']); ?>"
                 data-type="<?php echo htmlspecialchars($food['food_type']); ?>"
                 data-name="<?php echo htmlspecialchars($food['food_name']); ?>">
                <div class="recipe-card h-100">
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="card-title mb-0"><?php echo htmlspecialchars($food['food_name']); ?></h5>
                            <span class="recipe-tag"><?php echo htmlspecialchars($food['category']); ?></span>
                        </div>
                        <div class="recipe-stats mb-3">
                            <span><i class="fas fa-fire me-1"></i><?php echo $food['calories']; ?> kcal</span>
                            <?php if ($food['cholesterol'] > 0): ?>
                                <span><i class="fas fa-heartbeat me-1"></i><?php echo $food['cholesterol']; ?> mg</span>
                            <?php endif; ?>
                            <?php if ($food['sodium'] > 0): ?>
                                <span><i class="fas fa-wind me-1"></i><?php echo $food['sodium']; ?> mg</span>
                            <?php endif; ?>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-4">
                                <div class="nutrition-badge">
                                    <small>Protein</small>
                                    <h6 class="mb-0"><?php echo $food['protein']; ?>g</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="nutrition-badge">
                                    <small>Carbs</small>
                                    <h6 class="mb-0"><?php echo $food['carbohydrates']; ?>g</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="nutrition-badge">
                                    <small>Fat</small>
                                    <h6 class="mb-0"><?php echo $food['fat']; ?>g</h6>
                                </div>
                            </div>
                        </div>
                        <div class="recipe-tags">
                            <span class="recipe-tag"><?php echo htmlspecialchars($food['food_type']); ?></span>
                            <?php if ($food['fiber'] > 0): ?>
                                <span class="recipe-tag">High Fiber (<?php echo $food['fiber']; ?>g)</span>
                            <?php endif; ?>
                            <?php if ($food['sugar'] > 0): ?>
                                <span class="recipe-tag">Sugar (<?php echo $food['sugar']; ?>g)</span>
                            <?php endif; ?>
                            <?php if ($food['protein'] > 15): ?>
                                <span class="recipe-tag">High Protein</span>
                            <?php endif; ?>
                            <?php if ($food['vitamin_c'] > 0): ?>
                                <span class="recipe-tag">Vitamin C</span>
                            <?php endif; ?>
                            <?php if ($food['iron'] > 0): ?>
                                <span class="recipe-tag">Iron</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-5">
        <button class="btn btn-outline-success btn-lg">
            <i class="fas fa-plus-circle me-2"></i>Load More Foods
        </button>
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
        <p>&copy; 2024 NutriTracks. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const foodTypeFilter = document.getElementById('foodTypeFilter');
    const foodItems = document.querySelectorAll('.food-item');

    function filterFoods() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();
        const selectedType = foodTypeFilter.value.toLowerCase();

        foodItems.forEach(item => {
            const foodName = item.dataset.name.toLowerCase();
            const foodCategory = item.dataset.category.toLowerCase();
            const foodType = item.dataset.type.toLowerCase();

            const matchesSearch = foodName.includes(searchTerm);
            const matchesCategory = !selectedCategory || foodCategory === selectedCategory;
            const matchesType = !selectedType || foodType === selectedType;

            if (matchesSearch && matchesCategory && matchesType) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', filterFoods);
    categoryFilter.addEventListener('change', filterFoods);
    foodTypeFilter.addEventListener('change', filterFoods);
});
</script>
</body>
</html> 