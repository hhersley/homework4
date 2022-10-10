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

   <form method="post" action="EmployeeADDSAVE.php">
  <div class="mb-3">
    <label for="Name" class="form-label">Name</label>
    <input type="text" class="form-control" id="Name" aria-describedby="nameHelp" name="empName">
    <div id="nameHelp" class="form-text">Enter the employee's name</div>
  </div>
    
       <div class="mb-3">
    <label for="Phone" class="form-label">Phone</label>
    <input type="text" class="form-control" id="phone" aria-describedby="nameHelp" name="empPhone">
    <div id="nameHelp" class="form-text">Enter the employee's phone number</div>
  </div>
     
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   

</body>
