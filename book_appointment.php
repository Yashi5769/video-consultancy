
<?php
session_start(); /*shows the table of all available appointments of the required category
to the patient to book appointment. */
?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "testdata";

  $_SESSION["name"]=$_POST["pname"];
  $_SESSION["email"]=$_POST["email"];
  $_SESSION["aadhar"]=$_POST["pid"];
  $_SESSION["age"]=$_POST["age"];
  $_SESSION["bg"]=$_POST["bg"];
  $_SESSION["psp"]=$_POST["spl"];
 
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo '<link rel = "stylesheet" href = "already_confirmed.css"> ';
  $patname = $_SESSION["name"];
  $s = $_SESSION["psp"];
  
  $sql = "SELECT * FROM bookedAppointments WHERE name = '$patname' ";
  $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
      echo '<table><tr><th colspan = "3" class = "booked">Your booked appointment</th></tr>';
        echo "<tr><th>Doctor name</th><th>Date</th><th>Time</th></tr>";
  
       $row = $result->fetch_assoc();
       $d = date_create($row["date"]); //create date to format date
       $t = date_create($row["time"]); //create date to format time

        echo "<tr><td>".$row["doctorName"]."</td><td>".date_format($d, "d M Y")."</td><td>".date_format($t, "h:i a")."</td></tr>";
        echo "</table>";
    
        echo '<a href = "https://agile-hamlet-79369.herokuapp.com/"><button>Join the video call</button></a> ';

   } 
    else {
    
      $sql = "SELECT * FROM addAppointment WHERE spl = '$s' ";
      $result = $conn->query($sql);

      echo '<link rel = "stylesheet" href = "patient_table.css">';
      echo "<form method = 'POST' action = 'confirm.php'>";
	  
     echo "<table>";
	    echo "<tr>";
      echo '<th colspan = "4" style = "background-color:#ececec">Available appointments</th></tr>';
		  echo "<tr>";
      echo "<td></td>";
		  echo "<th>Name of doctor</th>";
		  echo "<th>Date</th>";
		  echo "<th>Time</th>";
	    echo "</tr>";
      while($row = $result->fetch_assoc()) {
        $d = date_create($row["date"]);
        $t = date_create($row["Time"]);
		    echo "<tr>";
			  echo "<td><input class = 'rad' type = 'radio' name = 'id' value = '".$row["id"].",".$row["name"].",".$row["date"].",".$row["Time"]."'></td>";
        echo "<td>".$row["name"]."</td><td>".date_format($d, "d M Y")."</td><td>".date_format($t, "h:i a")."</td>";

		    echo "</tr>";
	    }
	    echo "<tr><td colspan = '5' align = 'center'><input type = 'submit' name = 'confirm' value = 'Confirm' class = 'btn'></td></tr>";
	    echo "</table>";
	    echo "</form>";
    }
    $conn->close(); 
 ?>
  
 