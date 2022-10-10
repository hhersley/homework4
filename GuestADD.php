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

   <form method="post" action="GuestADDSAVE.php">
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
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   

</body>
