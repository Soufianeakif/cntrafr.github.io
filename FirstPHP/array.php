<?php

$people = ['hanane','bouchra'];
print_r($people);

$contacts = ['hanane' => '0687412654',
             'hajar'  => '0658452486',
             'ayoub'  => '0798452486',
            ];

echo '<br>';
print_r($contacts);

$people = [...$people,'azdin'];

$people = ['hamid',...$people];

echo '<br>';
print_r($people);

echo '<br>';
print_r($people[2]);

$fikjo3 = ['couscous','pizza','rfissa','sushi','wajooooo3'];

$prix = ['couscous' => '2درهم ',
         'pizza'  => '19درهم',
         'rfissa'  => '200 درهم',
];

echo '<br> jib jib m3ak chi pizza';

echo "<br>khod lak $people[2]";

echo "<br>taman $prix[pizza]";
echo '<br>';

$peoplefikjo3 = array_merge($people,$fikjo3);
$fikjo3people = [...$people,...$fikjo3];
echo '<br>';
print_r($peoplefikjo3);
echo '<br>';
print_r($fikjo3people);

echo '<br>-----------------------------------------------------------------------<br>';

$courses = [
  ['name' => 'PHP', 'price' => '300'],
  ['name' => 'JS', 'price' => '200'],
  ['name' => 'Angular', 'price' => '400']
];

print_r($courses);

$courses[1]['price']= '150';
echo '<br>';
print_r($courses);

$courses[]=['name' => 'ReactJS', 'price' => '999'];
echo '<br>';
print_r($courses);

$courses[]=[...$courses,'name' => 'NodeJS', 'price' => '499'];
echo '<br>';
print_r($courses);

?>

<html>
  <head>
    <title>Array</title>
  </head>
  <body>
    


  </body>
</html>