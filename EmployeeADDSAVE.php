<?php require_once('header.php'); ?>
<body>
  <?php
$servername = "localhost";
$username = "hahersle_homework4";
$password = "Hello10513!!";
$dbname = "hahersle_homework4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}



$empName = $_POST['empName'];
$empPhone = $_POST['empPhone'];


$sql = "insert into Employee (Name, Phone) value (?, ?)";
//echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $empName, $empPhone);
    $stmt->execute();
?>
    
    <h1>Add Employee</h1>
<div class="alert alert-success" role="alert">
  New Guest added successfuly!
</div>
    <a href="https://homework4.hahersley.oucreate.com/Employee.php" class="btn btn-primary">Go back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
