<?php 
include_once('config.php');
$idreset = 0;
if(isset($_POST['form_login'])){
				
        $email = $_POST['email'];
    try{

        if(empty($_POST['email'])){
        throw new Exception('Email cannot be empty.....');
        }

/************ */
        $num = 0;
		
		$statement = $db->prepare("select * from users where user_email=?");
		$statement->execute(array($email));
		$num = $statement->rowCount();
    $results = $statement->fetchAll();
		
		if($num<=0){
			throw new Exception('Email doesnt exist.');
		}
/************** */
    else{
      /****************/

      foreach($results as $output) {
        $idreset = $output["user_id"];
      }
      //function random
      function getrandom() {
        return rand(100000,999999);
      }
      $code = getrandom();
      
      
      try{			

        $statement = $db->prepare("UPDATE users SET code=? WHERE user_id=?");
        $statement->execute(array(
                md5($code),
                $idreset
            ));
        
        $success_message = "Password has been updated Successfully.....!";

              $receiver = $email;
              $subject = "Reset password !";
              $body = "Hi, your reset code is : ".$code;
              $sender = "From:centredaffaire@protonmail.com";

              if(mail($receiver, $subject, $body, $sender)){
                  echo "Email sent successfully to $receiver";
              }else{
                  echo "Sorry, failed while sending mail!";
              }

              header('location: verification.php?ID='.$idreset.'&email='.$email);
      
      }
        catch(Exception $e){
        $error_message = $e->getMessage();
      }

      /************* */

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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
          <div>
            <img class="mx-auto h-14 w-auto" src="https://www.svgrepo.com/show/304317/type-password.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            <div class="form_message">
          </div>
          <form class="mt-8 space-y-6" action="" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
              <div>
                <label for="email-address" class="sr-only">email</label>
                <input id="email-address" name="email" type="text" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email">
              </div>
            <div>
              <button type="submit" name="form_login" class="group relative w-full flex justify-center py-2 px-4 mt-5 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <!-- Heroicon name: solid/lock-closed -->
                  <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </span>
                send
              </button>
            </div>
          </form>
          <div class="text-sm">
                <a href="login.php" class="flex justify-center mt-4 font-medium text-indigo-600 hover:text-indigo-500"> Back to login ? </a>
              </div>
        </div>
      </div>
</body>
</html>