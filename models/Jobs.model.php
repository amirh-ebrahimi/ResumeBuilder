<?php
function newJobs($jobseeker_id,$job1, $job2, $job3)
{

    global $connection;
    $jobs = [$job1, $job2, $job3];
    $job_ids = [];

    foreach ($jobs as $job) {

        if (!empty($job)) {

            $query = "INSERT INTO jobs VALUES (null, $jobseeker_id ,'$job[0]'";

            if (!empty($job[2])) { // if end date is entered then...

                $query .= ", '$job[2]'"; // ... enter it to the query else...
            } else { //... enter null.

                $query .= ", null";
            }

            if (!empty($job[3])) { // if reason is entered then...

                $query .= ", '$job[3]'"; // ... enter it to the query else...
            } else { //... enter null.

                $query .= ", null)";
            }

            mysqli_query($connection, $query) or die("newJobs has an error");
            $job_ids[] = mysqli_insert_id($connection);
        }
    }

    return $job_ids;
}

