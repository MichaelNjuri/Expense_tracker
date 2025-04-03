<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: Login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch user details from the session
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
$user_age = $_SESSION['user_age']; // Added age
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="Expense.css">
</head>
<body>
    <header>
       <h1>Expense Tracker</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="Signup.html">Sign up</a></li>
                <li><a href="Expense.html">Expense</a></li>
                <li><a href="profile.php">Profile</a></li>
            </ul>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <h2>My Profile</h2>
        </div>
        <div class="profile-section">
            <div class="profile-pic-container">
                <img id="profile-pic" src="Default pic.jpg" alt="Profile Picture">
                <button id="add-photo" class="add-photo-btn">Add Profile Photo</button>
                <input type="file" id="file-input" accept="image/*">
            </div>
            <div class="personal-info">
                <h3>Personal Information</h3>
                <table class="info-table">
                    <tr>
                        <th>Full Name</th>
                        <td><input type="text" id="full-name" value="<?php echo $user_name; ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><input type="text" id="email" value="<?php echo $user_email; ?>" readonly></td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td><input type="text" id="age" value="<?php echo $user_age; ?>" readonly></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Logout Button -->
        <div class="logout-container">
            <form action="logout.php" method="post">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-photo').addEventListener('click', function() {
            document.getElementById('file-input').click();
        });

        document.getElementById('file-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profile-pic').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
