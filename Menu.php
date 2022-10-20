 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Menu</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Food ID</th>
      <th>Item</th>
     <th>Price</th>
     <th>Event</th>
     <th></th>
     <th></th>
    
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
   
   
   
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
  case 'Add':
      $sqlAdd = "insert into Menu (Item, Price, EventID) value (?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("ssi", $_POST['mItem'], $_POST['mPrice'], $_POST['eid']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New item added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Menu set Item=?, Price=?, EventID=? where FoodID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssii", $_POST['mItem'], $_POST['mPrice'], $_POST['eid'], $_POST['mid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Menu item edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Menu where FoodID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['mid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Menu item deleted.</div>';
      break;
  }
}

$sql = "SELECT FoodID, Item, Price, EName from Menu M Join Event E on M.EventID = E.EventID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["FoodID"]?></td>
    <td><?=$row["Item"]?></td>
       <td>$<?=$row["Price"]?></td>
          <td><?=$row["EName"]?></td>

   
    <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editMenu<?=$row["FoodID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editMenu<?=$row["FoodID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMenu<?=$row["FoodID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editMenu<?=$row["FoodID"]?>Label">Edit Menu</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editMenu<?=$row["FoodID"]?>Item" class="form-label">Item</label>
                          <input type="text" class="form-control" id="editMenu<?=$row["FoodID"]?>Item" aria-describedby="editMenu<?=$row["FoodID"]?>Help" name="mItem" value="<?=$row['Item']?>">
                          <div id="editMenu<?=$row["FoodID"]?>Help" class="form-text">Enter the item's name.</div>
                        </div>
                         
 <div class="mb-3">
                          <label for="editMenu<?=$row["FoodID"]?>Price" class="form-label">Price</label>
                          <input type="text" class="form-control" id="editMenu<?=$row["FoodID"]?>Price" aria-describedby="editMenu<?=$row["FoodID"]?>Help" name="mPrice" value="<?=$row['Price']?>">
                          <div id="editMenu<?=$row["FoodID"]?>Help" class="form-text">Enter the item's Price.</div>
                       
                       
                       </div>
  <div class="mb-3">
  <label for="EventList" class="form-label">Event</label>
<select class="form-select" aria-label="Select Event" id="eventList" name="eid" value="<?=$row['EventID']?>">
<?php
    $eventSql = "select EName, EventID from Event order by EName";
    $eventResult = $conn->query($eventSql);
    while($eventRow = $eventResult->fetch_assoc()) {
      if ($eventRow['EventID'] == $row['EventID']) {
        $selText = " selected";
      } else {
        $selText = "";
      }
?>
  <option value="<?=$eventRow['EventID']?>"<?=$selText?>><?=$eventRow['EName']?></option>
<?php
    }
?>
  
  
  
        </select>
  
   

  </div>
                      
                        <input type="hidden" name="mid" value="<?=$row['FoodID']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
 <td>                    
                     
                 <form method="post" action="">
                <input type="hidden" name="mid" value="<?=$row["FoodID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>

  </tr>   
                     
                     
                     
                     

  </tr>
<?php
  }
} else {
  echo "0 results";
}
?>
      </tbody>
    </table>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">
        New Menu Item
      </button>
      <!-- Modal -->
      <div class="modal fade" id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addItemLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addItemLabel">Add Item</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="modal-body">
   <form method="post" action="">
       <div class="mb-3">
               <label for="Item" class="form-label">Item</label>
               <input type="text" class="form-control" id="item" aria-describedby="nameHelp" name="mItem">
               <div id="nameHelp" class="form-text">Enter the item's name</div>
       </div>

       <div class="mb-3">
               <label for="Price" class="form-label">Price</label>
               <input type="text" class="form-control" id="price" aria-describedby="nameHelp" name="mPrice">
               <div id="nameHelp" class="form-text">Enter the item's price</div>
       </div>
     
     
       
             
                 <div class="mb-3">
                            <label for="EventList" class="form-label">Event</label>
                            <select class="form-select" aria-label="Select Event" id="eventList" name="eid" >
                          <?php
                              $menuaddSql = "select * from Event order by EName";
                              $menuaddResult = $conn->query($menuaddSql);
                              while($menuaddRow = $menuaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$menuaddRow['EventID']?>"><?=$menuaddRow['EName']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>


                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>



<?
$conn->close();
?>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

   

</body>
