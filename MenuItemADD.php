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

?>

   <form method="post" action="MenuItemADDSAVE.php">
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
