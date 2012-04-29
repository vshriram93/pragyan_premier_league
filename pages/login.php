<?php 
/* contains login and registration procedure procedure */
include_once("config.lib.php");


/*Registration Form */
if(isset($_POST["registerteamname"]))
{
	$teamName=$_POST["registerteamname"];
	$playerName1=$_POST["registerplayername1"];
	$playerName2=$_POST["registerplayername2"];
	$teampassword=md5($_POST["registerteampassword"]);	
	/*checks if a team with a same name exist */
	$checkteamname="SELECT * FROM userDetails WHERE ppl_teamName='{$teamName}'";
	$checkteamname=mysql_query($checkteamname);
	$checkteamname=mysql_num_rows($checkteamname);	
	if($checkteamname) {$teamName="";echo "Team Name already Exist ";}
	else 
	{	
	
	$submit="INSERT INTO userDetails (ppl_teamName,ppl_password,ppl_player1,ppl_player2) VALUES ";
	$submit.="('{$teamName}','{$teampassword}','{$playerName1}','{$playerName2}')";
	mysql_query($submit);
	echo "Registration Successful";
	
	}
}
/*closing Registration Form*/



/*login Form*/
if(isset($_POST["loginteamname"]))
{
		
		$teamName=addslashes($_POST["loginteamname"]);
		$teamPassword=md5($_POST["loginteampassword"]);	
		$teamlogin="SELECT * FROM userDetails WHERE ppl_teamName='{$teamName}' AND ppl_password= '{$teamPassword}'";
			
		$teamlogin=mysql_query($teamlogin);
		if(mysql_num_rows($teamlogin)) 
			{
				$teamlogin=mysql_fetch_assoc($teamlogin);
				$_SESSION["teamName_PPL"]=$teamlogin['ppl_teamName'];
				$_SESSION["balanceAmount_PPL"]=$teamlogin['ppl_amount'];
				$_SESSION["teamExp_PPL"]=$teamlogin['ppl_experiencePoint'];

			}
		else 
		{
			mysql_select_db($DATABASENAME1);
			$query="SELECT * FROM `pragyanV3_users` WHERE `user_email`='{$teamName}' AND `user_password`='{$teamPassword}'";
			
			$userResult=mysql_query($query);
			if(!(mysql_num_rows($userResult)))
			     {
					$query="SELECT * FROM `pragyanV3_users` WHERE `user_email`='{$teamName}'";
					$userResult1=mysql_query($query);

			if(!(mysql_num_rows($userResult1)))
			     {
				
				echo "Please Register to <a href=\"http://www.pragyan.org/12/home/+login&subaction=register\">Pragyan</a>";
				}
			else
				{
					echo "Incorrect Username or Password";	
				}	
			     } 
			else 	
			{
			    	$result=mysql_fetch_assoc($userResult);
				$userID=$result["user_id"];
				$query="SELECT * FROM `form_elementdata` WHERE `user_id`='{$userID}' AND `page_modulecomponentid`=24";
				$result=mysql_query($query);

				if(mysql_num_rows($result))	
				 {
					mysql_select_db($DATABASENAME);	  
					$submit="INSERT INTO `{$USERDB}` (ppl_teamName,ppl_password,ppl_amount) VALUES ";
					$submit.="('{$teamName}','{$teamPassword}',7000000)";
					mysql_query($submit);
					echo "Registration Successful";
					$_SESSION["teamName_PPL"]=$teamName;
					$_SESSION["balanceAmount_PPL"]=7000000;
					$_SESSION["teamExp_PPL"]=0;
					echo "1";

				 } 	
				 else{
					echo "<a href=\"http://www.pragyan.org/12/home/events/managing_tech/pragyan_premier_league/\">Click here<a> to register for ppl";
			     }
				
			}
		}		
}
/*login form ends*/
/*destroy session*/
if(isset($_POST["logout"]))
{
	$unsetValue="";
	for($i=0;$i<count($DBASE_ARR);$i++)
		{
				$unsetValue.=<<<AB
						{$DBASE_ARR[$i]['TYPE']};
AB;
		}		
		
		echo $unsetValue;		
		
		
	session_destroy();
}
/*session destroy end here*/
?>