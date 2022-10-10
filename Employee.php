

 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Employee</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Phone</th>
    
    </tr>
  </thead>
  <tbody>
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

$sql = "SELECT EmployeeID, Name, Phone from Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["EmployeeID"]?></td>
    <td><?=$row["Name"]?></td>
    <td><?=$row["Phone"]?></td>

 

  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
      </tbody>
    </table>
     <a href="https://homework4.hahersley.oucreate.com/EmployeeADD.php" class="btn btn-primary">New Employee</a>

   

</body>
