<?php require_once('header.php'); ?>



  <body>
    
<table class="table table-striped">
  <thead>
   
    <tr>
            <th> Food ID </th>
            <th> Item </th>
            <th> Item </th>

      
     <th></th>
     <th></th>
    
    </tr>
  </thead>

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
      echo '<div class="alert alert-success" role="alert">New Event added.</div>';
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
    
    
   $eid = $_GET['id'];

   
$sql = "SELECT E.EventID, EName, Item, Price, P.EmployeeID, Name, FoodID  from Menu M Join Event E on M.EventID=E.EventID Join Employee P on E.EmployeeID = P.EmployeeID where E.EventID=?";
 
    
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
if ($result->num_rows > 0) {
  
    
   
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
    
    
     <h1> Details for <?=$row["EName"]?></h1>
    <h2> This event will be managed by <?=$row["Name"]?></h2>
  
  <tbody>
    
      <tr>
    <td><?=$row["FoodID"]?></td>
    <td><?=$row["Item"]?></td>
       <td>$<?=$row["Price"]?></td>
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
                       
                       
               
                      
                        <input type="hidden" name="mid" value="<?=$row['FoodID']?>">
                           <input type="hidden" name="eid" value="<?=$row['EventID']?>">

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
     
    
    <?
      $conn->close();
?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
