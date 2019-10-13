<?php

function jobseekerFieldsAreFilled()
{
    global $errors;
    $fill = !empty($_POST["name"]) && !empty($_POST["family"]) && !empty($_POST["nationality"]) && !empty($_POST["email"]) &&
        !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["birth-date"]) && !empty($_POST["gpa"]) &&
        !empty($_POST["birth-place"]) && !empty($_POST["gender"]) && !empty($_POST["phone"]) && !empty($_POST["last-degree"]) &&
        !empty($_POST["skills"] && !empty($_POST["captcha"]));





    if ($fill) {

        return true;
    } else {
        $errors[] = "Please fill all the necessary fields";
        return false;
    }
}

function validateUsername()
{

    global $errors;
    /*
     *  Username only can have alphabets,numbers,"." and "_"
     * Username size is between 8 and 20
     * Username can't have "." and "_" at the beginning or end of it.
     * Username can't have "__" , "._" , "_." and ".."
     */
    $regex = "/^(?=.{4,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/";
    if (!preg_match($regex, $_POST["username"])) {

        $errors[] = "Your username is not valid";
        return false;
    } else {

        return true;
    }
}

function validateName($index)
{

    global $errors;
    $regex = "/^[A-Z][a-zA-Z][^#&<>\"~;$^%{}?()*0-9]{1,}$/i";
    if (!preg_match($regex, trim($_POST[$index]))) {

        $errors[] = "Please Enter a Valid " . $index;
        return false;

    } else {

        return true;
    }
}

## check the strength of password ##
function passIsStrong()
{

    global $errors;

    if (strlen($_POST["password"]) < 8) {
        $errors[] = "Password too short! (at least 8 characters)";
        return false;
    }

    if (!preg_match("#\d#", $_POST["password"])) {
        $errors[] = "Password must include at least one number!";
        return false;
    }

    if (!preg_match("#[a-zA-Z]#", $_POST["password"])) {
        $errors[] = "Password must include at least one letter!";
        return false;
    }

    if (!preg_match("#[^a-zA-Z\d]#", $_POST["password"])) {
        $errors[] = "Password must include at least one special characters!";
        return false;
    }

    return true;
}

function validatePhone()
{

    global $errors;

    if (!is_numeric($_POST["phone"])) {

        $errors[] = "The phone number must be only numbers";
        return false;

    }

    return true;

}

function validateEmail()
{
    global $errors;

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {

        $errors[] = "Please enter a valid email!";
        return false;
    }

    return true;
}

function validateGPA()
{

    global $errors;

    if (!filter_var($_POST["gpa"], FILTER_VALIDATE_FLOAT)) {

        $errors[] = "Pleas enter a valid float number for GPA";
        return false;
    }

    return true;
}

function validateGender()
{

    global $errors;

    $genders = ["male", "female"];
    if (!in_array($_POST["gender"], $genders)) {

        $errors[] = "Your gender should be between Male or Female";
        return false;
    }

    return true;
}

function validateLastDegree()
{

    global $errors;

    $degrees = ["high-school", "bachelor", "master", "PhD"];
    if (!in_array($_POST["last-degree"], $degrees)) {

        $errors[] = "Your degree should be in options";
        return false;
    }

    return true;

}

function validateJobs(){

    global $errors;

    ## these ifs check when a job is entered then it must have a start date ##
    if(!empty(trim($_POST["job1-title"])) && empty(trim($_POST["job1-start"]))) {

        $errors[] = "Please Enter a start date for your first job";
        return false;
    }
    if(!empty(trim($_POST["job2-title"])) && empty(trim($_POST["job2-start"]))) {

        $errors[] = "Please Enter a start date for your second job";
        return false;
    }
    if(!empty(trim($_POST["job3-title"])) && empty(trim($_POST["job3-start"]))) {

        $errors[] = "Please Enter a start date for your third job";
        return false;
    }

    return true;
}

function validateDateFormat($date)
{

    global $errors;

    $date_arr = explode('-', $date);
    if (!checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {

        $errors[] = "Please Enter a valid date";
        return false;
    }

    return true;
}

## It checks if the date is not for future or many many years ago ##
function dateIsSensible($date)
{

    global $errors;

    $date_arr = explode('-', $date);

    if ($date > date("Y-m-d")) {

        $errors[] = "The Date can not be in future";
        return false;
    }

    if ($date_arr[0] < "1920") { // if the date year is less than 1920

        $errors[] = "The date is too old to be valid!";
        return false;
    }

    return true;
}

function validateDate($date)
{

    return (validateDateFormat($date) && dateIsSensible($date));
}

function validateAllJobseekerFormDates()
{

   $valid = validateDate($_POST["birth-date"]);

    if(!empty(trim($_POST["job1-title"]))){

        $valid = $valid && validateDate($_POST["job1-start"]);

        if(!empty($_POST["job1-end"])){

            $valid = $valid && validateDate($_POST["job1-end"]);
        }

    }
    if(!empty(trim($_POST["job2-title"]))){

        $valid = $valid && validateDate($_POST["job2-start"]);

        if(!empty($_POST["job1-end"])){

            $valid = $valid && validateDate($_POST["job2-end"]);
        }

    }
    if(!empty(trim($_POST["job2-title"]))){

        $valid = $valid && validateDate($_POST["job2-start"]);

        if(!empty($_POST["job1-end"])){

            $valid = $valid && validateDate($_POST["job2-end"]);
        }

    }

    return $valid;
}

function jobseekerValidation()
{


    return (validateName("name") & validateName("family") & validateName("birth-place") & validateName("nationality") &
        validateUsername() & passIsStrong() & validateGender() & validatePhone() & validateEmail() & validateLastDegree() & validateGPA() & validateAllJobseekerFormDates()
        & checkingCaptcha() & usernameIsUnique($_POST["username"]) & emailIsUnique($_POST["email"]) & validateJobs());

}

## check if the user is logged in or not ##
function loggedIn()
{

    if (!isset($_SESSION["user"])) {

        header("location:LogIn.controller.php");
        exit();
    }
}
