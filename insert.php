<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$docid=$_POST["did"];
$docname=$_POST["dname"];
$sp = $_POST["spl"];
$ddate=$_POST["day"];
$dtime=$_POST["dtime"];

$sql = "INSERT INTO addAppointment (id,name,spl,date,Time)
VALUES ('$docid','$docname','$sp','$ddate','$dtime')";

/*if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}*/

if ($conn->query($sql) === TRUE) {
  echo '<script type = "text/javascript">
            alert("Your entry has been saved");
            </script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
/* displays message in alert box and on clicking ok you can view your appointments*/
$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdata";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$todayDate = date('Y-m-d H:i:s');
$sql = "DELETE FROM addAppointment WHERE date < '$todayDate'";

if ($conn->query($sql) === TRUE) {
  //echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "testdata";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $docid=$_POST["did"];
  $sql = "SELECT date, Time FROM addAppointment WHERE id = '$docid' ";
  $result = $conn->query($sql);

  echo '<link rel = "stylesheet" href = "doctor_table.css"> ';
  echo "<body>";
  
  if ($result->num_rows > 0) {

    // html table
    echo '<table class = "unbooked"><tr><th class = "title1" colspan = "2">Unbooked appointments</th></tr><tr><th>Date</th><th>Time</th></tr>';

    //output data of each row
    while($row = $result->fetch_assoc()) {
      $d = date_create($row["date"]);
      $t = date_create($row["Time"]);

      echo "<tr><td>".date_format($d, "d M Y")."</td><td>".date_format($t, "h:i a")."</td></tr>";
    }
    echo "</table>";
    echo "</body>";
  } 
  else {
  }
  $conn->close();
?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "testdata";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $docname=$_POST["dname"];
  $sql = "SELECT * FROM bookedAppointments WHERE doctorName = '$docname' ";
  $result = $conn->query($sql);
  echo '<a href = "https://agile-hamlet-79369.herokuapp.com/"><button>Start the video call</button></a> ';
  echo '<link rel = "stylesheet" href = "doctor_table.css"> ';
  echo "<body>";

  if ($result->num_rows > 0) {

    // html table
    echo '<table class = "booked"><tr><th class = "title2" colspan = "7">Booked appointments</th></tr><br><tr><th>Patient name</th><th>Patient email ID</th><th>Patient aadhar number</th><th>Patient age</th><th>Patient blood group</th><th>Date</th><th>Time</th></tr>';

    //output data of each row
    while($row = $result->fetch_assoc()) {

      $d = date_create($row["date"]);
      $t = date_create($row["time"]);
      echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["aadhar"]."</td><td>".$row["age"]."</td><td>".$row["bloodGroup"]."</td><td>".date_format($d, "d M Y")."</td><td>".date_format($t, "h:i a")."</td></tr>";
    }
    echo "</table>";
    echo "</body>";
  } 
  else {
   // echo '<div class = "no_booked"><p>No booked appointments</p><div>';
  }
  
  $conn->close();
?>
