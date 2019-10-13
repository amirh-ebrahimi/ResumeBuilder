<?php

function newSkills($skills){

    global $connection;
    $skills_id = [];

    foreach ($skills as $skill){

        $id = getSkillId($skill);

        if(empty($id)){

            $query = "INSERT INTO skills VALUES (null,'$skill')";
            mysqli_query($connection,$query) or die("newSkill has an error");
            $skills_id[] = mysqli_insert_id($connection);
        }else{

            $skills_id[] = $id;
        }
    }

    return $skills_id;

}

function getSkillId($skill){

    global $connection;

    $query = "SELECT skills.ID FROM skills WHERE skill_name = '$skill' ";
    $result = mysqli_query($connection,$query) or die("getSkillId has an error");
    $row = mysqli_fetch_all($result);
    mysqli_free_result($result);
    $id = reset($row);

    return $id;
}

function jobseekerSkillsPivot($jobseeker_id, $skills_id){

    global $connection;


    foreach ($skills_id as $skill_id){

        $query = "INSERT INTO jobseekers_has_skills VALUES (null, $jobseeker_id, $skill_id)";
        mysqli_query($connection,$query) or die("skill_jobseeker_pivot has an error");
    }
}