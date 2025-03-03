<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "interactive_elements_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Getting the username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validating the inputs
    if (!empty($username) && !empty($password)) {

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare SQL query to insert the registration data
        $stmt = $conn->prepare("INSERT INTO login (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        // Execute the query
        if ($stmt->execute()) {
            header("Location: ../index.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }



        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
}

// Close the connection
$conn->close();
?>
