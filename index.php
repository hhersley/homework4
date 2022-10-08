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
   
   <form method="post" action="MenuItemADD.php">
  <div class="mb-3">
    <label for="Item" class="form-label">Item</label>
    <input type="text" class="form-control" id="item" aria-describedby="nameHelp" name="iName">
    <div id="nameHelp" class="form-text">Enter the new item's name</div>
   
    <label for="Price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" aria-describedby="nameHelp" name="iName">
    <div id="nameHelp" class="form-text">Enter the new item's price</div>
   
    <label for="Info" class="form-label">Info</label>
    <input type="text" class="form-control" id="info" aria-describedby="nameHelp" name="iName">
    <div id="nameHelp" class="form-text">Enter any restrictions this fits (GF, Vegan, Vegetarian?</div>
   
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   
</body>
