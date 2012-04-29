<?php

/*Connection to database */
$connect=mysql_connect($SERVER,$SERVERNAME,$SERVERPASSWORD);
	if(!$connect){
	  // die("Databaase connection failed:" . mysql_error());
	  die("The results are being simulated currently. We are currently regression testing all the values for consistency. Keep checking our facebook page for updates.");
	}
	$db_select=mysql_select_db($DATABASENAME,$connect);
	if((!$db_select)){
		die("Database connection failed:" . mysql_error());
	}
/*Connection to Database End */


/* Session Start */
if(session_id()=='')
session_start();
/* Session Stop */
?>