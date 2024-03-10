<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header("Location: index.php");
    exit();
}
include 'includes/database.php';
include 'includes/action.php';
?>

<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_head.php";?>
<body id="body">
    <div class="container">
        <!-- top navbar -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_top_navbar.php";?>
        <main>
            <div class="main__container">
                <table>
                    <thead>
                        <th>Date</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Name</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "epms";
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $database);
                        $record = mysqli_query($conn, "SELECT * FROM food_production ");
                        
                        // Initialize total price and total quantity variables
                        $totalPrice = 0;
                        $totalQuantity = 0;
                        
                        while ($row = mysqli_fetch_array($record)) {
                            // Add price and quantity for each row to totals
                            $totalPrice += $row['Price'];
                            $totalQuantity += $row['quantity'];
                            ?>
                            <tr>
                                <td><?php echo $row['Date']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['Price']; ?></td>
                                <td><?php echo $row['Name']; ?></td>
                                <td>
                                    <a class="edit_btn" href="">Edit</a>
                                </td>
                                <td>
                                <td>
    <a class="del_btn" href="delete-food.php?ID=<?php echo $row['ID']; ?>">Delete</a>
</td>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Print total price and total quantity -->
                <p>Total Price: <?php echo $totalPrice; ?></p>
                <p>Total Quantity: <?php echo $totalQuantity; ?></p>

                <?php
                // Calculate total quantity and update the database
                $totalProduction = 0;
                $record = mysqli_query($conn, "SELECT * FROM food_production ");
                while ($row = mysqli_fetch_array($record)) {
                    $totalProduction += $row['quantity'];
                }

                // Update the total_quantity column in the medicinePurchase table
                $updateQuery = "UPDATE food_production SET totalquantity = '$totalProduction'";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "";
                } else {
                    echo "Error: " . $updateQuery . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
                ?>

                <div class="main__container">
                    <form action="food-purchase-action.php" method="post">
                        <div class="input-group">
                            <label for="">Date</label>
                            <input type="date" name="date"><br>
                        </div>
                        <div class="input-group">
                            <label for="">Quantity</label>
                            <input type="number" step="any" name="quantity" value="" required>
                        </div>
                        <div class="input-group">
                            <label for="">Price</label>
                            <input type="number" step="any" name="price" value="" required>
                        </div>
                        <div class="input-group">
                            <label for="">Name</label>
                            <input type="text" name="name" value="" required>
                        </div>
                        <div class="input-group">
                            <button type="submit" name="submit" class="btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                         $servername = "localhost";
                         $username = "root";
                         $password = "";
                         $database = "epms";
                         // Create connection
                         $con = new mysqli($servername, $username, $password, $database);
                        
                        // Retrieve the existing total production from medicine_purchase
                        $recordPurchase = mysqli_query($con, "SELECT SUM(quantity) AS totalquantity FROM food_production");
                        $rowPurchase = mysqli_fetch_assoc($recordPurchase);
                        $totalProduction = $rowPurchase['totalquantity'];

                        // Retrieve the existing total consumption from medicine_bought
                        $recordBought = mysqli_query($con, "SELECT SUM(quantity) AS total_consumption FROM food_consumption");
                        $rowBought = mysqli_fetch_assoc($recordBought);
                        $totalConsumption = $rowBought['total_consumption'];

                        // Calculate the difference between total production and total consumption
                        $difference = $totalProduction - $totalConsumption;
                        
                        // Output the difference
                        echo "<p>Production: $totalProduction</p>";
                        echo "<p>Consumption: $totalConsumption</p>";
                        echo "<p>Difference: $difference</p>";
                        
                        // Close the database connection
                        $con->close();
                        ?>
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_side_bar.php";?>
    </div>
    <script src="script.js"></script>
</body>
</html>
