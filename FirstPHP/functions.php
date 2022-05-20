<?php

$courses = [
  ['name' => 'PHP', 'price' => '300'],
  ['name' => 'JS', 'price' => '200'],
  ['name' => 'Angular', 'price' => '400']
];

function saySalam($name){
  echo "<h1>salam mon cher $name !<h1>";
}

function formatCourse($course){
  echo "Formation smitha  {$course['name']} o taman {$course['price']}";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>function</title>
</head>
<body>
  <?php
    saySalam('Soufiane');
  ?>
  <ul>
    <?php
      foreach($courses as $course){
        $status = $course['price'] > 300 ? 'Flagship' : 'Low Cost';
      
      ?>
        <li>
          <h2><?php echo $status; ?></h2>
          <?php formatCourse($course); ?>
        </li> 

      <?php } ?>
    
  </ul>

</body>
</html>