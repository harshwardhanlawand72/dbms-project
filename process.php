<?php
// Database connection
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "user_management";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, 3306);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];

    // Insert the user into the database
    $sql = "INSERT INTO users (name, email, phonenumber) VALUES ('$name', '$email', '$phonenumber')";
    if (mysqli_query($conn, $sql)) {
        // Redirect to display.php after adding the user
        header("Location: display.php");
        exit; // Ensure that no further code is executed after redirection
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the display page after deletion
        header("Location: display.php");
        exit; // Ensure that no further code is executed after redirection
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
