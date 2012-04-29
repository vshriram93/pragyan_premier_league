<?php
include_once("config.lib.php");


	if(isset($_POST["MyPlayingEleven"]))
	{
		$price=0;
		$finalList=addslashes($_POST["MyPlayingEleven"]);
		$splitPlayer=explode(";",$finalList);
		if(count($splitPlayer)!=11) 
			{
				echo "No. of Players Do not match.";
				return;
			}
		else 
			{
				$value=array();
				for($i=0;$i<count($splitPlayer);$i++)
					{
						
						if(isset($checkPlayerAdded[$splitPlayer[$i]])) {echo "Two players are same";return;break;}
						else
						{
					$checkPlayerAdded[$splitPlayer[$i]]=1;
						$detail=explode("(",$splitPlayer[$i]);
						$detail[1]=substr($detail[1],0,-1);
						
						for($j=0;$j<count($DBASE_ARR);$j++)
						{
							if($DBASE_ARR[$j]["TYPE"]==$detail[1])
							{
								$query="SELECT {$DBASE_ARR[$j]['DISPLAY'][1]} FROM {$DBASE_ARR[$j]['DBNAME']} WHERE {$DBASE_ARR[$j]['DISPLAY'][0]}='{$detail[0]}'";
								$res=mysql_fetch_assoc(mysql_query($query));
								$price+=$res[$DBASE_ARR[$j]['DISPLAY'][1]];
								if(!(isset($value[$detail[1]]))) 
									{
										
										$value[$detail[1]]=0;
									}
										$value[$DBASE_ARR[$j]["TYPE"]]++;					
							}									
								
						}
						}
				}
					$correct=1;
							for($i=0;$i<count($DBASE_ARR);$i++)
								{
							 if($value[$DBASE_ARR[$i]['TYPE']]!=$DBASE_ARR[$i]['CHOOSEN11']) 
									{
									
											$correct=0;break;
									
									}
								}		
					if($correct)
					{		
						$idValue=getId($_SESSION["teamName_PPL"]);
						$updatePlayer="ppl_playingEleven".($_SESSION["teamName_GameDay"]+1);
						$query="UPDATE {$USERDETAILDB} SET `{$updatePlayer}`='{$finalList}',`ppl_set`=`ppl_day`+1 WHERE `ppl_id`=".$idValue."";
						$res=mysql_query($query,$connect);
					echo "1";			
					}
					else
						{
							echo "Your Team formation should be Batsman:5";
							echo " Bowler:4";
							echo " All Rounder:1";
							echo " Keeper:1";
							    						
						}			
			}	
			}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
			if(isset($_POST["MyPlayingEleven1"]))
	{
		$price=0;
		$finalList=addslashes($_POST["MyPlayingEleven1"]);
		$splitPlayer=explode(";",$finalList);
		if(count($splitPlayer)!=11) 
			{
				echo "No. of Players Do not match.";
				return;
			}
		else 
			{
				$value=array();
				for($i=0;$i<count($splitPlayer);$i++)
					{
						
						if(isset($checkPlayerAdded[$splitPlayer[$i]])) {echo "Two players are same";return;break;}
						else
						{
					$checkPlayerAdded[$splitPlayer[$i]]=1;
						$detail=explode("(",$splitPlayer[$i]);
						$detail[1]=substr($detail[1],0,-1);
						
						for($j=0;$j<count($DBASE_ARR);$j++)
						{
							if($DBASE_ARR[$j]["TYPE"]==$detail[1])
							{
								$query="SELECT {$DBASE_ARR[$j]['DISPLAY'][1]} FROM {$DBASE_ARR[$j]['DBNAME']} WHERE {$DBASE_ARR[$j]['DISPLAY'][0]}='{$detail[0]}'";
								$res=mysql_fetch_assoc(mysql_query($query));
								$price+=$res[$DBASE_ARR[$j]['DISPLAY'][1]];
								if(!(isset($value[$detail[1]]))) 
									{
										
										$value[$detail[1]]=0;
									}
										$value[$DBASE_ARR[$j]["TYPE"]]++;					
							}									
								
						}
						}
				}
					$correct=1;
							for($i=0;$i<count($DBASE_ARR);$i++)
								{
							 if($value[$DBASE_ARR[$i]['TYPE']]!=$DBASE_ARR[$i]['CHOOSEN11']) 
									{
									
											$correct=0;break;
									
									}
								}		
					if($correct)
					{		
						$idValue=getId($_SESSION["teamName_PPL"]);
						$updatePlayer="ppl_playingEleven".($_SESSION["teamName_GameDay"]+1);
				
						$query="UPDATE {$USERDETAILDB} SET `{$updatePlayer}`='{$finalList}' WHERE `ppl_id`=".$idValue;
						$res=mysql_query($query,$connect);
						echo "1";			
					}
					else
						{
							echo "Your Team formation should be Batsman:5";
							echo " Bowler:4";
							echo " All Rounder:1";
							echo " Keeper:1";
							    						
						}			
			}	
			}
		
		
if(isset($_POST["amountToSpend"])&&$_SESSION["teamName_PPL"])
  {
	$amt=addslashes($_POST["amountToSpend"]);
  	$query="SELECT `ppl_amount` FROM `userDetails` WHERE `ppl_teamName`='".$_SESSION["teamName_PPL"]."'";
	$res=mysql_fetch_assoc(mysql_query($query));
	if($res['ppl_amount']<$amt) echo "Insufficient fund";
	else{
	$resAmt=$res['ppl_amount']-$amt;
	$query="UPDATE {$USERDB} SET `ppl_amount`={$resAmt} WHERE `ppl_teamName`='".$_SESSION["teamName_PPL"]."'";
	$res=mysql_query($query);
	$query="SELECT `ppl_amount` FROM `userDetails` WHERE `ppl_teamName`='".$_SESSION["teamName_PPL"]."'";	
	$res=mysql_fetch_assoc(mysql_query($query));
        }
	$query="SELECT * FROM `usersPlayerDetails` WHERE `ppl_id`='".getId($_SESSION["teamName_PPL"])."'";
	$res=mysql_fetch_assoc(mysql_query($query));
	$day=$res["ppl_set"];
	if($res["ppl_trainingSession".$day]==0){
	$query="UPDATE {$USERDETAILDB} SET `ppl_trainingSession{$day}`={$amt} WHERE `ppl_id`='".getId($_SESSION["teamName_PPL"])."'";
	$res=mysql_query($query);
	}
}
if(isset($_POST["confirmThis"])){
	 if(isset($_SESSION["teamName_PPL"])){
		$idValue=getId($_SESSION["teamName_PPL"]);
		$query="UPDATE `usersPlayerDetails` SET `ppl_day`=`ppl_set` WHERE `ppl_id`=".$idValue."";
		$res=mysql_query($query);
		}

	}
?>