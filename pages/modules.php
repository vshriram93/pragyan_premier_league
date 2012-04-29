<?php
include_once("config.lib.php");
/*-----------------------------------------------------------*/
/*        Collection of module structure                     */ 
/*-----------------------------------------------------------*/



/*MenuList*/
$menuList =<<<AB
   <div id="menuListDiv">
	</div>
AB;
/*MenuList*/

/*Login Form Starts */
$loginForm=<<<AB
			<!-- login form -->
			<div id="loginFormDiv">
			<form method="POST" action="./" onsubmit="return loginFormValidation()" id="loginForm">
			<table border="1">
				<tr>
					<td>E-Mail:</td>
					<td><input type="text" value="" id="loginTeamName" name="loginTeamName" /></td>				
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" value="" id="loginTeamPassword" name="loginTeamPassword"></td>
				</tr>
				<tr><td colspan="2"><input type="submit" name="loginFormButton" value="Submit"></td></tr>
				</table>
				</form>
				</div>
	<!-- end of login form -->
AB;
/*Login Form End */






/*Show Forms when User Has Not logged in */
$addLoginFormChildToDiv=$loginForm; 		
$addLoginFormChildToDiv.=<<<AB
			<ul type="none" id="menuListUserLoginDetailUl" >
			<li id="showLoginFormLi"><div id="displayLoginNameDiv" class="changeThePointer">login</div></li>
			<li id="showRegistrationFormLi" class="changeThePointer">register</li>		
			</ul>	
		<script type="text/javascript">
				$(document).ready(function() 
		{		
			var dispheight=document.getElementById("displayLoginNameDiv").style.width;
					$("#displayLoginNameDiv").css({'width':dispheight+45+'px'})
					$("#displayLoginNameDiv").css({'text-align':'center'});
					
					$("#menuListDiv").append($("#menuListUserLoginDetailUl"));
					$("ul#menuListUserLoginDetailUl #showLoginFormLi").append($("#loginFormDiv"));
					$("div#mainDiv").append($("#registrationFormDiv"));
					$("#showRegistrationFormLi").click(function()
					{
					  window.location.href="http://www.pragyan.org/12/home/events/managing_tech/pragyan_premier_league/";
					});		
	});		
		</script>	
AB;
/*login Form Display ends Here*/

/* welcome screen after login */	
	$showUserDetailsAtMenuList=<<<AB
			<div id="menuListTeamNameDiv">	
AB;
		if(isset($_SESSION["teamName_PPL"]))
			{
				$showUserDetailsAtMenuList.=<<<AB
						Welcome {$_SESSION["teamName_PPL"]}
						<ul type="none" id="menuListTeamNameSubUl">				
					<!--	<li id="showSettingsLi" class="changeThePointer">Settings</li>	-->		
						<li id="showLogoutLi" class="changeThePointer" name="logout">logout</li>		
						</ul>			

AB;
			}
	$showUserDetailsAtMenuList.=<<<AB
			
			</div>							
			<script type="text/javascript">
				$(document).ready(function() 
	{		
				$("#menuListTeamNameSubUl").css({'visibility':'hidden'});
				$("#menuListDiv").append($("#menuListTeamNameDiv"));
	});		
		</script>	
AB;
		
/*welcome screen after login */
/**/
?>