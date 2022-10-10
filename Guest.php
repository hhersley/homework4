
 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Guest</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Guest ID</th>
      <th>Name</th>
      <th>Email</th>
    
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

$sql = "SELECT GuestID, Name, Email from Guest";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["GuestID"]?></td>
    <td><?=$row["Name"]?></td>
    <td><?=$row["Email"]?></td>

 

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
     <a href="https://homework4.hahersley.oucreate.com/GuestADD.php" class="btn btn-primary">New Guest</a>

   

</body>
