<?php

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interactive_elements_form";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the login table if it doesn't exist
$table_creation_query = "
    CREATE TABLE IF NOT EXISTS login (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );
";

// Execute the query to create the table
if ($conn->query($table_creation_query) === FALSE) {
    echo "Error creating table: " . $conn->error;
}

// Check if form data has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validate inputs
    if (!empty($username) && !empty($password)) {

        // Prepare the SQL query to fetch the stored password for the entered username
        $stmt = $conn->prepare("SELECT password FROM login WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Bind the result (stored password) to a variable
            $stmt->bind_result($stored_password);
            $stmt->fetch();

            // Verify the entered password against the stored hashed password
            if (password_verify($password, $stored_password)) {
                // Successful login, redirect to a protected page (e.g., dashboard)
                header("Location: ready.html");
                exit();
            } else {
                // Invalid password
                echo "<div class=\"msg-box\"><p>Invalid username or password.</p></div>";
            }
        } else {
            // Username not found
                echo "<div class=\"msg-box\"><p>Invalid username or password.</p></div>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display an error if the username or password is empty
        echo "<div class=\"msg-box\"><p>Username or password is empty</p></div>";
    }
}

// Close the database connection
$conn->close();
?>
