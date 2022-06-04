<?php



if (isset($_POST['submit'])) {
  $secret = "6LeI8zYgAAAAAL9-GQj_C0vXlzJ37zHlvt8uqfw0";
  $response = $_POST['g-recaptcha-response'];
  $remoteip = $_SERVER['REMOTE_ADDR'];
  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
  $data = file_get_contents($url);
  $row = json_decode($data, true);

  if ($row['success'] == "true") {
    echo "<script>alert('Wow you are not a robot 😲');</script>";
  } else {
    echo "<script>alert('Oops you are a robot 😡');</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Document</title>
</head>
<body>

  <form method="post" class="container">
    <h5>Google Recaptcha</h5>
    <br>
    <div class="row">
      <div class="g-recaptcha" data-sitekey="6LeI8zYgAAAAAFaloQyBg4EQMHF0JHfuinxdak8_"></div>
    </div>
    <button class="btn wave-effect wave-light" type="submit" name="submit">Check</button>
  </form>

  <!-- Materialize JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>