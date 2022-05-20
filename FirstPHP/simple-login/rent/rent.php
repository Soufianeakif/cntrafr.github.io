<?php
include_once('../config.php');

$id = $_GET['ID'];
$start = $_GET['START'];
$end = $_GET['END'];

echo "ID product id  " .$id . "<br>";
echo "start is  " .date("Y-m-d h:i:sa", $start) . "<br>";
echo "end is  " .date("Y-m-d h:i:sa", $end) . "<br>";

$n = strtotime("-1 hour",strtotime("now"));
$min = date('Y-m-d\TH:i:s',$n);
echo $min ."<br>";

$T_start = date('Y-m-d\TH:i:s',$start);
$T_end = date('Y-m-d\TH:i:s',$end);

echo "<br>------------------------------------------------------<br>";

function checkbusy($indb_start, $indb_end, $start_date, $end_date) {

  $db_start = $indb_start;
  $db_end = $indb_end;
  $start = $start_date;
  $end = $end_date;

  return ((($db_start <= $start ) && ($start <= $db_end)) || 
          (($db_start <= $end ) && ($end <= $db_end)) || 
          (($start <= $db_start ) && ($db_start <= $end)) ||
          (($start <= $db_end ) && ($db_end <= $end))
  );
}

if(isset($_POST['form_login'])){
		
		
	//$username = $_POST['username'];
  $start_time= strtotime($_POST['start-time']);
  $end_time = strtotime($_POST['end-time']);

	try{

    if($start_time > $end_time){
      throw new Exception('end date > start date !...');
    }

    $busy = false;
    $num = 0;
		
		$stmnt = $db->prepare("select * from rent where ID_Produit=?");
		$stmnt->execute(array($id));
		$num = $stmnt->rowCount();
    $resultsrent = $stmnt->fetchAll();
		
		if($num>0){
      foreach($resultsrent as $rent){
          if (checkbusy($rent["D_Start"], $rent["D_End"],$start_time,$end_time)){
              $busy = true;
              throw new Exception('already busy...');
          }
      }
		}
/***************/
    if(!$busy){
      if($start_time >= $n){
          $statement = $db->prepare("insert into rent (ID_Produit, D_Start, D_End) values(?,?,?)");
          $statement->execute(array(
                  $id,
                  $start_time,
                  $end_time
              ));
          
          $success_message = "rent has been Registerd Successfully...!";
          //$db = null;
      }else{
        throw new Exception('cant rent in past time...');
      }
    }
	}
		catch(Exception $e){
		$error_message = $e->getMessage();
	}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<div class="main_content">
            
			  <!-- <div class="company_logo">
          
        </div> -->
        <div class="login_form">
            <h1>rent product "<?php echo $id ?>";</h1>
            <form action="" method="post">
                <h3>start date :</h3>
                <input type="datetime-local" id="meeting-time"
                  name="start-time" value="<?php echo $T_start; ?>"
                  min="<?php echo $min; ?>" step="any">
                <h3>end date :</h3>
                <input type="datetime-local" id="meeting-time"
                  name="end-time" value="<?php echo $T_end; ?>"
                  min="<?php echo $min; ?>" step="any">
                <br/>
                <br/>
                <input type="submit" class="btn btn-success" value="Register" name="form_login" />
                <a href="../rent">Back to rent Page</a>
                
            </form>
        </div>

        <div class="form_message">
                <?php 

                    if(isset($error_message)){
                    echo "<div class=' text-danger message message_warning'>".$error_message."</div>";

                    }

                    if(isset($success_message)){
                    echo "<div class='text-success message message_success'>".$success_message."</div>";
                    }

                ?>
            </div>
</div>


</body>
</html>