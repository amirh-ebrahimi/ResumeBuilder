<?php

function newEmployer($username,$password_hash,$company,$phone,$area,$city){

    global $connection;

    $query = "INSERT INTO employers VALUES (null,'$username','$password_hash','$company','$phone','$area','$city')";

    mysqli_query($connection,$query) or die("newEmployer has an error");
}

function employerUsernameIsUnique($username)
{

    global $connection;
    global $errors;

    $query = "SELECT * FROM employers WHERE employers.username ='$username'";
    $result = mysqli_query($connection, $query) or die("employer_uniqueUsername has an error");
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0) {

        $errors[] = "This username is used before.";
        return false;
    }

    return true;
}