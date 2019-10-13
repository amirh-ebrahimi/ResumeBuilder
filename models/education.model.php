<?php

function newEdu($last_degree,$gpa){

    global $connection;

    $query = "INSERT INTO education VALUES (null,'$last_degree','$gpa')";
    mysqli_query($connection,$query) or die("newEdu could not run");

    return (mysqli_insert_id($connection));
}

