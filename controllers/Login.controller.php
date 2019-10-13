<?php
include_once "../includes/connect_db.inc.php";
include_once "../includes/helpers.inc.php";

include_once "../models/Jobseekers.model.php";
include_once "../models/Employers.model.php";

session_start();
$errors = [];

if(isset($_POST["jobseeker"])){

    $username = $_POST["j-username"];
    $password = $_POST["j-password"];

    if($jobseeker = getJobseeker($username,$password)){

        $_SESSION["jobseeker"] = $jobseeker["username"];
        mysqli_close($connection);
        header("location:JobseekerDashboard.controller.php");
    }else{

        include "../views/Login.view.php";
    }
}elseif(isset($_POST["employer"])){

    $username = $_POST["e-username"];
    $password = $_POST["e-password"];

    if($employer = getEmployer($username,$password)){

        $_SESSION["employer"] = $employer["username"];
        mysqli_close($connection);
        header("location:EmployerDashboard.controller.php");
    }else{

        include "../views/Login.view.php";
    }
}else{

    include "../views/Login.view.php";
}