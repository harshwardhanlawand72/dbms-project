<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Fetch users
$sql = "SELECT * FROM users";
//echo $sql; // Echo SQL query for debugging
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>"; // Start the table
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['phonenumber']."</td>";
        echo "<td><a href='process.php?delete=".$row['id']."'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>"; // End the table
} else {
    echo "<p>No users found</p>";
}

mysqli_close($conn);
?>