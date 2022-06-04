<?php
include_once('config.php');
$_id = $_GET['ID'];
$_email = $_GET['email'];
$start_message = 'Email sent successfully to '.'<b>'.$_GET['email'].'</b>';
$num = 0;

if(isset($_POST['form_login'])){

    $code = $_POST['verification_code'];
   

    try{
        $num = 0;

        $statement = $db->prepare("select * from users where user_email=? and code=? and user_id=?");
        $statement->execute(array($_email, md5($code),$_id));

        $num = $statement->rowCount();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if($num>0){
            header('location: updatepassword.php?ID='.$_id.'&email='.$_email.'&code='.$code);	
        } else {
        throw new Exception('Invalid code.....');
        }
    }
    catch(Exception $e){
        $error_message = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot password - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script src="../assets/js/init-alpine.js"></script>
  </head>
  <body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
      <div
        class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800"
      >
        <div class="flex flex-col overflow-y-auto md:flex-row">
          <div class="h-32 md:h-auto md:w-1/2">
            <img
              aria-hidden="true"
              class="object-cover w-full h-full dark:hidden"
              src="../assets/img/forgot-password-office.jpeg"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/forgot-password-office-dark.jpeg"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Forgot password
              </h1>

                        <div class="bg-green-100 mb-4 mt-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">Email sent successfully to <b><?php echo $_email; ?></b></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        </span>
                        </div>


              <form class="mt-4 space-y-6" action="" method="POST">
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Verification code</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="XXXXXX" name="verification_code"
                />
              </label>
              
              <div class="form_message">
                <?php
                if(isset($error_message)){echo "<p class='text-red-600 text-sm'>".$error_message."</p>";}
                ?>
              </div>
               
              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                 name="form_login" type="submit" 
              >send mail</button>
                
              
              </form>
              <hr class="my-8" />



              <p class="mt-4">
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="login.php"
                >
                  Back to login?
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
