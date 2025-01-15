<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu with Goals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="c_script.js" defer></script>
</head>
<body>


<header class="d-flex align-items-center justify-content-between bg-light p-3">
    <div class="logo">
        <i class="fas fa-leaf"></i>
        <h1><b>NutriTracks</b></h1>
    </div>
    <nav class="d-flex justify-content-center flex-grow-1">
        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="menu.php"><i class="fas fa-search"></i> Search Items</a></li>
            <li class="nav-item"><a href="recipes.php"><i class="fas fa-utensils"></i> Recipes</a></li>
            <li class="nav-item"><a href="user_intake.php"><i class="fas fa-chart-line"></i> Your Intake</a></li>
            <li class="nav-item"><a href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
        </ul>
    </nav>
    <div class="login-signup d-flex gap-2">
        <a href="user_profile.php" class="btn"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['fullname']); ?></a>
        <a href="server/logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</header>
<div class="menu-container mb-4">
    <h1>Our Menu</h1>

    
    <div class="search-bar mb-4">
        <input type="text" id="searchBar" class="form-control" placeholder="Search for food...">
    </div>

    <div class="row" id="menuItems">
        <?php
        include('server/connection.php');

        $limit = 6; // Number of items per page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
        $offset = ($page - 1) * $limit; // Calculate offset

        $query = "SELECT * FROM foods LIMIT $limit OFFSET $offset"; // Modify your query
        $result = mysqli_query($conn, $query);

        // Query to count total rows
        $countQuery = "SELECT COUNT(*) AS total FROM foods";
        $countResult = mysqli_query($conn, $countQuery);
        $row = mysqli_fetch_assoc($countResult);
        $totalRows = $row['total'];
        $totalPages = ceil($totalRows / $limit); // Calculate total pages

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-md-4 mb-4 food-item">';
            echo '<div class="card">';
            echo '<img src="./images/pexels-ella-olsson-572949-1640777.jpg" class="card-img-top" alt="Image of ' . htmlspecialchars($row['food_name']) . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['food_name']) . '</h5>';
            echo '<p><strong>Category:</strong> ' . $row['category'] . '</p>';
            echo '<p><strong>Type:</strong> ' . $row['food_type'] . '</p>';
            echo '<p><strong>Calories:</strong> ' . $row['calories'] . ' kcal</p>';
            echo '<p><strong>Protein:</strong> ' . $row['protein'] . ' g</p>';
            echo '<p><strong>Carbohydrates:</strong> ' . $row['carbohydrates'] . ' g</p>';
            echo '<button class="btn-select mt-2" data-id="' . $row['id'] . '" data-name="' . $row['food_name'] . '">Select</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="pagination-container text-center mt-4">
        <div class="row justify-content-center">
            <div class="col-8">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>



    <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quantityModalLabel">Select Quantity</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="intakeForm">
                        <input type="hidden" id="foodId" name="food_id">
                        <div class="mb-3">
                            <label for="foodName" class="form-label">Food Name</label>
                            <input type="text" id="foodName" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity (grams/pieces)</label>
                            <input type="number" id="quantity" name="quantity" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
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
    <script>
        document.querySelectorAll('.btn-select').forEach(button => {
            button.addEventListener('click', function () {
                const foodId = this.getAttribute('data-id');
                const foodName = this.getAttribute('data-name');

                document.getElementById('foodId').value = foodId;
                document.getElementById('foodName').value = foodName;

                const modal = new bootstrap.Modal(document.getElementById('quantityModal'));
                modal.show();
            });
        });

        document.getElementById('intakeForm').addEventListener('submit', async function (event) {
            event.preventDefault();

            const formData = new FormData(this);
            const response = await fetch('server/save_intake.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                alert('Intake saved successfully!');
                location.reload();
            } else {
                alert('Failed to save intake!');
            }
        });

        document.getElementById('searchBar').addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();
        const foodItems = document.querySelectorAll('.food-item');

        foodItems.forEach(item => {
            const foodName = item.querySelector('.card-title').textContent.toLowerCase();
            const foodCategory = item.querySelector('p').textContent.toLowerCase();

            if (foodName.includes(searchQuery) || foodCategory.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });


    </script>
</body>
</html>

