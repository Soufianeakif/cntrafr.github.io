<?php
include_once('config.php');

if(isset($_POST['form_login'])){
		
		
		// $username = $_POST['username'];
		$password = md5($_POST['password']);
		
    
	try{
      
		
		$num = 0;
		
		$statement = $db->prepare("select * from users where user_name=? or user_phone=? or user_email=?");
		$statement->execute(array($_POST['username'],$_POST['user_phone'],$_POST['user_email']));
		$num = $statement->rowCount();
    $results = $statement->fetchAll();
		
		if($num>0){
      $msg_error = 'already exist.';
      $msg_error1 = '';
      $msg_error2 = '';
      $msg_error3 = '';
      
      foreach($results as $output){
        if($output['user_name']==$_POST['username']){
          $msg_error1 = 'Username ';
        }
        if($output['user_phone']==$_POST['user_phone']){
          $msg_error2 = 'phone number ';
        }
        if($output['user_email']==$_POST['user_email']){
          $msg_error3 = 'Email ';
        }
        throw new Exception($msg_error1.$msg_error2.$msg_error3.$msg_error);
      }
			
		}

    function getrandom() {
      return rand(100000,999999);
    }       

		$statement = $db->prepare("insert into users (full_name, user_name, user_pass, user_email, user_phone, code) values(?,?,?,?,?,?)");
		$statement->execute(array(
            $_POST['full_name'],
            $_POST['username'],
            $password,
            $_POST['user_email'],
            $_POST['user_phone'],
            $code = getrandom()
        ));
		
		$success_message = "User has been Registerd Successfully.....!";
        
        //$db = null;
	
	}
		catch(Exception $e){
		$error_message = $e->getMessage();
	}
echo $_POST['user_photo'];


}
// /***type produit***/
// try{
//     $stmt = $db->prepare("SELECT * FROM Type_Produit");
//     $stmt->execute();
//     $results = $stmt->fetchAll();

// }catch(Exception $ex){
//     echo($ex -> getMessage());
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script> 
    <title>Register</title>
    <script type="text/javascript">
        function SetMaxLength () {
            var input = document.getElementById ("user_phone");
            input.maxLength = 10;
            input.minlenght = 10;
        }
    </script>
</head>
<body>
    



<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
          <div>
            <img class="mx-auto h-12 w-auto" src="https://www.svgrepo.com/show/165315/file.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Create your account</h2>
            <div class="form_message">
          </div>
          
          <form class="mt-8 space-y-6" action="" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
            <?php if(isset($error_message)){?>
                        <div class="bg-red-100 mb-4 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo $error_message; ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    <?php  }?>  
              <div>
                <label for="full_name" class="sr-only">full_name</label>
                <input id="full_name" name="full_name" type="text" autocomplete="full_name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="full name">
              </div>
              <div>
                <label for="user_name" class="sr-only">user_name</label>
                <input id="user_name" name="username" type="text" autocomplete="user_name" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="username">
                <!-- hna kan msg b script -->
              </div>
              <div>
                  <input class="form-control
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-white bg-clip-padding
                  border border-md border-gray-300
                  transition
                  ease-in-out
                  m-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="user_photo" name="user_photo">
              </div>
              <div>
                <label for="user_email" class="sr-only">user_email</label>
                <input id="user_email" name="user_email" type="email" autocomplete="user_email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email">
              </div>
              <div>
                <label for="user_phone" class="sr-only">user_phone</label>
                <input id="user_phone" maxlength="10" minlength="10" name="user_phone" type="phone" autocomplete="user_phone" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="06xxxxxxxx" pattern="[0]{1}[0-9]{9}">
              </div>
              <!-- kant hna user type -->
            </div>
        
            <div class="flex items-center justify-between">
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    </div>
                    <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password2" name="password2" type="password" autocomplete="current-password" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div>
      
            <div>
              <button onclick="SetMaxLength ();" type="submit" name="form_login" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <!-- Heroicon name: solid/lock-closed -->
                  <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </span>
                Register
              </button>
              <a href="login.php" class="group relative w-full flex justify-center mt-3 font-medium text-indigo-600 hover:text-indigo-500 "> Already have an account ? </a>
            </div>
          </form>
        </div>
      </div>
</body>
</html>