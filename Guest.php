
 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Guest</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Guest ID</th>
      <th>Name</th>
      <th>Email</th>
     <th>Room</th>
     <th>Event</th>
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
      $sqlAdd = "insert into Guest (Name, Email, Room, EventID) value (?, ?, ?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("ssii", $_POST['gName'], $_POST['gEmail'], $_POST['gRoom'], $_POST['eid']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Guest added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Guest set Name=?, Email=?, Room=?, EventID=? where GuestID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssiii", $_POST['gName'], $_POST['gEmail'], $_POST['gRoom'], $_POST['eid'], $_POST['gid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Guest edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Guest where GuestID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['gid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Guest deleted.</div>';
      break;
  }
}
   
   
   
   
$sql = "SELECT GuestID, Name, Email, Room, E.EventID, EName from Guest G Join Event E on G.EventID = E.EventID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["GuestID"]?></td>
    <td><?=$row["Name"]?></td>
    <td><?=$row["Email"]?></td>
       <td><?=$row["Room"]?></td>
          <td><?=$row["EName"]?></td>

    <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editGuest<?=$row["GuestID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editGuest<?=$row["GuestID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editGuest<?=$row["GuestID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editGuest<?=$row["GuestID"]?>Label">Edit Guest</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editGuest<?=$row["GuestID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editGuest<?=$row["GuestID"]?>Name" aria-describedby="editGuest<?=$row["GuestID"]?>Help" name="gName" value="<?=$row['Name']?>">
                          <div id="editGuest<?=$row["GuestID"]?>Help" class="form-text">Enter the guest's name.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editGuest<?=$row["GuestID"]?>Email" class="form-label">Email</label>
                          <input type="text" class="form-control" id="editGuest<?=$row["GuestID"]?>Email" aria-describedby="editGuest<?=$row["GuestID"]?>Help" name="gEmail" value="<?=$row['Email']?>">
                          <div id="editGuest<?=$row["GuestID"]?>Help" class="form-text">Enter the guest's email.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editGuest<?=$row["GuestID"]?>Room" class="form-label">Room</label>
                          <input type="text" class="form-control" id="editGuest<?=$row["GuestID"]?>Room" aria-describedby="editGuest<?=$row["GuestID"]?>Help" name="gRoom" value="<?=$row['Room']?>">
                          <div id="editGuest<?=$row["GuestID"]?>Help" class="form-text">Enter the guest's room number.</div>
                        </div>
                       
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
           
                        <input type="hidden" name="gid" value="<?=$row['GuestID']?>">
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
                <input type="hidden" name="gid" value="<?=$row["GuestID"]?>" />
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
?>
      </tbody>
    </table>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuest">
        New Guest
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addGuest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addGuestLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addGuestLabel">Add Guest</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" aria-describedby="nameHelp" name="gName">
    <div id="nameHelp" class="form-text">Enter the Guest's name</div>
  </div>
    
       <div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" aria-describedby="nameHelp" name="gEmail">
    <div id="nameHelp" class="form-text">Enter the guest's email</div>
  </div>
     <div class="mb-3">
    <label for="Room" class="form-label">Room</label>
    <input type="text" class="form-control" id="room" aria-describedby="nameHelp" name="gRoom">
    <div id="nameHelp" class="form-text">Enter the guest's room number</div>
  </div>
               
                 
               
                       <div class="mb-3">
                            <label for="EventList" class="form-label">Event</label>
                            <select class="form-select" aria-label="Select Event" id="eventList" name="eid" >
                          <?php
                              $guestaddSql = "select * from Event order by EName";
                              $guestaddResult = $conn->query($guestaddSql);
                              while($guestaddRow = $guestaddResult->fetch_assoc()) {
                         ?>
                               <option value="<?=$guestaddRow['EventID']?>"><?=$guestaddRow['EName']?></option>
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
