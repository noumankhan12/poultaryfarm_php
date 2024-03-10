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
                        <th>quantity</th>
                        <th>Price</th>
                        <th>Name</th>
                        <th>total remaining</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database="epms";
                        // Create connection
                        $conn = new mysqli($servername, $username, $password,$database);
                        $record=mysqli_query($conn,"SELECT *FROM medicine_consumption ");
                         // Initialize total price and total consumption variables
                         $totalPrice = 0;
                         $totalConsumption = 0;
                        while($row=mysqli_fetch_array($record))
                        {
                            // Add price and quantity for each row to totals
                            $totalPrice += $row['price'];
                            $totalConsumption += $row['quantity'];
                        ?>
                    
                            <tr>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['quantity'];?></td>
                                <td><?php echo $row['price'];?></td>
                                <td><?php echo $row['name'];?></td>
                                
                                <td>
                                    <a class="edit_btn" href="">Edit</a>
                                </td>
                                <td>
                                    <a class="del_btn" href="">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
                <!-- Print total price and total consumption -->
                <p>Total Price: <?php echo $totalPrice; ?></p>
                <p>Total Consumption: <?php echo $totalConsumption; ?></p>
                <?php
                // Calculate total quantity and update the database
                $totalConsumption = 0;
                $record = mysqli_query($conn, "SELECT * FROM medicine_consumption");
                while ($row = mysqli_fetch_array($record)) {
                    $totalConsumption += $row['quantity'];
                }

                // Update the total_quantity column in the medicinePurchase table
                $updateQuery = "UPDATE medicine_consumption SET total_consumption = '$totalConsumption'";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "Total consumption updated in the  table successfully.";
                } else {
                    echo "Error: " . $updateQuery . "<br>" . $conn->error;
                }

                // Close the database connection
                $conn->close();
                ?>
                
                <div class="main__container">
                
                
                <form action="medicineconsumption-action.php" method="post">
                    
                    <div class="input-group">
                        <label for="">Consumed On</label>
                        <input type="date"   name="date"><br>
                    </div>
                    <div class="input-group">
                        <label for="">Quantity Consumed</label>
                        <input type="number" step="any" name="quantity" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="">Price</label>
                        <input type="number" step="any" name="price" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="">Employ assigned</label>
                        <input type="text"  name="name" value="" required>
                    </div>
                    <div class="input-group">
                        <button type="submit" name="submit" class="btn">Save</button>
                    </div>
                </form>
                

            
</div>
                
                            
                       
        </main>
        <!-- sidebar nav -->
        <?php include "{$_SERVER['DOCUMENT_ROOT']}/epms/partials/_side_bar.php";?>
    </div>
    <script src="script.js"></script>
</body>
</html>