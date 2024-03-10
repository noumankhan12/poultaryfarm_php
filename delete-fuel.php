<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "epms";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$id = $_GET['ID'];

// Use prepared statement to safely delete the record
$stmt = $con->prepare("DELETE FROM `fuel_production` WHERE ID = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("location: fuelPurchase.php?msg=D");
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
