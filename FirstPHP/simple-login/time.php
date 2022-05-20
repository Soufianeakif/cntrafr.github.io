<?php

function check($start_date, $end_date, $date_from_user) {

  // $start = strtotime($start_date);
  // $end = strtotime($end_date);
  // $check = strtotime($date_from_user);

  $start = $start_date;
  $end = $end_date;
  $check = $date_from_user;

  return (($start <= $check ) && ($check <= $end));
}

function secondcheck() {

  if (check($s, $e, $u)){
    $x= "Busy";
  }else{
    if($u < $n){
      $x= "not valid";
    }else{
      $x= "Free";
    }
  }
  return $x;
}

// echo "Today is " . date("Y/m/d") . "<br>";
// echo "Today is " . date("Y.m.d") . "<br>";
// echo "Today is " . date("Y-m-d") . "<br>";
// echo "Today is " . date("l") . "<br>";


// echo "The time 
// is " . date("h:i:sa") . "<br>"; 

// $d=mktime(12, 14, 54, 8, 12, 2030);
// echo "Created date is " . date("Y-m-d h:i:sa", $d) . "<br>";

// $d=strtotime("10:30pm April 15 2014");
// echo "Created date is " . date("Y-m-d h:i:sa", $d) . "<br>";
// echo $d . "hahahaha <br>";

// $d=strtotime("tomorrow");
// echo date("Y-m-d h:i:sa", $d) . "<br>";

// $d=strtotime("next Saturday");
// echo date("Y-m-d h:i:sa", $d) . "<br>";

// $d=strtotime("-1 Hour");
// echo date("Y-m-d h:i:sa", $d) . "<br>";



$t=array();
$startdate = strtotime("Today");

for ($x = 0; $x <= 23; $x++) {
  array_push($t,$startdate);
  $startdate = strtotime("+1 hour", $startdate);
}
print_r($t);echo "<br><br>";

foreach ($t as $output){
  echo date("H:i", $output) . " || ";
}
echo "<br><br>";
//echo check($t[1], $t[15], $t[10]) . "<br>";

$d=strtotime("16:59 May 20 2022");

$s = $t[13];
$e = $d;
$u = $t[15];
$n = strtotime("-1 hour",strtotime("now"));

echo date("H:i",$s) ."<br>";
echo date("H:i",$e) ."<br>";
echo date("H:i",$u) ."<br>";
var_dump (check($s, $d, $t[22]));

echo "<br><br>";

echo $s ."<br>";
echo $e ."<br>";
echo $u ."<br>";

echo "<br>------------------------------------------------------<br>";
echo date("H:i",$n) . "<br>";

if (check($s, $e, $u)){
  echo "Busy";
}else{
  if($u < $n){
    echo "not valid";
  }else{
    echo "Free";
  }
}





function check2($start_date, $end_date, $date_from_user) {

  $start = $start_date;
  $end = $end_date;
  $check = $date_from_user;
  $n = strtotime("-1 hour",strtotime("now"));

  // Check that user date is between start & end
  if (($start <= $check ) && ($check <= $end)){
    echo "Busy";
  }else{
    if($check < $n){
      echo "not valid";
    }else{
      echo "Free";
    }
  }
}

echo "<br>------------------------------------------------------<br>";
echo check2($s, $e, $u) . "<br>";



/******
 * 3,540 = 59min
 * 
 * *******/ 

 echo strtotime("2022-05-19T13:08:35.698Z") . "<br>";
 echo date("Y-m-d h:i:sa", strtotime("2022-05-19T13:08:35.698Z"));



 echo "<br>------------------------------------------------------<br>";
 echo "------------------------------------------------------<br>";


 function checkbusy($indb_start, $indb_end, $start_date, $end_date) {

  $db_start = $indb_start;
  $db_end = $indb_end;
  $start = $start_date;
  $end = $end_date;

  //return (($start >= $db_start) && ($end <= $db_end));
  return ((($db_start <= $start ) && ($start <= $db_end)) || (($db_start <= $end ) && ($end <= $db_end)));
}

 var_dump(checkbusy(1653048000,1653055140,1653044400,1653051600));

?>
















<?php


?>