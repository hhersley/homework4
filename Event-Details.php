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
      $sqlAdd = "insert into Event (EName, Date, EmployeeID) value (?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("ssi", $_POST['eName'], $_POST['eDate'], $_POST['eempid']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Event added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Event set EName=?, Date=?, EmployeeID=? where EventID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssii", $_POST['eName'], $_POST['eDate'], $_POST['eempid'], $_POST['eid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Event edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Event where EventID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['eid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Event deleted.</div>';
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
    
    
  
  <tbody>
    
      <tr>
    <td><?=$row["FoodID"]?></td>
    <td><?=$row["Item"]?></td>
       <td>$<?=$row["Price"]?></td>

   
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
      <h1> Details for <?=$row["EName"]?></h1>
    <h2> This event will be managed by <?=$row["Name"]?></h2>
    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
