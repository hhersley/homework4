 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Menu</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Event ID</th>
      <th>Name</th>
      <th>Date</th>
    
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

$sql = "SELECT EventID, Name, Date from Event";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["EventID"]?></td>
    <td><?=$row["Name"]?></td>
     <td><?=$row["Date"]?></td>


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
     <a href="https://homework4.hahersley.oucreate.com/EventADD.php" class="btn btn-primary">New Event</a>

   

</body>
