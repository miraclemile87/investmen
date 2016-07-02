<?php
	include("investmenConfigMySQLi.php");
	
	$fetchJobsSQL = "SELECT jobs.JOB_ID, jobs.JOB_LABEL, jobs.JOB_DESCRIPTION, jobs.JOB_CREATION_DATE, jobs.JOB_TYPE FROM investmen_job jobs";
	
	$retval = mysqli_query( $conn, $fetchJobsSQL );

	if(! $retval ) {
		echo mysqli_error;
	}

	$jobsArray = array();
	
	while($row = mysqli_fetch_assoc($retval))
    {
        $jobsArray[] = $row;
    }
	
	echo json_encode($jobsArray);
	
?>