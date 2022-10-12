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

   <form method="post" action="EventADDSAVE.php">
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="eName">
    <div id="nameHelp" class="form-text">Enter the new event's name</div>
     </div>
    <div class="input-group mb-3">
          <label for="Date" class="form-label">Date</label> 
  <input type="text" id="datepicker" name="datepicker" value="Date"/>
</form>
</div>
     
      <div class="mb-3">
  <label for="EmployeeList" class="form-label">Employee</label>
<select class="form-select" aria-label="Select Employee" id="employeeList" name="EmployeeID">
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
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   

</body>
