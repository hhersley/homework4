

 <?php require_once('header.php'); ?>



  <body>
    
    <h2>Employee</h2>
    
<table class="table table-striped">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Phone</th>
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
      $sqlAdd = "insert into Employee (Name, Phone) value (?, ?)";
      $stmtAdd = $conn->prepare($sqlAdd);
    $stmtAdd->bind_param("si", $_POST['eName'], $_POST['ePhone']);
    $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">Employee added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Employee set Name=?, Phone=? where EmployeeID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sii", $_POST['empName'], $_POST['empPhone'], $_POST['empid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Employee edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Employee where EmployeeID=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['empid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Employee deleted.</div>';
      break;
  }
}

$sql = "SELECT EmployeeID, Name, Phone from Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["EmployeeID"]?></td>
    <td><?=$row["Name"]?></td>
    <td><?=$row["Phone"]?></td>

 <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editEmployee<?=$row["EmployeeID"]?>">
                Edit
              </button>
              <div class="modal fade" id="editEmployee<?=$row["EmployeeID"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEmployee<?=$row["EmployeeID"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editEmployee<?=$row["EmployeeID"]?>Label">Edit Employee</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editEmployee<?=$row["EmployeeID"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editEmployee<?=$row["EmployeeID"]?>Name" aria-describedby="editEmployee<?=$row["EmployeeID"]?>Help" name="empName" value="<?=$row['Name']?>">
                          <div id="editEmployee<?=$row["EmployeeID"]?>Help" class="form-text">Enter the employee's name.</div>
                        </div>
                       <div class="mb-3">
                          <label for="editEmployee<?=$row["EmployeeID"]?>Phone" class="form-label">Phone</label>
                          <input type="text" class="form-control" id="editEmployee<?=$row["EmployeeID"]?>Phone" aria-describedby="editEmployee<?=$row["EmployeeID"]?>Help" name="empPhone" value="<?=$row['Phone']?>">
                          <div id="editEmployee<?=$row["EmployeeID"]?>Help" class="form-text">Enter the employee's phone number.</div>
                        </div>
                        <input type="hidden" name="empid" value="<?=$row['EmployeeID']?>">
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
                <input type="hidden" name="empid" value="<?=$row["EmployeeID"]?>" />
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
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployee">
        New Employee
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addEmployeeLabel">Add Employee</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
                <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" aria-describedby="nameHelp" name="eName">
    <div id="nameHelp" class="form-text">Enter the employee's name</div>
  </div>
    
       <div class="mb-3">
    <label for="Email" class="form-label">Phone</label>
    <input type="text" class="form-control" id="Phone" aria-describedby="nameHelp" name="ePhone">
    <div id="nameHelp" class="form-text">Enter the employee's phone number</div>
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
