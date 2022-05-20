<?php
session_start();
include_once('config.php');
if(isset($_POST['form_login'])){
				
        $password = md5($_POST['password']);
    try{

        if(empty($_POST['username'])){
        throw new Exception('Username cannot be empty.....');
        }

        if(empty($_POST['password'])){
        throw new Exception('Password cannot be empty.....');
        }
/************ */
        $num = 0;
		
		$statement = $db->prepare("select * from users where user_name=?");
		$statement->execute(array($_POST['username']));
		$num = $statement->rowCount();
		
		if($num<=0){
			throw new Exception('Username doesnt exist. Please, choose another one....');
		}
/************** */
        else{
            $num = 0;

            $statement = $db->prepare("select * from users where user_name=? and user_pass=?");
            $statement->execute(array($_POST['username'], $password));

            $num = $statement->rowCount();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            if($num>0){

            $session_name = $result[0]['user_name'];
            $_SESSION['user_name'] = $session_name;            
            $_SESSION['full_name'] = $result[0]['full_name'];
            
            header('location: index.php');	

            } else {
            throw new Exception('Invalid Password.....');
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
      <!-- -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>LOGIN</title>
</head>
<body>

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
          <div>
            <img class="mx-auto h-14 w-auto" src="https://www.svgrepo.com/show/216236/user-profile.svg" alt="Workflow">
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
            <div class="form_message">
          </div>
          <form class="mt-8 space-y-6" action="" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
              <div>
                <label for="email-address" class="sr-only">username</label>
                <input id="email-address" name="username" type="text" autocomplete="username" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Username">
              </div>
              <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                <?php
                if(isset($error_message)){echo "<div><p class='ml-2 block text-sm text-red-600'>".$error_message."</p></div>";}
                ?>
              </div>
            </div>
        
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
              </div>
      
              <div class="text-sm">
                <a href="forgetpass.php" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password ? </a>
              </div>
            </div>
      
            <div>
              <button type="submit" name="form_login" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <!-- Heroicon name: solid/lock-closed -->
                  <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </span>
                Sign in
              </button>
            </div>
          </form>
          <div class="text-sm">
                <a href="register.php" class="flex justify-center mt-4 font-medium text-indigo-600 hover:text-indigo-500"> Create an account ? </a>
              </div>
        </div>
      </div>

</body>
</html>