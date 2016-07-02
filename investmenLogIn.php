<?php
	session_start();
	include("investmenConfig.php");
	if(isset($_SESSION['investmenError']))
		$error = $_SESSION['investmenError'];
	else
		$error = "";
	//function logInUser(){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$myusername = $_POST['txtLogInUserName'];
			$mypassword = strrev($_POST['txtLogInPassword']);

			$sql = "SELECT user_id, user_role, user_given_name, user_password FROM INVESTMEN_USERS WHERE user_name = '$myusername'";

			mysql_select_db($dbname);
			$retval = mysql_query( $sql, $conn );

			if(! $retval ) {
				die('Could not select investmen users: ' . mysql_error());
			}

			$row = mysql_fetch_array($retval,MYSQL_NUM);
			$count = mysql_num_rows($retval);

			echo $count . ' and ' . $row[3];
			if($count == 0){
				$error = "***Retry with proper username/password( New user try sign up )";
			}else{
				//TODO: > 1
				//if($count > 3) {
				if(1 == 1){
					if($row[3] == $mypassword){				
						$_SESSION['login_user'] = $myusername;
						$_SESSION['USER_GIVE_NAME'] = $row[2];
						$_SESSION['login_user_role'] = $row[1];
						$_SESSION['USER_ID'] = $row[0];
						$_SESSION['USER_NAME'] = $myusername;
						header("location: investmenAdminConsole.php");
					}
					else{
						$error = "***Invalid Login or Password";
					}
				}else {
					$error = "***Problem fetching the user. Contact Administrator";
				}
			}
		}
	//}
	/*if(isset($_POST['submit']))
	{
		logInUser();
	}*/
?>
<html>
	<head>
		<script src="lib/jquery-1.12.0.min.js"></script>
		<link rel="stylesheet" href="lib/bootstrap-3.3.6-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="lib/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
		<script src="lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="js/investmenLogIn.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.text-center h1{
			    font-size: 3.5em
			}
			/*body{
				background: rgb(236, 239, 241)
			}*/
		</style>
		<script>
			$(document).ready(function(){
				$("#txtLogInUserName").focus();
			});
		</script>
		</head>

	<body class="container-fluid">
		<div class="page-header text-center">
			<h1 style="font-family:Cambria; color: #337ab7">
				<span class='glyphicon glyphicon glyphicon-briefcase'>INVESTMEN</span>
			</h1>
			<p style="color: grey">If it's a pattern, crack it. If it demands discipline, track it.</p>
			</div>
			<div class="row">
				<div class="">
    			<div class="col-sm-4"></div>
				<div id='divNotifyUserMain' style='display: none' class="col-sm-4" style="margin-top: 1%">
					<h2 style='color: #5bc0de' id='divNotifyUser'>
					</h2>
					<a href="investmenAdminConsole.php" class="btn btn-success">Lets get started</a>
				</div>
    			<div class="col-sm-4" style="margin-top: 1%" id='divLogInSignUpUser'>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#logInInvestmen">Log In</a></li>
						<li><a data-toggle="tab" href="#singUpInvestmen">Sign up</a></li>
					</ul>
					<div class="tab-content">
							<div id="logInInvestmen" class="tab-pane fade in active">
								<form role="form" name="formLogIn" action="" method="post">
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtLogInUserName">Username: </label>
										<input type="text" class="form-control" id="txtLogInUserName" name="txtLogInUserName" required placeholder="Enter Username" />
									</div>
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtLogInPassword">Password: </label>
										<input type="password" class="form-control" id="txtLogInPassword" name="txtLogInPassword" required placeholder="Enter Password"></input>
									</div>
									<label id="lblError" style="font-family:Cambria; color:red"><?php echo "$error" ?></label><br/>
									<div style="text-align:center" id="divButtons">
										<input type="submit" class="btn btn-primary" value="Submit"</input>
										<input style="margin-left:2%" type="reset" value="Reset" class="btn btn-warning"></input>
									</div>
								</form>
							</div>
							<div id="singUpInvestmen" class="tab-pane fade">
								<form role="form" name="formSignUp" action="signUpUser.php" method="post">
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtFirstName">First Name: </label>
										<input type="text" class="form-control" id="txtFirstName" name="txtFirstName" required placeholder="Enter First Name" />
									</div>
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtLastName">Last Name: </label>
										<input type="text" class="form-control" id="txtLastName" name="txtLastName" required placeholder="Enter Last Name" />
									</div>
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtEmailId">Email Name: </label>
										<input type="email" class="form-control" id="txtEmailId" name="txtEmailId" required placeholder="Enter Email" />
									</div>
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtUserName">User Name: </label>
										<input type="text" class="form-control" id="txtUserName" name="txtUserName" required placeholder="Enter username" />
									</div>
									<div class="form-group">
										<label style="font-family:Cambria; color: #337ab7" for="txtUserPassword">Password: </label>
										<input type="password" class="form-control" id="txtUserPassword" name="txtUserPassword" required placeholder="Enter Password"></input>
									</div>
									<label id="lblError" style="font-family:Cambria; color:red"><?php echo "$error" ?></label><br/>
									<div style="text-align:center" id="divButtons">
										<input type="button" class="btn btn-primary" id='signUpUser' value="Sign up"</input>
										<input style="margin-left:2%" type="reset" value="Reset" class="btn btn-warning"></input>
									</div>
								</form>
							</div>
					</div>
    				
    			</div>
				<div class="col-sm-4"></div>
				</div>
  			</div>
	</body>
</html>