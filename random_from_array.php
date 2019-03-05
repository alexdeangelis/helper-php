<?php
//Create array
$a = array("red","green","blue","yellow","brown");

var_dump($a);

//Get 1 random item from the array. This returns the position in the array that has been chosen
$random_key = array_rand($a, 1);

var_dump($a[$random_keys]);

?>