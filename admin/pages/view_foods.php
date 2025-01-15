<?php
require '../../server/connection.php'; // Include DB connection

// Default SQL query
$query = "SELECT * FROM foods";

// Filter by category or type if selected
if (!empty($_GET['category']) || !empty($_GET['food_type'])) {
    $conditions = [];
    if (!empty($_GET['category'])) {
        $category = $_GET['category'];
        $conditions[] = "category = '$category'";
    }
    if (!empty($_GET['food_type'])) {
        $type = $_GET['food_type'];
        $conditions[] = "food_type = '$type'";
    }
    $query .= " WHERE " . implode(" AND ", $conditions);
}

// Execute the query
$result = $conn->query($query);
$foods = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $foods[] = $row;
    }
}

// Fetch unique categories and types for filter dropdowns
$categories_result = $conn->query("SELECT DISTINCT category FROM foods");
$types_result = $conn->query("SELECT DISTINCT food_type FROM foods");

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Foods</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f1f1f1;
      font-family: 'Arial', sans-serif;
    }

    .container {
      margin-top: 50px;
    }

    .table-container {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .table img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .search-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .search-bar input {
      width: 100%;
      max-width: 400px;
      border-radius: 30px;
      padding: 10px 20px;
      border: 1px solid #ddd;
    }

    .search-bar button {
      margin-left: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 30px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
      background-color: #0056b3;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-delete:hover {
      background-color: #a71d2a;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center text-primary mb-4">Food Items</h1>
    <?php if (!empty($message)): ?>
  <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
    <?php echo htmlspecialchars($message); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>


    <div class="table-container">
      <!-- Search Bar -->
      <div class="search-bar">
        <input type="text" id="searchInput" class="form-control" placeholder="Search food items...">
        <button id="searchButton" class="btn">Search</button>
      </div>

      <!-- Food Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
        <div class="row mb-4">
  <div class="col-md-4">
    <form method="GET" action="">
      <div class="input-group">
        <label class="input-group-text" for="category">Category</label>
        <select class="form-select" id="category" name="category" onchange="this.form.submit()">
          <option value="">All Categories</option>
          <?php if ($categories_result): ?>
            <?php while ($category_row = $categories_result->fetch_assoc()): ?>
              <option value="<?php echo htmlspecialchars($category_row['category']); ?>" 
                <?php echo (isset($_GET['category']) && $_GET['category'] === $category_row['category']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category_row['category']); ?>
              </option>
            <?php endwhile; ?>
          <?php endif; ?>
        </select>
      </div>
    </form>
  </div>

  <div class="col-md-4">
    <form method="GET" action="">
      <div class="input-group">
        <label class="input-group-text" for="food_type">Type</label>
        <select class="form-select" id="food_type" name="food_type" onchange="this.form.submit()">
          <option value="">All Types</option>
          <?php if ($types_result): ?>
            <?php while ($type_row = $types_result->fetch_assoc()): ?>
              <option value="<?php echo htmlspecialchars($type_row['food_type']); ?>" 
                <?php echo (isset($_GET['food_type']) && $_GET['food_type'] === $type_row['food_type']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($type_row['food_type']); ?>
              </option>
            <?php endwhile; ?>
          <?php endif; ?>
        </select>
      </div>
    </form>
  </div>

  <div class="col-md-4">
    <a href="view_food.php" class="btn btn-secondary">Reset Filters</a>
  </div>
</div>

          <thead class="table-primary">
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Category</th>
              <th>Food Type</th>
              <th>Calories</th>
              <th>Protein</th>
              <th>Carbohydrates</th>
              <th>Fat</th>
              <th>Fiber</th>
              <th>Sugar</th>
              <th>Cholesterol</th>
              <th>Sodium</th>
              <th>Vitamin C</th>
              <th>Iron</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="foodTable">
            <?php if (!empty($foods)): ?>
              <?php foreach ($foods as $index => $food): ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td>
                    <?php if (!empty($food['image_url'])): ?>
                      <img src="<?php echo htmlspecialchars($food['image_url']); ?>" alt="Food Image">
                    <?php else: ?>
                      <img src="placeholder.jpg" alt="No Image Available">
                    <?php endif; ?>
                  </td>
                  <td><?php echo htmlspecialchars($food['food_name']); ?></td>
                  <td><?php echo htmlspecialchars($food['category']); ?></td>
                  <td><?php echo htmlspecialchars($food['food_type']); ?></td>
                  <td><?php echo htmlspecialchars($food['calories']); ?></td>
                  <td><?php echo htmlspecialchars($food['protein']); ?></td>
                  <td><?php echo htmlspecialchars($food['carbohydrates']); ?></td>
                  <td><?php echo htmlspecialchars($food['fat']); ?></td>
                  <td><?php echo htmlspecialchars($food['fiber']); ?></td>
                  <td><?php echo htmlspecialchars($food['sugar']); ?></td>
                  <td><?php echo htmlspecialchars($food['cholesterol']); ?></td>
                  <td><?php echo htmlspecialchars($food['sodium']); ?></td>
                  <td><?php echo htmlspecialchars($food['vitamin_c']); ?></td>
                  <td><?php echo htmlspecialchars($food['iron']); ?></td>
                  <td>
                    <button class="btn-delete" onclick="deleteFood(<?php echo $food['id']; ?>)">Delete</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="16" class="text-center">No food items found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Search functionality
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");
    const foodTable = document.getElementById("foodTable");

    searchButton.addEventListener("click", () => {
      const searchTerm = searchInput.value.toLowerCase();
      const rows = foodTable.querySelectorAll("tr");

      rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(" ");
        row.style.display = rowText.includes(searchTerm) ? "" : "none";
      });
    });

    // Delete functionality
    function deleteFood(foodId) {
      if (confirm("Are you sure you want to delete this food item?")) {
        window.location.href = `delete_food.php?id=${foodId}`;
      }
    }
  </script>
</body>
</html>
