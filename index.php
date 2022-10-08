 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Menu</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Food ID</th>
      <th>Item</th>
      <th>Price</th>
     <th>Additional Information</th>
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

$sql = "SELECT FoodID, Item, Price, Info from Menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["FoodID"]?></td>
    <td><?=$row["Item"]?></td>
    <td>$<?=$row["Price"]?></td>
    <td><?=$row["Info"]?></td>

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
     <button href="MenuItemAdd.php" class="btn btn-primary">New Item</button>

   

</body>
