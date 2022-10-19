  <?php require_once('header.php'); ?>



  <body>
    
    <h2>Event</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Event ID</th>
      <th>Name</th>
      <th>Date</th>
     <th>Employee</th>
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
   
   
   
   
   
   
$sql = "SELECT EventID, Name, Date, EName, P.EmployeeID from Event E join Employee P on E.EmployeeID = P.EmployeeID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["EventID"]?></td>
    <td><?=$row["EName"]?></td>
     <td><?=$row["Date"]?></td>
     <td><?=$row["Name"]?></td>
     <td>
                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editEvent<?=$row["EventID"]?>">
                    Edit
                  </button>
                  <div class="modal fade" id="editEvent<?=$row["EventID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEvent<?=$row["EventID"]?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="editEvent<?=$row["EventID"]?>Label">Edit Event</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="">
                            <div class="mb-3">
                              <label for="editEvent<?=$row["EventID"]?>EName" class="form-label">Event Name</label>
                              <input type="text" class="form-control" id="editEvent<?=$row["EventID"]?>EName" aria-describedby="editEvent<?=$row["EventID"]?>Help" name="eName" value="<?=$row['EName']?>">
                              <div id="editEvent<?=$row["EventID"]?>Help" class="form-text">Enter the event's name.</div>
                            </div>
                           <div class="mb-3">
                              <label for="editEvent<?=$row["EventID"]?>Date" class="form-label">Date</label>
                              <input type="text" class="form-control" id="editEvent<?=$row["EventID"]?>Date" aria-describedby="editEvent<?=$row["EventID"]?>Help" name="eDate" value="<?=$row['Date']?>">
                              <div id="editEvent<?=$row["EventID"]?>Help" class="form-text">Enter the event's date.</div>
                            </div>





                       <div class="mb-3">
                            <label for="EmployeeList" class="form-label">Employee</label>
                            <select class="form-select" aria-label="Select Employee" id="employeeList" name="eempid" value="<?=$row['EmployeeID']?>">
                          <?php
                              $eventSql = "select * from Employee order by Name";
                              $eventResult = $conn->query($eventSql);
                              while($eventRow = $eventResult->fetch_assoc()) {
                                if ($eventRow['EmployeeID'] == $row['EmployeeID']) {
                                  $selText = " selected";
                                } else {
                                  $selText = "";
                                }
                         ?>
                               <option value="<?=$eventRow['EmployeeID']?>"<?=$selText?>><?=$eventRow['Name']?></option>
                         <?php
                              }
                         ?>
                           </select>
                       </div>

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
                <input type="hidden" name="eid" value="<?=$row["EventID"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
              </form>
            </td>

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

  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEvent">
        New Event
      </button>
      <!-- Modal -->
      <div class="modal fade" id="addEvent" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEventLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addEventLabel">Add Event</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
<div class="modal-body">
   <form method="post" action="">
       <div class="mb-3">
               <label for="EName" class="form-label">Name</label>
               <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="eName">
               <div id="nameHelp" class="form-text">Enter the event's name</div>
       </div>

       <div class="mb-3">
               <label for="Date" class="form-label">Date</label>
               <input type="text" class="form-control" id="date" aria-describedby="nameHelp" name="eDate">
               <div id="nameHelp" class="form-text">Enter the event's date (YYYY-MM-DD)</div>
       </div>
     
     
       
                          <div class="mb-3">
                            <label for="EmployeeList" class="form-label">Employee</label>
                            <select class="form-select" aria-label="Select Employee" id="employeeList" name="eempid" value="<?=$row['EmployeeID']?>">
                          <?php
                            
                         ?>
                               <option value="red"></option>
                                                             <option value="blue"></option>

                              
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
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>


</body>
