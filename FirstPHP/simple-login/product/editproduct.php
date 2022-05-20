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
if(isset($_POST['form_login'])){
		
		
		// $username = $_POST['username'];
		$ID_P = $_GET['ID'];

	try{
	
		// if(empty($_POST['name'])){
		// 	throw new Exception('Name cannot be empty.....');
		// }
		
		// if(empty($_POST['username'])){
		// 	throw new Exception('Username cannot be empty.....');
		// }
		
		// if(empty($_POST['Prix'])){
		// 	throw new Exception('Prix cannot be empty.....');
		// }
		

		$statement = $db->prepare("UPDATE produit SET ID_TypeProduit=?, Prix=?, Description=?,Status=? WHERE ID_Produit=?");
		$statement->execute(array(
            $_POST['produit_type'],
            $_POST['prix'],
            $_POST['description'],
            $_POST['status'],
            $ID_P
        ));
		
		$success_message = "product has been updated Successfully.....!";
        
        //$db = null;
	
	}
		catch(Exception $e){
		$error_message = $e->getMessage();
	}

}
/***type produit***/
try{
    $stmt = $db->prepare("SELECT * FROM Type_Produit");
    $stmt->execute();
    $results = $stmt->fetchAll();

}catch(Exception $ex){
    echo($ex -> getMessage());
}

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Simple Login System :: PHP</title>
        <link href="../style.css" rel="stylesheet">
    </head>

    <body>
        <div class="main_content">
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
			  <!-- <div class="company_logo">
          
        </div> -->
        <div class="login_form">
            <h1>Edit product <?php echo $_GET['ID'];?></h1>
            <form action="" method="post">
                <h3>Disk Type :</h3>
                <select class="login_select" name="produit_type">
                    <option value="<?php echo $_GET["P_TYPE"]; ?>"><?php echo $_GET["P_NAME"]; ?></option>
                    <?php foreach($results as $output) {
                        if ($output["ID"] !== $_GET["P_TYPE"]){?>
                        <option value="<?php echo $output["ID"]; ?>"><?php echo $output["Produit_name"]; ?></option>
                    <?php }}?>
                </select>
                <h3>Prix :</h3>
                <input type="text" class="" name="prix" placeholder="Prix" value="<?php echo $_GET["PRIX"]; ?>"/>
                <h3>Description :</h3>
                <textarea name="description" style="padding: 11px; width: 76%; color:#716f6f;"
                          rows="5" cols="33"><?php echo $_GET['DESCRIPTION'];?>
                </textarea>
                <h3>Status :</h3>
                <select class="login_select" name="status">
                    <?php if ($_GET["STATUS"] == 1){?>
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                    <?php }else{ ?>
                        <option value="0">Deactive</option>
                        <option value="1">Active</option>
                    <?php } ?>
                </select>
                <br/>
                <input type="submit" class="btn btn-success" value="Register" name="form_login" />
                <a href="../login.php">Back to login Page</a>
                
            </form>
        </div>
        </div>
    </body>

    </html>
