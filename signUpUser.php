<?php
	include("investmenConfig.php");
	
	$userEmailId = $_POST['userEmailId'];
	$userName= $_POST['userName'];
	$userPassword = $_POST['userPassword'];
	$userGivenName = $_POST['userGivenName'];

	$signUpSQL = "insert into INVESTMEN_USERS (USER_NAME, USER_PASSWORD, USER_ROLE, USER_GIVEN_NAME, USER_EMAIL_ID) values ('" . $userName . "','" . $userPassword . "', 1, '" . $userGivenName . "','" . $userEmailId . "')";
	
	mysql_select_db($dbname);
	$retval = mysql_query( $signUpSQL, $conn );

	if(! $retval ) {
		echo 'Error creating user: Code 10E45T1';
	}

	if(mysql_query($signUpSQL) == TRUE){
		$_SESSION['given_user'] = $userGivenName;
		echo 'Welcome '. $userGivenName . '!!';
	}else{
		echo 'Error creating user';
	}
?>