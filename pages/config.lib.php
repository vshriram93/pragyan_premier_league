<?php
/* For connection with database */
$SERVER="localhost";
$SERVERNAME="";
$SERVERPASSWORD="";
//ppl database
$DATABASENAME="";
//pragyan cms database.User can play only if he is registeres to pragyan cms
//Change the login.php to run this app without pragyan cms
$DATABASENAME1="";
include_once("conn.php");
/* End of Database connection */

/*title*/
$PAGETITLE="PPL";
/*title*/
/*Add Name of the player database*/

$DBASE_ARR = array(0 => array("TYPE"=>"Batsman","PLAYER"=>1,"COACH"=>0,"POSITION"=>1,"DBNAME"=>"batsmen","CHOOSEN16"=>6,"CHOOSEN11"=>5,"DISPLAY"=>array("name","price","team","battingAverage","strikeRate","Runs Scored in Previous Innings","i1","i2","i3","i4","i5","lastFiveInningsStrikeRate")));



$DBASE_ARR[] = array("TYPE"=>"Bowler","PLAYER"=>1,"COACH"=>0,"POSITION"=>0,"DBNAME"=>"bowlers","CHOOSEN16"=>6,"CHOOSEN11"=>4,"DISPLAY"=>array("name","price","team","wicketsTaken","average","economyRate","Last 5 Innings Wickets","w1","w2","w3","w4","w5","Last 5 Econ_rate"));



$DBASE_ARR[] = array("TYPE"=>"AllRounder","PLAYER"=>1,"COACH"=>0,"POSITION"=>1,"CHOOSEN16"=>2,"CHOOSEN11"=>1,"DBNAME"=>"allRounders","DISPLAY"=>array("name","price","team","price","runs","battingAverage","Last Five Innings","i1","i2","i3","i4","i5","lastFiveInningsStrikeRate","ballsBowled","wicketsTaken","bowlingAverage","Last 5 Innings Wickets","w1","w2","w3","w4","w5","lastFiveInningsEconomyRate"));



$DBASE_ARR[] = array("TYPE"=>"Keeper","PLAYER"=>1,"COACH"=>0,"POSITION"=>1,"CHOOSEN16"=>2,"CHOOSEN11"=>1,"DBNAME"=>"keepers","DISPLAY"=>array("name","price","runs","battingAverage","strikeRate","dismissals","Last Five Innings","i1","i2","i3","i4","i5","lastFiveInningsStrikeRate","lastFiveInningsDismisssals"));



$DBASE_ARR[] = array("TYPE"=>"Coach","PLAYER"=>0,"COACH"=>1,"POSITION"=>0,"CHOOSEN16"=>1,"CHOOSEN11"=>0,"DBNAME"=>"coaches","DISPLAY"=>array("name","price"));

$USERDB="userDetails";
$USERDETAILDB="usersPlayerDetails";
$ADMIN="admin@localhost.com";
$adminPassword="q";
/*End of player database*/
function getId($data)
{
		global $USERDB;
		$data=addslashes($data);
		$query="SELECT ppl_id FROM `{$USERDB}` WHERE `ppl_teamName`='{$data}'";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		return $result["ppl_id"];

}



function getAmt($data)
{
		global $USERDB;
		$data=addslashes($data);

		$query="SELECT `ppl_amount` FROM {$USERDB} WHERE `ppl_teamName`='{$data}'";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		return $result["ppl_amount"];

}

function getPlayerAmt($data)
	{
			global $USERDB;
		$data=addslashes($data);

			$explodeData=explode("(",$data);


			$explodeData[1]=substr($explodeData[1],0,-1);			
			for($j=0;$j<count($DBASE_ARR);$j++)
					{
					if($DBASE_ARR[$j]["TYPE"]==$explodeData[1])
						{
						$query="SELECT {$DBASE_ARR[$j]['DISPLAY'][1]} FROM {$DBASE_ARR[$j]['DBNAME']} WHERE {$DBASE_ARR[$j]['DISPLAY'][0]}='{$explodeData[0]}'";
						$res=mysql_fetch_assoc(mysql_query($query));
						return $res[$DBASE_ARR[$j]['DISPLAY'][1]];		
						}
					}
		}	

function getListSixteen($teamName)
	{
		global $USERDETAILDB;
		$data=addslashes($teamName);

		$data=getId($teamName);
		$query="SELECT `ppl_teamSixteen` FROM `{$USERDETAILDB}` WHERE `ppl_id`={$data}";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		$splitData=array();
		$split=explode(";",$result["ppl_teamSixteen"]);
		return $split;
	}

	
	function getListEleven($teamName)
	{
		global $USERDETAILDB;
		$data=addslashes($teamName);
	
	$data=getId($teamName);
			
		$query="SELECT * FROM `{$USERDETAILDB}` WHERE `ppl_id`={$data}";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
//		$splitData=array();
	//	$split=explode(";",$result["ppl_playingEleven".($result["ppl_set"])]);
		return $result["ppl_playingEleven".($result["ppl_set"])];
	}
	
	
function isDistinct($teamSend)
{
	$distinctKey=array();
		$data=addslashes($teamSend);

	for($i=0;$i<count($distinctKey);$i++){	
	  if(isset($distinctkey[$teamSend[$i]])) return 0;
	   $distinctkey[$teamSend[$i]]=1;
	}			
return 1;
}	
function playerChoosen($teamName)
{
		global $USERDETAILDB;
		$data=addslashes($teamName);

		$data=getId($teamName);
		$query="SELECT `ppl_teamSixteen` FROM `{$USERDETAILDB}` WHERE `ppl_id`={$data}";
		$res=mysql_query($query);
		if(mysql_num_rows($res)) return 0;
		return 1;

}
function getGame($teamName)
{
		global $USERDETAILDB;
		$data=addslashes($teamName);

		$data=getId($teamName);
		$query="SELECT `ppl_day` FROM `{$USERDETAILDB}` WHERE `ppl_id`={$data}";
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		return $result['ppl_day'];

}	
function getSetNo($teamName)
{
		global $USERDETAILDB;
		$data=getId($teamName);
		$query="SELECT * FROM ".$USERDETAILDB." WHERE `ppl_id`=".$data;
		$res=mysql_query($query);
		$result=mysql_fetch_assoc($res);
		return $result['ppl_set'];
}	
include_once("modules.php");

?>
