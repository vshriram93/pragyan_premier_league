<?php
	include_once("config.lib.php");

	if(isset($_POST["finalList"]))
	{
		$price=0;
		$finalList=addslashes($_POST["finalList"]);
		$splitPlayer=explode(";",$finalList);
		if(count($splitPlayer)!=17) 
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
							 if($value[$DBASE_ARR[$i]['TYPE']]!=$DBASE_ARR[$i]['CHOOSEN16']) 
									{
									
											$correct=0;break;
									
									}
								}		
					if($correct)
					{		
						$idValue=getId($_SESSION["teamName_PPL"]);
						$query="SELECT ppl_amount FROM {$USERDB} WHERE ppl_id={$idValue}";
						$res=mysql_query($query,$connect);
						$result=mysql_fetch_assoc($res);
						if($result['ppl_amount']>$price)									
							{
						
						$query="INSERT INTO {$USERDETAILDB} (ppl_id,ppl_teamSixteen) VALUES (".$idValue;
						$query.=",'{$finalList}')";

						$res=mysql_query($query,$connect);
						$query="UPDATE `{$USERDB}` SET `ppl_amount`=	ppl_amount-{$price} WHERE ppl_id={$idValue}";			
						$res=mysql_query($query,$connect);
						echo "1";	
							}
						else
						 {
						echo "You Dont have Sufficient fund";
						     return;	
						 
						 }				
					}
					else
						{
							echo "Your Team formation should be Batsman:6";
							echo " Bowler:6";
							echo " All Rounder:2";
							echo " Keeper:2";
							echo " Coach:1";
							    						
						}			
			}	
			}
		
?>