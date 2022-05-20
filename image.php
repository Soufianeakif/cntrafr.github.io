<?php  
  
// image to string conversion
$imagelink = file_get_contents('C:\Users\SOUFIANE\Pictures\moi.png'); 
  
// image string data into base64 
$encdata = base64_encode($imagelink);

  
// Output
echo $encdata; 
?>