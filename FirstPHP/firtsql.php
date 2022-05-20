<!DOCTYPE html>
<html lang="en">
<head>
  <title>MY SQWALA</title>
</head>
<body>
  <?php
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "firstsql";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }else{
        echo("success");
    }

    $sql = "SELECT * FROM firsttable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<br>id: " . $row["ID"]. " - Title: " . $row["TITLE"]. " - Prix: " . $row["PRIX"]. "<br>";
        }
      } else {
        echo "0 results";
    }
  ?>


</body>
</html>

