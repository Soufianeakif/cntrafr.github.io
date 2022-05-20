<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    else
    {
        session_destroy();
        session_start(); 
    }

    if(empty($_SESSION['user_name']))
    {
        header('location: ../login.php');
    }
?>

<?php
  include_once('../config.php');

  /***type produit***/
  try{
      $stmt = $db->prepare("select ID_Produit,ID_TypeProduit,Produit_name,Prix,Description,Status FROM produit
                            INNER JOIN type_produit
                            ON produit.ID_TypeProduit = type_produit.ID
                            order by ID_Produit");
      $stmt->execute();
      $results = $stmt->fetchAll();

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

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <h1>
  Product
</h1>
<p>
  (product)
</p>
<main>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Status</th>
        <th>Price</th>
        <th>Action</th>
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
      $x = "";
      $c = "";
      foreach($results as $output) {
        if ($output["Status"] == 1){
          $x = "Active";
          $c = "#54a1a0";
        }else{
          $x = "Deactive";
          $c = "#BD2A4E";
        }
        ?>
        <tr>
          <td data-title="Provider Name"><?php echo $output["ID_Produit"];?></td>
          <td data-title="E-mail"><?php echo $output["Produit_name"];?></td>

          <td class="select">
                <span class="button" style="border-radius: 50px;padding: 6px 10px;background-color: <?php echo $c; ?> ;" href="#">
                  <?php echo $x;?>
                </span>
          </td>
        
          <td data-title="Prix"><?php echo $output["Prix"];?>&nbsp;MAD</td>

          <td class="select">
                <a class="button" href="editproduct.php?ID=<?php echo $output["ID_Produit"];?>&P_TYPE=<?php echo $output["ID_TypeProduit"];?>&P_NAME=<?php echo $output["Produit_name"];?>&PRIX=<?php echo $output["Prix"];?>&DESCRIPTION=<?php echo $output["Description"];?>&STATUS=<?php echo $output["Status"];?>">Edit</a>
          </td>

        </tr>
        <?php }?>
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

    <!-- <script src="js/index.js"></script> -->

</body>
</html>
