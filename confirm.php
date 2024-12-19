<?php
session_start();// confirms the appointment for the patient and displays doctor details 
?>

<?php
  $servername = "localhost";
  $username = "root";
  $password = "ffffffff";
  $dbname = "testdata";
  
  // Create connection using positional arguments
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  echo '<link rel = "stylesheet" href = "confirm.css" >';
  echo '<body><div class = "div1">';

  echo '<div class = "div2"><p style="text-align:center; font-weight:bold;"> Your appointment details </p></div>';

  // Check if 'id' is set in POST
  if (isset($_POST['id'])) {
      $option = explode(",", $_POST['id']);
      // saving all info about doctor in variables
      $doctid = $option[0];
      $doctname = $option[1];
      $doctdate = $option[2];
      $doctTime = $option[3];

      // printing all the doctor information
      $d = date_create($doctdate);
      $t = date_create($doctTime);

      echo '<p>Doctor id:'.$doctid.'<br>';
      echo 'Doctor name:'.$doctname.'<br>';
      echo 'Date:'.date_format($d , "d M Y").'<br>';
      echo 'Time:'.date_format($t, "h:i a").'<br>';
      echo 'Specialisation:'.$_SESSION["psp"].'<br></p>';
      echo "</div></body>";
  } else {
      echo "Error: Appointment details are missing.";
      exit;
  }

  // saving patient info in variables
  $na = $_SESSION["name"];
  $em = $_SESSION["email"];
  $ad = $_SESSION["aadhar"];
  $ag = $_SESSION["age"];
  $blg = $_SESSION["bg"];
  $spls = $_SESSION["psp"];

  // Ensure your columns exist in the database
  $sql = "INSERT INTO bookedAppointments (name, email, aadhar, age, bloodGroup, doctorName, spl, date, time)
  VALUES ('$na', '$em', '$ad', '$ag', '$blg', '$doctname', '$spls', '$doctdate', '$doctTime')";

  if ($conn->query($sql) === TRUE) {
      // Successfully inserted
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $sql = "DELETE FROM addAppointment WHERE date = '$doctdate' AND name = '$doctname' AND Time = '$doctTime'";

  if ($conn->query($sql) === TRUE) {
      // Successfully deleted record
  } else {
      // Error deleting record
  }

  echo '<a href = "http://127.0.0.1:5500/index.html"><button>Join the video call</button></a>';
  $conn->close();
?>
