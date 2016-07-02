$(document).ready(function(){
	$('#signUpUser').unbind('click').click(function(){
		var jqAJAX = $.post("signUpUser.php",{
			userEmailId : $('#txtEmailId').val(),
			userName :  $('#txtUserName').val(),
			userPassword : ($('#txtUserPassword').val().split('')).reverse().join(''),
			userGivenName : ($('#txtFirstName').val() + " " + $('#txtLastName').val())
		});
		jqAJAX.done(function( data ) {
			$('#divLogInSignUpUser').hide();
			$('#divNotifyUserMain').show();
			$('#divNotifyUser').text(data);
		});
		jqAJAX.fail(function(data){
			alert('failed' + data);
		});
	});
});