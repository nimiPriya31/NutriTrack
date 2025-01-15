<?php
include('pages/connection.php');

// Sample data arrays
$food_names = [
    "Apple", "Banana", "Carrot", "Broccoli", "Chicken Breast", "Salmon", "Rice", "Pasta", "Almonds", "Oats",
    "Spinach", "Potato", "Egg", "Cheese", "Yogurt", "Orange", "Strawberry", "Blueberry", "Grapes", "Peach",
    "Quinoa", "Lentils", "Chickpeas", "Tofu", "Beef", "Pork", "Turkey", "Fish", "Shrimp", "Crab",
    "Cabbage", "Cauliflower", "Zucchini", "Bell Pepper", "Onion", "Garlic", "Mushroom", "Pumpkin", "Sweet Potato", "Beetroot",
    "Cucumber", "Tomato", "Radish", "Celery", "Kale", "Brussels Sprouts", "Asparagus", "Artichoke", "Peas", "Corn"
];

$categories = [
    "Vegetarian", "Non-Vegetarian", "Vegan", "Gluten-Free", "Dessert", "Beverage"
];

$food_types = [
    "Fruits", "Vegetables", "Grains", "Proteins", "Dairy", "Snacks"
];

// Function to generate random food data
function generateRandomFoodData($pdo) {
    global $food_names, $categories, $food_types;

    for ($i = 0; $i < 50; $i++) {
        $food_name = $food_names[array_rand($food_names)];
        $category = $categories[array_rand($categories)];
        $food_type = $food_types[array_rand($food_types)];
        $calories = rand(50, 500);
        $protein = rand(1, 30);
        $carbohydrates = rand(1, 100);
        $fat = rand(1, 20);
        $fiber = rand(0, 10);
        $sugar = rand(0, 20);
        $cholesterol = rand(0, 100);
        $sodium = rand(0, 500);
        $vitamin_c = rand(0, 100);
        $iron = rand(0, 10);
        $image_url = "../../uploads/" . strtolower(str_replace(' ', '_', $food_name)) . ".jpg"; // Placeholder image URL

        // Prepare and execute the insert statement
        $sql = "INSERT INTO foods (food_name, category, food_type, image_url, calories, protein, carbohydrates, fat, fiber, sugar, cholesterol, sodium, vitamin_c, iron) 
                VALUES (:food_name, :category, :food_type, :image_url, :calories, :protein, :carbohydrates, :fat, :fiber, :sugar, :cholesterol, :sodium, :vitamin_c, :iron)";
        
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
    }

    echo "50 food items generated successfully!";
}

// Call the function to generate food data
generateRandomFoodData($pdo);
?> 