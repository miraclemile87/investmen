<?php
	include("investmenConfig.php");
?>
<html>
	<head>
		<script src="lib/jquery-1.12.0.min.js"></script>
		<link rel="stylesheet" href="lib/bootstrap-3.3.6-dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/investmen.css">
		<link rel="stylesheet" href="lib/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="lib/jquery.dataTables.min.css">
		<script src="lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="lib/jquery.dataTables.min.js"></script>
		<script src="js/investmenURLMaker.js"></script>
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
				
				var jqAJAX = $.post('fetchJobs.php');
				jqAJAX.done(function( data ) {
					alert(data);
					var dt = data;
					$('#tblInvestmenJobs').DataTable({
							"ajax": {
								'url': 'fetchJobs.php',
								'type': 'get'
							}
					});
				});
				jqAJAX.fail(function(data){
					alert('failed' + data);
				});
				
			});
				
				/*$.ajax({
					url: 'fetchJobs.php',
					type: 'POST',
					dataType: "json",
					})
					.done(function(data){
						alert(data);
						
						console.log(data);
						
						$('#tblInvestmenJobs').DataTable({
							"ajax": data
						});
					})
					.error(function(data){
						alert('error' + data);
					});
				});*/
		</script>
	</head>
	<body>
		<?php
			include("investmenAdminMenu.php");
		?>
		<div id='divURLMakerParent' style='margin-top:60px'>		
			<div id='divMenuMaker'>
				<div id='divToolkit'>
					<div>
						<button type="button" id='btnText' class="btn btn-primary">Text</button>
						<button type="button" id='btnDate' class="btn btn-primary">Date</button>
						<button type="button" id='btnIteratorList' class="btn btn-primary">Iterator List</button>
					</div>
				</div>
				<div id='divURL'>
					<div id='divURLAssembler'>
						<form role="form" class="form-inline">
							
						</form>
					</div>
					<label id='lblSampleURLLabel' style='display:none'>Sample URL: </label>
					<label id='lblSampleURL'></label>
					<a href='' id='btnCheckURL' class="btn btn-info" style='display:none'>Test</a>
					<button type="button" id='btnDoneURL' class="btn btn-success" style='display:none'><span class='glyphicon glyphicon-check'></span> Done</button>
				</div>
			</div>
		</div>
		
		<div id='divDownloads'>
			<table id="tblInvestmenJobs" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Job Id</th>
						<th>Job Label</th>
						<th>Job Description</th>
						<th>Job Creation Date</th>
						<th>Job Type</th>
					</tr>
				</thead>
			</table>
		</div>
	</body>
</html>