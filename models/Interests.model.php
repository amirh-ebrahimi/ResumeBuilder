<?php

function newInterests($interests){

    global $connection;
    $interests_id = [];

    foreach ($interests as $interest){

        $id = getInterestId($interest);

        if(empty($id)){

            $query = "INSERT INTO interests VALUES (null,'$interest')";
            mysqli_query($connection,$query) or die("newInterest has an error");
            $interests_id[] = mysqli_insert_id($connection);
        }else{

            $interests_id[] = $id;
        }
    }

    return $interests_id;
}

function getInterestId($interest){

    global $connection;

    $query = "SELECT interests.ID FROM interests WHERE interest_name = '$interest' ";
    $result = mysqli_query($connection,$query) or die("getInterestId has an error");
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);
    $id = reset($row);

    return $id;
}

function jobseekerInterestsPivot($jobseeker_id, $interests_id){

    global $connection;

    foreach ($interests_id as $interest_id){

        $query = "INSERT INTO jobseekers_has_interests VALUES (null, $jobseeker_id, $interest_id)";
        mysqli_query($connection,$query) or die("interest_jobseeker_pivot has an error");
    }
}