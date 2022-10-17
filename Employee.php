

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
    case 'Edit':
      $sqlEdit = "update Employee set Name=? where EmployeeID=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sii", $_POST['empName'], $_POST['empid'], $_POST['empPhone']);
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
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editInstructor<?=$row["instructor_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editInstructor<?=$row["instructor_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInstructor<?=$row["instructor_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editInstructor<?=$row["instructor_id"]?>Label">Edit Instructor</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editInstructor<?=$row["instructor_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editInstructor<?=$row["instructor_id"]?>Name" aria-describedby="editInstructor<?=$row["instructor_id"]?>Help" name="iName" value="<?=$row['instructor_name']?>">
                          <div id="editInstructor<?=$row["instructor_id"]?>Help" class="form-text">Enter the instructor's name.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['instructor_id']?>">
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
     <a href="https://homework4.hahersley.oucreate.com/EmployeeADD.php" class="btn btn-primary">New Employee</a>

   

</body>
