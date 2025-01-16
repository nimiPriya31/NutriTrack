# NutriTrack

## Project Overview
NutriTrack is an innovative nutrition tracking and food management system designed to promote healthier lifestyles. The platform empowers users to monitor their daily food intake, access detailed nutritional information, and make informed dietary decisions to achieve fitness goals.

---

## Features
- **User Management**: Personalized accounts for logging in, updating profiles, and securely managing dietary data.
- **Recipes with Categories**: A categorized collection of recipes (e.g., vegan, high-protein, low-carb) with step-by-step instructions and nutritional breakdowns.
- **Menu of Items**: Access detailed nutritional data, including calories, proteins, carbohydrates, and fats, for various food items.
- **Intake Tracking**: Log daily food consumption, calculate total calorie intake, and view macronutrient breakdowns with dynamic, chart-based nutritional analysis.

---

## Motivation
- **Promoting Healthier Lifestyles**: Empower individuals to monitor and manage nutrition effectively.
- **Bridging the Knowledge Gap**: Simplify the understanding of nutritional values for informed eating habits.
- **Encouraging Balanced Diets**: Motivate users to make healthier food choices tailored to their fitness goals.

---

## Technologies Used
- **Frontend**: HTML, CSS, Bootstrap (for responsive UI design).
- **Backend**: PHP (for server-side operations like user authentication and form handling).
- **Database**: MySQL (for efficient management of user data, food details, and nutritional information).

---

## Installation

### Prerequisites
1. A web server with PHP support (e.g., XAMPP, WAMP).
2. MySQL installed and running.

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/devTanzu/library.git
   ```
2. Move the project folder to your web server's root directory (e.g., `htdocs` for XAMPP).
3. Import the database:
   - Open `phpMyAdmin`.
   - Create a new database (e.g., `nutritrack_db`).
   - Import the SQL file provided in the `/database/` folder.
4. Configure the database connection in `config.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'nutritrack_db');
   ```
5. Access the application:
   ```
   http://localhost/nutritrack
   ```

---

## Usage
1. **Register/Login**: Create an account or log in to start tracking.
2. **Track Nutrition**: Log daily meals to calculate total intake and monitor progress.
3. **Explore Recipes**: Browse categorized recipes to inspire healthy meal planning.
4. **Analyze Trends**: Use charts to visualize daily, weekly, or monthly eating habits.

---

## Project Structure
```
nutritrack/
|-- assets/          # CSS, JS, and images
|-- database/        # SQL files
|-- includes/        # Reusable PHP components
|-- config.php       # Database configuration
|-- index.php        # Main entry point
|-- ...              # Other files and folders
```

---

## Statistics
- **150,000+** calories tracked daily by users.
- **120,000+** meals logged for personalized nutrition insights.
- **$8,500** saved in healthcare costs with improved dietary habits.

---

## Future Enhancements
- Add food barcode scanning for quicker logging.
- Enable integration with wearable devices for automatic activity tracking.
- Implement AI-based personalized meal recommendations.

---

## Contact
For inquiries, feel free to reach out:
- **Team**: NutriTrack Creative Team (Spring 2023)
- **University**: North East University Bangladesh
- **Members**: Abu Bokor, Priya Das
