<?php
function usernameIsUnique($username)
{

    global $connection;
    global $errors;

    $query = "SELECT * FROM jobseekers WHERE jobseekers.username ='$username'";
    $result = mysqli_query($connection, $query) or die("uniqueUsername has an error");
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0) {

        $errors[] = "This username is used before.";
        return false;
    }

    return true;
}

function emailIsUnique($email)
{

    global $connection;
    global $errors;

    $query = "SELECT * FROM jobseekers WHERE jobseekers.email = '$email'";
    $result = mysqli_query($connection, $query) or die("emailUnique has an error");
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if (count($row) > 0) {

        $errors[] = "This email is used before.";
        return false;
    }

    return true;

}

function newJobseeker($username, $password_hash, $name, $family, $nationality, $gender, $birth_date, $birth_place, $email, $phone, $details, $edu_id)
{
    global $connection;

    $query = "INSERT INTO jobseekers VALUES (null,'$username','$password_hash','$name','$family','$nationality','$gender'
                                            ,'$birth_date','$birth_place','$email','$phone',";

    if (!empty($details)) {

        $query .= "'$details',";
    } else {

        $query .= "null,";
    }

    $query .= "$edu_id)";

    mysqli_query($connection,$query) or die("newJobseeker has an error");
    $jobseeker_id = mysqli_insert_id($connection);

    return $jobseeker_id;


}

function getJobseeker($username,$password){

    global $connection;
    global $errors;

    $query = "SELECT * FROM jobseekers WHERE username = '$username'";

    $result = mysqli_query($connection,$query) or die("getJobseeker has an error");
    $row = mysqli_fetch_all($result,1);
    $user = reset($row);
    mysqli_free_result($result);

    if(!empty($user) && password_verify($password,$user["password"])){

        return $user;
    }else{

        $errors[] = "Username or Password is not correct";
        return false;
    }

}