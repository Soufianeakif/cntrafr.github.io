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
        header('location: login.php');
         
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
           <a href="logout.php">Logout</a><br><hr>
	   <h3>Hi <?php echo $_SESSION['full_name']; ?></h3>
           <h1>Welcome to Single Login Home Page......!</h1>
        </div>

        <a href="addproduct.php">add product</a>
    </body>
</html>
