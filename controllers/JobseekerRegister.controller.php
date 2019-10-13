<?php
include_once "../includes/connect_db.inc.php";
include_once "../includes/Validation.inc.php";
include_once "../includes/Captcha.inc.php";
include_once "../includes/helpers.inc.php";

include_once "../models/education.model.php";
include_once "../models/Jobs.model.php";
include_once "../models/Jobseekers.model.php";
include_once "../models/Skills.model.php";
include_once "../models/Interests.model.php";

session_start();
$errors = [];
$captcha = makingCaptcha();
if (isset($_POST["jobseeker"]) && jobseekerFieldsAreFilled() && jobseekerValidation()) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $name = $_POST["name"];
    $family = $_POST["family"];
    $nationality = $_POST["nationality"];
    $gender = $_POST["gender"];
    $birth_date = $_POST["birth-date"];
    $birth_place = $_POST["birth-place"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $last_degree = $_POST["last-degree"];
    $gpa = $_POST["gpa"];


    ## define job variables ##
    if (!empty(trim($_POST["job1-title"]))) { // if the job is entered then...

        $job1 = [$_POST["job1-title"], $_POST["job1-start"], $_POST["job1-end"], $_POST["job1_reason"]]; // enter all the details of job in an array
    }else{

        $job1 = null;
    }

    if (!empty(trim($_POST["job2-title"]))) { // if the job is entered then...

        $job2 = [$_POST["job2-title"], $_POST["job2-start"], $_POST["job2-end"], $_POST["job2_reason"]]; // enter all the details of job in an array
    }else{

        $job2 = null;
    }

    if (!empty(trim($_POST["job3-title"]))) { // if the job is entered then...

        $job3 = [$_POST["job3-title"], $_POST["job3-start"], $_POST["job3-end"], $_POST["job3_reason"]]; // enter all the details of job in an array
    }else{

        $job3 = null;
    }


    ## define detail variable ##
    if (!empty(trim($_POST["details"]))) {
        $details = cleanString($_POST["details"]);
    }else{

        $details = null;
    }

    ## skill variable ##
    $skills_text = cleanString($_POST["skills"]);
    $skills = giveArray($skills_text);

    ## define interests ##
    if (!empty($_POST["interests"])) {
        $interests_text = cleanString($_POST["interests"]);
        $interests = giveArray($interests_text);
    }else{

        $interests = null;
    }

    ## Insert education ##
    $edu_id = newEdu($last_degree, $gpa);
    ## Insert a new jobseeker ##
    $jobseeker_id = newJobseeker($username, $password_hash, $name, $family, $nationality, $gender, $birth_date, $birth_place, $email, $phone, $details,$edu_id, $jobs_id);


    ## Insert new jobs ##
     newJobs($jobseeker_id,$job1, $job2, $job3);


    ## Insert new skills ##
    $skills_id = newSkills($skills);
    jobseekerSkillsPivot($jobseeker_id, $skills_id);

    ##Insert new Interests ##
    if (!empty($interests)) {

        $interests_id = newInterests($interests);
        jobseekerInterestsPivot($jobseeker_id, $interests_id);
    }

    mysqli_close($connection);

    header("location:Dashboard.controller.php");

} else {

    $_SESSION["captcha"] = $captcha;
    include "../views/JobseekerRegister.view.php";
}