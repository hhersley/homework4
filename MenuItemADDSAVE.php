
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



$mItem = $_POST['mItem'];
  $mPrice = $_POST['mPrice'];
$eID = $_POST['EventID'];

$sql = "insert into Menu (Item, Price, EventID) value (?, ?, ?)";
//echo $sql;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $mItem, $mPrice, $eID);
    $stmt->execute();
?>
    
    <h1>Add Menu Item</h1>
<div class="alert alert-success" role="alert">
  New Menu Item Added successfuly!
</div>
    <a href="https://homework4.hahersley.oucreate.com/#" class="btn btn-primary">Go back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
