<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Responsive Table + Detail View</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <h1>
  Providers
</h1>
<p>
  (An example table + detail view scenario)
</p>
<main>
  <table>
    <thead>
      <tr>
        <th>
          Client_ID
        </th>
        <th>
          Product_ID
        </th>
        <th></th>
      </tr>
    </thead>
    <tfoot>
      <tr>
        <th colspan='3'>
          Year: 2022
        </th>
      </tr>
    </tfoot>
    <tbody>
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

          $sql = "SELECT * FROM Reservation";
          $result = $conn->query($sql);
          $x = "";
          if ($result->num_rows > 0) {
              // output data of each row
              // <img src="./bureauimage.jpg" height="auto" width="284" height="159.750">

              while($row = $result->fetch_assoc()) {
                
                echo '
                  <tr>
                    <td data-title="Provider Name">
                      '. $row["client_ID"].'
                    </td>
                    <td data-title="E-mail">
                      '. $row["product_ID"].'
                    </td>
                    <td class="select">
                ';
                if ($row["Etat"] == 0){
                  $x = "Activer";
                  echo '<a class="button" style="background-color: #54a1a0;" href="#">';
                }else{
                  $x = "Inactiver"; 
                  echo '<a class="button" style="background-color: #BD2A4E;" href="#">';
                }
                echo 
                      $x.'
                      </a>
                    </td>
                  </tr>
                ';
              }
          } else {
              echo "0 results";
          }
        ?>
    </tbody>
  </table>
  <div class='detail'>
    <div class='detail-container'>
      <dl>
        <dt>
          Provider Name
        </dt>
        <dd>
          John Doe
        </dd>
        <dt>
          E-mail
        </dt>
        <dd>
          email@example.com
        </dd>
        <dt>
          City
        </dt>
        <dd>
          Detroit
        </dd>
        <dt>
          Phone-Number
        </dt>
        <dd>
          555-555-5555
        </dd>
        <dt>
          Last Update
        </dt>
        <dd>
          Jun 20 2014
        </dd>
        <dt>
          Notes
        </dt>
        <dd>
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.
        </dd>
      </dl>
    </div>
    <div class='detail-nav'>
      <button class='close'>
        Close
      </button>
    </div>
  </div>
</main>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
