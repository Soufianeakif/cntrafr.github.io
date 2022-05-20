<?php


  /***fill time****/
  $t=array();
  $hours = strtotime("Today");

  for ($x = 0; $x <= 23; $x++) {
    array_push($t,$hours);
    $hours = strtotime("+1 hour", $hours);
  }

  
  $n = strtotime("-1 hour",strtotime("now"));


  function check($start_date, $end_date, $date_from_table) {

    $start = $start_date;
    $end = $end_date;
    $check = $date_from_table;
  
    return (($start <= $check ) && ($check <= $end));
  }

  function add59min($tt) {
    return $tt + 3540;
  }
  // $time = array("00:00",
  //               "01:00",
  //               "02:00",
  //               "03:00",
  //               "04:00",
  //               "05:00",
  //               "06:00",
  //               "07:00",
  //               "08:00",
  //               "09:00",
  //               "10:00",
  //               "11:00",
  //               "12:00",
  //               "13:00",
  //               "14:00",
  //               "15:00",
  //               "16:00",
  //               "17:00",
  //               "18:00",
  //               "19:00",
  //               "20:00",
  //               "21:00",
  //               "22:00",
  //               "23:00");

  /**************db*/
  include_once('../config.php');

  /***type produit***/
  try{
      $stmt = $db->prepare("select ID_Produit,ID_TypeProduit,Produit_name,Prix,Description,Status FROM produit
                            INNER JOIN type_produit
                            ON produit.ID_TypeProduit = type_produit.ID
                            where Status = 1
                            order by ID_Produit");
      $stmt->execute();
      $results = $stmt->fetchAll();

  }catch(Exception $ex){
      echo($ex -> getMessage());
  }

  try{
      $stmt2 = $db->prepare("select * FROM rent"); //nzid where startdate...
      $stmt2->execute();
      $resultsrent = $stmt2->fetchAll();

      print_r($resultsrent);

  }catch(Exception $ex){
      echo($ex -> getMessage());
  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Responsive Table + Detail View</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="../product/css/style.css">
</head>

<body>
  <h1>table</h1>
  <p>(time)</p>
  <main>
    <table style="border: 1px solid black;">
      <thead>
        <tr>
          <th></th>
          <?php foreach($results as $output) { ?>
          <th><?php echo $output["ID_Produit"] . " | " . $output["Produit_name"];?></th>
          <?php }?>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan='5'>Year: 2022</th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach($t as $hour) {?>
          <tr>
              <td data-title="Provider Name"><?php echo date("H:i", $hour); ?></td>
              <?php foreach($results as $product) { 
                      $found = false;
                      foreach($resultsrent as $rent) { 
                        if ($product["ID_Produit"] == $rent["ID_Produit"]){

                            if (check($rent["D_Start"], $rent["D_End"], $hour)){ ?>
                                <td style="background: red;"><?php echo "Busy"; ?></td>
                                <?php $found = true;
                            } 
                        }
                     }
                     if(!$found) {
                        if($hour < $n){ ?>
                          <td style="background: Black;"><?php echo "not valid"; ?></td>
                  <?php }else{ ?>
                        <td style="background: green;"><a href="rent.php?ID=<?php echo $product["ID_Produit"];?>&START=<?php echo $hour;?>&END=<?php echo add59min($hour);?>">Free</a></td>
                  <?php }
                      } ?>          
            <?php } ?>    
          </tr>
        <?php }?>
      </tbody>
    </table>

  </main>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <!-- <script src="js/index.js"></script> -->

</body>
</html>
