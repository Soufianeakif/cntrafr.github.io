<!DOCTYPE html>
<html lang="en">
<head>
  <title>MY SQWALA</title>
  <link rel="stylesheet" href="csss.css">
</head>
<body>
<div class="container">
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
        // echo("success");
    }

    $sql = "SELECT * FROM firsttable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        // <img src="./bureauimage.jpg" height="auto" width="284" height="159.750">

        while($row = $result->fetch_assoc()) {
          
          echo '
            <div class="wrapper">
              <img src="./bureauimage.jpg" alt="">
              <div class="content">
                  <span>'. $row["TITLE"].'</span>
                  <p>Premium</p>
              </div>
              <div class="row">
                  <div class="price">'. $row["PRIX"].'&nbsp;MAD&nbsp;/jour</div>
                  <div class="buttons">
                      <button>Buy Now</button>
                      <button>Add to Cart</button>
                  </div>
              </div>
            </div>
          ';
        }
    } else {
        echo "0 results";
    }
  ?>
</div>
</body>
</html>