<?php
include_once("config.lib.php");


	class playerDetails
	{
		private $playerName;
		private $playerType;
		private $dBPlayerName;
		public $result; 	
			function playerDetail($playerName,$playerType,$dBPlayerName)
			{
			$this->playerName=$playerName;
			$this->playerType=$playerType;
			$this->dBPlayerName=$dBPlayerName;	
			$query="SELECT * FROM `{$this->playerType}` WHERE `{$this->dBPlayerName}`='{$this->playerName}'";
			$res=mysql_query($query);
			$this->result=mysql_fetch_assoc($res);	
			}			
	}






if(isset($_POST["getMyListSixteen"]))
	{
	$getMyListSixteen=addslashes($_POST["getMyListSixteen"]);
	$getMyListSixteen=getListSixteen($getMyListSixteen);
    $divElement="";
	$value=array();
	$HTMLPAGE="";
            
	for($l1=0;$l1<count($getMyListSixteen);$l1++)
		{
		$stripeData=array();
		$stripeData=explode("(",$getMyListSixteen[$l1]);
		for($i=0;$i<count($DBASE_ARR);$i++)
		   {
		   if($DBASE_ARR[$i]["TYPE"]===substr($stripeData[1],0,-1))
			  {
				if($i!=count($DBASE_ARR)-1)
				{
			  $query="SELECT * FROM `{$DBASE_ARR[$i]['DBNAME']}` WHERE `{$DBASE_ARR[$i]['DISPLAY'][0]}`='{$stripeData[0]}'"; 
			  $res=mysql_query($query);
		      $result=mysql_fetch_assoc($res);					
				$HTMLPAGE=<<<html
            	 <tr id='{$result[$DBASE_ARR[$i]['DISPLAY'][0]]}{$DBASE_ARR[$i]['TYPE']}ClassicViewOuterDetail' onmouseover="fullStats(this)" onmouseout="fullStats1(this)" class="tableTrClassicViewOuterDetail">
html;
				for($j=0;$j<count($DBASE_ARR[$i]['DISPLAY']);$j++)
				{
                if($j<3)
				$HTMLPAGE.=<<<html
                   <td>{$result[$DBASE_ARR[$i]['DISPLAY'][$j]]}</td>
html;
				}
				$HTMLPAGE.=<<<html
					<td><img src="images/forward.png" alt="accept" id="{$result[$DBASE_ARR[$i]['DISPLAY'][0]]}({$DBASE_ARR[$i]['TYPE']})ForClassicViewList" class="moveToProbablePlayerImg" style="cursor:pointer"/></td>
					</tr>
html;
	           $divElement.=<<<html
                  <div id="{$result[$DBASE_ARR[$i]['DISPLAY'][0]]}{$DBASE_ARR[$i]['TYPE']}ClassicViewInnerDetailDiv1" class="ClassicViewInnerDetailDiv1" style="position:absolute;display:none;top:250px;left:205px;">
				  <img src="images/players/{$DBASE_ARR[$i]['DBNAME']}/{$result['pl_id']}.jpeg" style="width:100px;height:110px;" alt=""/>
html;

                for($j=0;$j<count($DBASE_ARR[$i]['DISPLAY']);$j++)
                       {
            $divElement.=<<<html
				           <br/>{$DBASE_ARR[$i]['DISPLAY'][$j]}:<div style="font-weight:800;display:inline;">  {$result[$DBASE_ARR[$i]['DISPLAY'][$j]]}</div>
 
html;
                       }
           $divElement.=<<<html
          </div>
html;


       			$value[]=$HTMLPAGE;
				$value[]=$DBASE_ARR[$i]['TYPE'];						
}
					}
					}
	    			}
    	        $value[]=$divElement;
				echo json_encode($value);
		}


	
	
if(isset($_POST["getPlayerDetailFor"]))
		{
			$dataObtained=addslashes($_POST["getPlayerDetailFor"]);
			$giveResult=explode("|",$dataObtained);
			$value=array();
			for($i=0;$i<count($giveResult);$i++)
				{
					$plType=explode("(",$giveResult[$i]);
					$plType[1]=substr($plType[1],0,-1);
					





				
			for($j=0;$j<count($DBASE_ARR);$j++)
				{

					if($DBASE_ARR[$j]["TYPE"]==$plType[1])								
						{
						$playerDetail=new playerDetails;
						$details=$playerDetail->playerDetail($plType[0],$DBASE_ARR[$j]["DBNAME"],$DBASE_ARR[$j]["DISPLAY"][0]);
						$HTMLPAGE=<<<html
                              <tr id='{$playerDetail->result[$DBASE_ARR[$j]['DISPLAY'][0]]}{$DBASE_ARR[$j]['TYPE']}ClassicViewOuterDetail' onmouseover="fullStats(this)" onmouseout="fullStats1(this)" class="tableTrClassicViewOuterDetail">
html;
						for($k=0;$k<count($DBASE_ARR[$j]['DISPLAY']);$k++)
							{
				            if($k<3)
						$HTMLPAGE.=<<<html
                             <td>{$playerDetail->result[$DBASE_ARR[$j]['DISPLAY'][$k]]}</td>
html;
							}
							$HTMLPAGE.=<<<html
										<td><img src="images/forward.png" alt="accept" id="{$plType[0]}({$plType[1]})ForClassicViewList" class="moveToProbablePlayerImg" style="cursor:pointer"/></td>
														</tr>
html;
				$value[]=$HTMLPAGE;
				$value[]=$DBASE_ARR[$j]['TYPE'];
				$value[]="";
				

			
						}

				}
					
				}			
			
				echo json_encode($value);

			
					
			

				
		}

	

	


if(isset($_POST["getImages"]))
	{
	$getMyListSixteen=addslashes($_POST["getImages"]);
$getMyListSixteen=explode(";",$getMyListSixteen);	
    $divElement="";
	$value=array();
	$HTMLPAGE="";
            
	for($l1=0;$l1<count($getMyListSixteen);$l1++)
		{
		$stripeData=array();
		$stripeData=explode("(",$getMyListSixteen[$l1]);
		for($i=0;$i<count($DBASE_ARR);$i++)
		   {
		   if($DBASE_ARR[$i]["TYPE"]===substr($stripeData[1],0,-1))
			  {
				if($i!=count($DBASE_ARR)-1)
				{
			  $query="SELECT * FROM `{$DBASE_ARR[$i]['DBNAME']}` WHERE `{$DBASE_ARR[$i]['DISPLAY'][0]}`='{$stripeData[0]}'"; 
			  $res=mysql_query($query);
		      $result=mysql_fetch_assoc($res);					
				    $divElement.=<<<html
                  <div id="{$result[$DBASE_ARR[$i]['DISPLAY'][0]]}{$DBASE_ARR[$i]['TYPE']}ClassicViewInnerDetailDiv1" class="ClassicViewInnerDetailDiv1" style="position:absolute;display:none;top:305px;left:275px;">
				  <img src="images/players/{$DBASE_ARR[$i]['DBNAME']}/{$result['pl_id']}.jpeg" style="width:100px;height:110px;" alt=""/>
html;

                for($j=0;$j<count($DBASE_ARR[$i]['DISPLAY']);$j++)
                       {
            $divElement.=<<<html
				           <br/>{$DBASE_ARR[$i]['DISPLAY'][$j]}:<div style="font-weight:800;display:inline;">  {$result[$DBASE_ARR[$i]['DISPLAY'][$j]]}</div>
 
html;
                       }
           $divElement.=<<<html
          </div>
html;


}
					}
					}
	    			}
    	        $value[]=$divElement;
				echo json_encode($value);
		}
	
	
	
?>