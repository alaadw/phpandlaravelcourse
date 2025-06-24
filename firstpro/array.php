<?php

$array = [1,2,10,20];

//print_r($array);//
//echo $array[1];     // Accessing the second element of the array

foreach ($array as $k=> $value) {
    echo "  $k =>".$value . " "; // Loop through the array and print each value
}

echo "<br/>count = ".count($array)."<br/>"; // Count the number of elements in the array
echo "max = ".max($array)."<br/>"; // Find the maximum value in the array   
echo "min = ".min($array)."<br/>"; // Find the minimum value in the array
echo "sum = ".array_sum($array)."<br/>"; // Calculate the sum of all elements in the array
