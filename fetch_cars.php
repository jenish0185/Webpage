<?php
// Establish database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "car_rental";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch cars from database
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

$cars = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cars[] = $row;
    }
}

$conn->close();

// Return cars data as JSON
header('Content-Type: application/json');
echo json_encode($cars);
?>
