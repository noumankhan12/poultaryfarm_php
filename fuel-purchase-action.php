<?php
session_start();
if (isset($_POST['submit'])) {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database="epms";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$database);
    
    
//     if ($conn->connect_error) {
//       die("Connection failed: " . $conn->connect_error);
//     }
//     else
//     {
//     echo "Connected successfully";
// }

   
   $date=$_POST["date"];
   $quantity=$_POST["quantity"];
   $price=$_POST["price"];
   $name=$_POST["name"];
    
    $sql="INSERT INTO `fuel_production` (`Date`, `quantity`, `Price`,`Name`) VALUES ('$date', '$quantity', '$price', '$name');";
    mysqli_query($conn,$sql);
    // if($conn->query($sql)==true){
    //   echo "successfully inserted";
    // }
 
    //   echo "Error:.$sql <br> $conn->error";
    echo "
    <script>
    alert('successfully added');
    window.location.href='fuelPurchase.php';
    </script>
    ";

    $conn->close();
}
?>