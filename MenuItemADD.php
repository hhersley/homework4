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
    <input type="text" class="form-control" id="item" aria-describedby="nameHelp" name="mItem">
    <div id="nameHelp" class="form-text">Enter the new item's name</div>
     </div>
    <div class="input-group mb-3">
          <label for="Price" class="form-label">Price</label> 
  <span class="input-group-text">$</span>
  <input type="text" class="form-control" id="price" aria-describedby="nameHelp" name="mPrice"> 
    <div id="nameHelp" class="form-text">Enter the new item's price</div>
</div>
     
      <div class="mb-3">
  <label for="EventList" class="form-label">Event</label>
<select class="form-select" aria-label="Select Event" id="eventList" name="EventID">
<?php
    $eventSql = "select Name from Event order by Name";
    $eventResult = $conn->query($eventSql);
    while($eventRow = $eventResult->fetch_assoc()) {
      if ($eventRow['EventID'] == $row['EventID']) {
        $selText = "";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$eventRow['EventID']?>"<?=$selText?>><?=$eventRow['Name']?></option>
<?php
    }
?>
  
  
  
  
  
   
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   

</body>
