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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Verification</title>
</head>
<body>
                    
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-14 w-auto" src="https://www.svgrepo.com/show/304317/type-password.svg" alt="Workflow">
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Change password</h2>
                <div class="form_message">
            </div>
            <form class="mt-8 space-y-6" action="" method="POST">
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px">
                <div>
                
                        <div class="bg-green-100 mb-4 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline "><?php echo $start_message; ?></span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        </span>
                        </div>
                    
                    <label for="verification_code" class="sr-only">verification code</label>
                    <input id="verification_code" name="verification_code" type="text" autocomplete="verification_code" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="verification code">
                </div>
                <?php
                if(isset($error_message)){echo "<div><p class='ml-2 block text-sm text-red-600'>".$error_message."</p></div>";}
                ?>
                <div>
                <button type="submit" name="form_login" class="group relative w-full flex justify-center py-2 px-4 mt-5 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <!-- Heroicon name: solid/lock-closed -->
                    <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                    </span>
                    Confirm
                </button>
                </div>
            </form>
        </div>
</body>
</html>