<?php
function cleanString($string){

    $regex = '/[$"\'<>^!%()]/';
    $string = preg_replace($regex,"",$string);

    return $string;
}

##This function will give the array of skills or interests in its return ##
function giveArray($data){

    $data_arr = explode(",",$data);
    $data_arr = array_map('trim',$data_arr); // trim all the elements.
    $data_arr = array_filter($data_arr,function ($value){return !empty($value);}); // it removes every empty elements of an array.
    $data_arr = array_unique($data_arr); //eliminates duplicated elements.

    if(count($data_arr) > 3){

        $data_arr = array_slice($data_arr,0,3); // just select 3 first elements.
    }

    return $data_arr;
}

## Showing all Errors ##
function errorMassages(array $errors)
{

    echo "We are very sorry, but there were error(s) found with the form you submitted. ";
    echo "These errors appear below.<br /><br />";

    foreach ($errors as $error) {
        echo "<p style='color: red; font-size: large'>".$error."</p>";
    }
    echo "Please go back and fix these errors.<br /><br />";

}