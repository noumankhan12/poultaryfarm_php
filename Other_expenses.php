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
                       
                        
                        <th>Name</th>
                        <th>Price</th>
                       
                        
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database="epms";
                        // Create connection
                        $conn = new mysqli($servername, $username, $password,$database);
                        $record=mysqli_query($conn,"SELECT *FROM other_expenses ");
                         // Initialize total price and total consumption variables
                         $totalPrice = 0;
                        
                        while($row=mysqli_fetch_array($record))
                        {
                            // Add price and quantity for each row to totals
                            $totalPrice += $row['price'];
                            
                        ?>
                    
                            <tr>
                            <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['price'];?></td>
                                
                                
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
                <p>Total Expenditures: <?php echo $totalPrice; ?></p>
                
               
                
                <div class="main__container">
                
                
                <form action="other-expenses-action.php" method="post">
                    
                  
                <div class="input-group">
                        <label for="">Name</label>
                        <input type="text"  name="name" value="" required>
                    </div>
                    <div class="input-group">
                        <label for="">Price</label>
                        <input type="number" step="any" name="price" value="" required>
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