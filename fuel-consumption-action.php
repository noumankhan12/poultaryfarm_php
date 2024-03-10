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

   
   $consumption_date=$_POST["date"];
   $consumption_quantity=$_POST["quantity"];
   $consumption_price=$_POST["price"];
   $consumer_name=$_POST["name"];
    
    $sql="INSERT INTO `fuel_consumption` (`date`, `quantity`, `price`,`name`)
     VALUES ('$consumption_date', '$consumption_quantity', '$consumption_price', '$consumer_name');";
    mysqli_query($conn,$sql);
    // if($conn->query($sql)==true){
    //   echo "successfully inserted";
    // }
 
    //   echo "Error:.$sql <br> $conn->error";
    echo "
    <script>
    alert('successfully consumed');
    window.location.href='fuelConsumption.php';
    </script>
    ";

    $conn->close();
}
?>