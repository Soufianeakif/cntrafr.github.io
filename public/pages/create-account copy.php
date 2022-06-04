<?php
include_once('config.php');

// File upload path
$targetDir = "uploads/";



if(isset($_POST['form_login'])){

//01
$password = md5($_POST['password']);
    
  if(!empty($_FILES["file"]["name"])){
    $pic_a = 1;
  }else{
    $pic_a = 0;
  }



    if($pic_a == 0){

      $fileName   = pathinfo( $_FILES["file"]["name"], PATHINFO_FILENAME ) . "" . date('dmYHis');
      $fileType  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
      $fileName   = $fileName . "." . $fileType;
      $targetFilePath = $targetDir . $fileName;

  // Allow certain file formats
      $allowTypes = array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF');
      if(in_array($fileType, $allowTypes)){
          // Upload file to server
          if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
              // Insert image file name into database
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
            
                $statement = $db->prepare("insert into users (full_name, user_name, user_pass, user_email, user_phone, code,pic_file) values(?,?,?,?,?,?,?)");
                $statement->execute(array(
                        $_POST['full_name'],
                        $_POST['username'],
                        $password,
                        $_POST['user_email'],
                        $_POST['user_phone'],
                        $code = getrandom(),
                        $fileName
                    ));
                
                $success_message = "User has been Registerd Successfully.....!";
                    
                    //$db = null;
              
              }
                catch(Exception $e){
                $error_message = $e->getMessage();
              }

          }else{
              $error_message = "Sorry, there was an error uploading your file.";
          }
      }else{
          $error_message = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
      }
    }else{
      $error_message = 'Please select a file to upload.';

    }
    






		
//02		
		// $username = $_POST['username'];
		
		
    
	



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
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create account - Windmill Dashboard</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../assets/css/tailwind.output.css" />
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <script type="text/javascript">
        function SetMaxLength () {
            var input = document.getElementById ("user_phone");
            input.maxLength = 10;
            input.minlenght = 10;
        }
    </script>
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
              src="../assets/img/create-account-office.jpeg"
              alt="Office"
            />
            <img
              aria-hidden="true"
              class="hidden object-cover w-full h-full dark:block"
              src="../assets/img/create-account-office-dark.jpeg"
              alt="Office"
            />
          </div>
          <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
              <h1
                class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Create account
              </h1>
              <form class="mt-8 space-y-6" action="" method="POST" enctype="multipart/form-data">
              <?php if(isset($error_message)){?>
                        <div class="bg-red-100 mb-4 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo $error_message; ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                        </div>
                    <?php  }?> 
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Full name</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Full name" name="full_name"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Username</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="username"
                  type="text"
                  placeholder="User name"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Picture</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="file"
                  type="file"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="user_email"
                  type="email"
                  placeholder="Example@mail.com"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Phone number</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="user_phone"
                  type="tel"
                  placeholder="0612256485"
                  pattern="[0-9]{10}"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Password
                </span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password" name="password"
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Confirm password
                </span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="***************"
                  type="password" name="password2"
                  required
                />
              </label>

              <div class="flex mt-6 text-sm">
                <label class="flex items-center dark:text-gray-400">
                  <input
                    type="checkbox"
                    class="text-purple-600 form-checkbox focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                    required
                    />
                  <span class="ml-2">
                    I agree to the
                    <a class="underline" href="privacy_police.html" target="_blank">privacy policy</a>
                  </span>
                </label>
              </div>

              <!-- You should use a button here, as the anchor is only used for the example  -->
              <button
                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit" name="form_login"
              >
                Create account
              </button>
              </form>

              <hr class="my-8" />

              

              <p class="mt-4">
                <a
                  class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                  href="./login.html"
                >
                  Already have an account? Login
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
