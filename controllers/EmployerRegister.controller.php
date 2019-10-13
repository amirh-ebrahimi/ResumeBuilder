<?php
include_once "../includes/connect_db.inc.php";
include_once "../includes/Validation.inc.php";
include_once "../includes/helpers.inc.php";

include_once "../models/Employers.model.php";

$errors = [];

if(isset($_POST["employer"]) && employerFieldsAreFilled() && employerValidation()){

    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $company = cleanString($_POST["company"]);
    $phone = $_POST["phone"];
    $area = cleanString($_POST["area"]);
    $city = $_POST["city"];

    newEmployer($username,$password_hash,$company,$phone,$area,$city);

    mysqli_close($connection);
    header("location:Login.controller.php");
}else{

    include "../views/EmployerRegister.view.php";
}