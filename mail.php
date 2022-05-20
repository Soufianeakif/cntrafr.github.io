<?php
for ($x = 0; $x <= 5; $x++) {
    $receiver = "soufiane4akif@gmail.com";
    $subject = "Email Test via PHP using Localhost";
    $body = "Hi, <p>Salam</p>";
    $sender = "From:centredaffaire@protonmail.com";

    if(mail($receiver, $subject, $body, $sender)){
        echo "Email sent successfully to $receiver";
    }else{
        echo "Sorry, failed while sending mail!";
    }
    }

?>