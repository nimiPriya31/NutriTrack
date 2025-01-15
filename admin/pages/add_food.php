
<?php
// Database connection
include ("connection.php");
$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_name = $_POST['food_name'];
    $category = $_POST['category'];
    $food_type = $_POST['food_type'];
    $calories = $_POST['calories'] ?? null;
    $protein = $_POST['protein'] ?? null;
    $carbohydrates = $_POST['carbohydrates'] ?? null;
    $fat = $_POST['fat'] ?? null;
    $fiber = $_POST['fiber'] ?? null;
    $sugar = $_POST['sugar'] ?? null;
    $cholesterol = $_POST['cholesterol'] ?? null;
    $sodium = $_POST['sodium'] ?? null;
    $vitamin_c = $_POST['vitamin_c'] ?? null;
    $iron = $_POST['iron'] ?? null;

    // Handle file upload
    $image_url = null;
    if (!empty($_FILES['food_image']['name'])) {
        $target_dir = "../../uploads/";
        $image_url = $target_dir . basename($_FILES["food_image"]["name"]);
        if (!move_uploaded_file($_FILES["food_image"]["tmp_name"], $image_url)) {
            $message = "Failed to upload the image.";
            $message_type = "error";
        }
    }

    // Validate fields
    if (empty($food_name) || empty($category) || empty($food_type)) {
        $message = "Food name, category, and type are required.";
        $message_type = "error";
    } else {
        try {
            // Insert data into the database
            $sql = "INSERT INTO foods (
                food_name, category, food_type, image_url, calories, protein, carbohydrates, fat, fiber, sugar, cholesterol, sodium, vitamin_c, iron
            ) VALUES (
                :food_name, :category, :food_type, :image_url, :calories, :protein, :carbohydrates, :fat, :fiber, :sugar, :cholesterol, :sodium, :vitamin_c, :iron
            )";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':food_name' => $food_name,
                ':category' => $category,
                ':food_type' => $food_type,
                ':image_url' => $image_url,
                ':calories' => $calories,
                ':protein' => $protein,
                ':carbohydrates' => $carbohydrates,
                ':fat' => $fat,
                ':fiber' => $fiber,
                ':sugar' => $sugar,
                ':cholesterol' => $cholesterol,
                ':sodium' => $sodium,
                ':vitamin_c' => $vitamin_c,
                ':iron' => $iron
            ]);

            $message = "Food item added successfully!";
            $message_type = "success";
        } catch (PDOException $e) {
            $message = "Error adding food item: " . $e->getMessage();
            $message_type = "error";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Food</title>

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
</head>

<body>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-header text-center bg-primary text-white">
            <h2>Add Food</h2>
          </div>

          <div class="card-body">
            <!-- Display messages -->
            <?php if (!empty($message)): ?>
              <div class="alert alert-<?php echo $message_type === 'success' ? 'success' : 'danger'; ?>" role="alert">
                <?php echo htmlspecialchars($message); ?>
              </div>
            <?php endif; ?>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <!-- Food Name -->
              <div class="mb-3">
                <label for="food_name" class="form-label">Food Name</label>
                <input
                  type="text"
                  id="food_name"
                  name="food_name"
                  class="form-control"
                  placeholder="Enter food name"
                  required
                />
              </div>
              
              <div class="mb-3">
                <label for="food_type" class="form-label">Food Type</label>
                <select
                  id="food_type"
                  name="food_type"
                  class="form-select"
                  required
                >
                  <option value="" disabled selected>Select Type</option>
                  <option value="Fruits">Fruits</option>
                  <option value="Vegetables">Vegetables</option>
                  <option value="Recipes">Recipes</option>
                </select>
              </div>
              <!-- Food Category -->
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select
                  id="category"
                  name="category"
                  class="form-select"
                  required
                >
                  <option value="" disabled selected>Select Category</option>
                  <option value="Vegetarian">Vegetarian</option>
                  <option value="Non-Vegetarian">Non-Vegetarian</option>
                  <option value="Vegan">Vegan</option>
                  <option value="Gluten-Free">Gluten-Free</option>
                  <option value="Dessert">Dessert</option>
                  <option value="Beverage">Beverage</option>
                </select>
              </div>
              
              <!-- Nutrition Information -->
             <!-- Nutrition Information -->
<div class="mb-3">
  <label class="form-label">Nutrition Information</label>
  <div class="row">
    <div class="col-md-6 mb-2">
      <input type="number" id="calories" name="calories" class="form-control" placeholder="Calories (kcal)" required />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="protein" name="protein" class="form-control" placeholder="Protein (g)" required />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="carbohydrates" name="carbohydrates" class="form-control" placeholder="Carbohydrates (g)" required />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="fat" name="fat" class="form-control" placeholder="Fat (g)" required />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="fiber" name="fiber" class="form-control" placeholder="Fiber (g)" />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="sugar" name="sugar" class="form-control" placeholder="Sugar (g)" />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="cholesterol" name="cholesterol" class="form-control" placeholder="Cholesterol (mg)" />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="sodium" name="sodium" class="form-control" placeholder="Sodium (mg)" />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="vitamin_c" name="vitamin_c" class="form-control" placeholder="Vitamin C (mg)" />
    </div>
    <div class="col-md-6 mb-2">
      <input type="number" id="iron" name="iron" class="form-control" placeholder="Iron (mg)" />
    </div>
  </div>
</div>

              <!-- Upload Image -->
              <div class="mb-3">
                <label for="food_image" class="form-label">Upload Image</label>
                <input
                  type="file"
                  id="food_image"
                  name="food_image"
                  class="form-control"
                  accept="image/*"
                  onchange="previewImage(event)"
                />
                <div class="mt-3 text-center">
                  <img
                    id="food-image-preview"
                    src="#"
                    alt="Food Image Preview"
                    class="img-thumbnail"
                    style="display: none; max-width: 100%; height: auto;"
                  />
                </div>
              </div>
              <!-- Submit Button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add Food</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Image Preview Script -->
  <script>
    function previewImage(event) {
      const preview = document.getElementById("food-image-preview");
      const file = event.target.files[0];
      if (file) {
        preview.style.display = "block";
        preview.src = URL.createObjectURL(file);
      } else {
        preview.style.display = "none";
        preview.src = "";
      }
    }
  </script>
</body>

</html>
