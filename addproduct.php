<?php
include_once('config.php');
if(isset($_POST['form_login'])){
		
		
		// $username = $_POST['username'];
		

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
		

		$statement = $db->prepare("insert into produit (ID_TypeProduit, Prix, Description) values(?,?,?)");
		$statement->execute(array(
            $_POST['produit_type'],
            $_POST['prix'],
            $_POST['description']
        ));
		
		$success_message = "product has been Registerd Successfully.....!";
        
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
        <link href="style.css" rel="stylesheet">
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
            <h1>add product</h1>
            <form action="" method="post">
                <h3>Disk Type :</h3>
                <select class="login_select" name="produit_type">
                    <?php foreach($results as $output) {?>
                        <option value="<?php echo $output["ID"]; ?>"><?php echo $output["Produit_name"]; ?></option>
                    <?php }?>
                </select>
                <h3>Prix :</h3>
                <input type="text" class="" name="prix" placeholder="Prix" />
                <h3>Description :</h3>
                <textarea name="description" style="padding: 11px; width: 76%; color:#716f6f;"
                          rows="5" cols="33">It was a dark and stormy night...
                </textarea>
                <br/>
                <input type="submit" class="btn btn-success" value="Register" name="form_login" />
                <a href="login.php">Back to login Page</a>
            </form>
        </div>
        </div>
    </body>

    </html>
