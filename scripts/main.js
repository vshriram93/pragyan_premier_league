
function alert1(msg)
{
					$("#frameDiv").css({'display':'none'});
					$("#mainDiv").css({'display':'none'});
					$("#completeDetailOfPlayer").css({'display':'none'});
					$("#alertPlayerInfo").css({'display':'block'});
					var divOp='<div id="alertDiv">';
					var buttonSubmit='<input type="button" value="OK" id="alertSubmitButton"/>';
					$("#alertPlayerInfo").append(divOp);
					document.getElementById("alertDiv").innerHTML=msg+"<br/>"+buttonSubmit;
					$("#alertSubmitButton").click(function()
					{
						$("#alertDiv").remove();
						$("#frameDiv").css({'display':''});
						$("#mainDiv").css({'display':''});
						$("#completeDetailOfPlayer").css({'display':'none'});
						$("#alertPlayerInfo").css({'display':'none'});
					});
}
/*Login Form Validation */
function loginFormValidation()
	{
		var loginTeamName=$("#loginTeamName").val();
		var loginTeamPassword=$("#loginTeamPassword").val();
		if(loginTeamName==""||loginTeamPassword=="") 
			{
				alert("Enter a UserName or Password");
				return false;
			}
		var datatosend="loginteamname="+loginTeamName;
			 datatosend+="&loginteampassword="+loginTeamPassword;		
		var loginRequest= $.ajax({
			url: "pages/login.php",
			type: "POST",
						
			data: datatosend,
			datatype: "html"
			});
		loginRequest.done(function(msg) {
		        if(msg!=""){
		        		alert1(msg);
			

		}
			else {
			    window.location.href=window.location.href;
			
			}
			});
		loginRequest.fail(function(jqXHR,textStatus) {
			alert("Connection Failed");
			});
			return false;
	}
/*Login Form Validation Ends*/



/*Registration Form validation*/
	function registerFormValidation()
		{
	
		var registerTeamName=$("#registerTeamName").val();
		var registerTeamPassword=$("#registerTeamPassword").val();
		var registerTeamPasswordCheck=$("#registerTeamPasswordCheck").val();
		var registerPlayerName1=$("#registerPlayerName1").val();
		var registerPlayerName2=$("#registerPlayerName2").val();
		var datatosend="registerteamname="+registerTeamName;
			 datatosend+="&registerteampassword="+registerTeamPassword;
			 datatosend+="&registerplayername1="+registerPlayerName1;
			 datatosend+="&registerplayername2="+registerPlayerName2;
		if(registerTeamName==""||registerTeamPassword==""||registerPlayerName1==""||registerPlayerName2=="") 
			{
				alert("Fill all the details");
				return false;
			}
		if(registerTeamPassword!=registerTeamPasswordCheck) 
			{
				alert("Password Does not Match");
				return false;			
			}
			var registerRequest= $.ajax({
			url: "pages/login.php",
			type: "POST",
			data: datatosend,
			datatype: "html"
			});
		registerRequest.done(function(msg) {
			alert(msg);
			});
		registerRequest.fail(function(jqXHR,textStatus) {
			alert("Connection Failed");
			});
			return false;
		}
	/*Registration Form validation ends*/
	
	
	$(document).ready(function() 
    {

	/*logout */
		$("#showLogoutLi").click(function()
		{
			var logoutRequest= $.ajax({
			url: "pages/login.php",
			type: "POST",
			data: "logout=logout",
			datatype: "html"
			});
			logoutRequest.done(function(msg) {
			data1=msg.split(";");
			sessionStorage.removeItem('Batsman');
			sessionStorage.removeItem('Bowler');
			sessionStorage.removeItem('AllRounder');
			sessionStorage.removeItem('Keeper');
			sessionStorage.removeItem('Coach');
		
			window.location.href=window.location.href;
		
			});
		logoutRequest.fail(function(jqXHR,textStatus) {
			alert("Connection Failed");
			});

			});
	/*logout ends here */
		/*show Login form */
		$('ul#menuListUserLoginDetailUl #showLoginFormLi').hover(
		function() 
			{
			document.getElementById(this.id).style.height="50px";
				$("#loginFormDiv").css({'display':'block'});
			 

			},
		function() 
			{
			document.getElementById(this.id).style.height="";
			$("#loginFormDiv").css({'display':'none'});		
			}
					
		);
		/*end of Show Login Form */
	
	
	
		/*Show Registration Form */
		$('.changeThePointer').hover(function()
			{ 
				$(this).css({'cursor':'pointer'});
				},
				function()
				{		
			
			});
		$('ul#menuListUserLoginDetailUl #showRegistrationFormLi').click(function() 
			{
				$("#registrationFormDiv").css({'display':'block'});		
			});
		/*End of Registration Form */		
	




	/*FOr choosePlayer ends*/







		/*show setting/Logout */
				$('#menuListTeamNameDiv').hover(
		function() 
			{
				$("#menuListTeamNameSubUl").css({'visibility':'visible'});
				$('#menuListTeamNameDiv').css({'height':'50px'});

			},
		function() 
			{
				$("#menuListTeamNameSubUl").css({'visibility':'hidden'});		
								$('#menuListTeamNameDiv').css({'height':'auto'});

			}
					
		);
		/*end of Show Login Form */
		
	
	
	
	
	
	});