<?php
include_once('config.php');
if(isset($_POST['form_login'])){
		
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		

	try{
	
		if(empty($_POST['name'])){
			throw new Exception('Name cannot be empty.....');
		}
		
		if(empty($_POST['username'])){
			throw new Exception('Username cannot be empty.....');
		}
		
		if(empty($_POST['password'])){
			throw new Exception('Password cannot be empty.....');
		}
		
		if(empty($_POST['user_email'])){
			throw new Exception('Email cannot be empty.....');
		}
		
		if(empty($_POST['user_type'])){
			throw new Exception('User type cannot be empty.....');
		}
		
		$num = 0;
		
		$statement = $db->prepare("select * from users where user_name=?");
		$statement->execute(array($_POST['username']));
		$num = $statement->rowCount();
		
		if($num>0){
			throw new Exception('Username already exist. Please, choose another one....');
		}

		$statement = $db->prepare("insert into users (full_name, user_name, user_pass, user_email, user_phone,user_type) values(?,?,?,?,?,?)");
		$statement->execute(array(
            $_POST['name'],
            $_POST['username'],
            $password,
            $_POST['user_email'],
            $_POST['user_phone'],
            $_POST['user_type']
        ));
		
		$success_message = "User has been Registerd Successfully.....!";
        
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
    <!-- <div class="k-scheduler-cell k-slot-cell k-nonwork-hour" tabindex="-1" 
    aria-label="Monday, May 16, 2022, 12:00 AM–00:30" aria-selected="false" data-slot="true" data-slot-allday="false" 
    data-slot-start="1652655600000"
    data-slot-end="  1652657400000" data-slot-group="0" data-slot-range="0" data-slot-index="0" style="user-select: none; padding: 0px;"></div>

    <div class="k-scheduler-cell k-slot-cell k-nonwork-hour" tabindex="-1" 
    aria-label="Wednesday, May 18, 2022, 5:00 PM–17:30" aria-selected="false" data-slot="true" data-slot-allday="false" 
    data-slot-start="1652889600000" 
    data-slot-end="  1652891400000" data-slot-group="0" data-slot-range="0" data-slot-index="34" style="user-select: none; padding: 0px;"></div>
     -->
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
			<div class="company_logo">
                <img src="img/logo.png" alt="">
            </div>
            <div class="login_form">
                <form action="" method="post">
                    <h3>Name :</h3>
                    <input type="text" class="" name="name" placeholder="Name" />
                    <h3>Usernam :</h3>
                    <input type="text" class="" name="username" placeholder="Username" />
                    <h3>Password : </h3>
                    <input type="password" class="" name="password" placeholder="Password" />
                    <h3>Email :</h3>
                    <input type="text" class="" name="user_email" placeholder="Email" />
                    <h3>Contact :</h3>
                    <input type="text" class="" name="user_phone" placeholder="Phone Number Optional" />
                    <h3>User Type :</h3>
                    <select class="login_select" name="user_type">
                        
                        <?php foreach($results as $output) {?>
                            <option value="<?php echo $output["ID"]; ?>"><?php echo $output["Produit_name"]; ?></option>
                        <!-- <option value="1">Admin</option>
                        <option value="2">User</option> -->
                        <?php }?>
                    </select>
                    <br/>
                    <input type="submit" class="btn btn-success" value="Register" name="form_login" />
                    <a href="login.php">Back to login Page</a>
                </form>
            </div>
        </div>
    </body>

    </html>
