<?php
include_once("config.lib.php");
include_once("conn.php");
if(isset($_SESSION['teamName_PPL']))
{
	    $displayResult=<<<AB
	    	<body style="margin-right:0px;background:url(../images/background1.jpg) no-repeat;width:100%;min-height:800px;min-width:1280px;">
			<div style="padding-left:75px;margin-left:55px;margin-bottom:10px;padding:20px;">
AB;
    $playerMatchContribution="";
    $query="SELECT `ppl_day` FROM usersPlayerDetails";
    $res=mysql_fetch_assoc(mysql_query($query));
    
    for($k=1;$k<=8;$k++)
    {

        $gameName="Day".($k-1);
        if(isset($_POST[$gameName]))
        {
	  //	  $_POST[$gameName]=addslashes($_POST[$gameName]);
	    $playingEleven="ppl_playingEleven".$k;
	    $trainingSet="ppl_trainingSession".$k;
	    $playerList="SELECT * FROM {$USERDETAILDB} WHERE `ppl_id`=".getId($_SESSION["teamName_PPL"]);
            $query=mysql_query($playerList);
            $res=mysql_fetch_assoc($query);
	    $elevenList=$res[$playingEleven];
	    
	    $elevenArray=explode(";",$elevenList);
	    $displayResult.=<<<AB
	        <div id="menu_result" class="menuListUl" style="padding-left:75px;margin-left:55px;margin-bottom:10px;padding:20px;">
   
	      <table border="1">

	          <tr>
	             <th>Player</th>
	             <th>Points Contributed</th>
	      </tr>
AB;
	    if(isDistinct($elevenArray))
            {
                for($i=0;$i<count($elevenArray);$i++)
                {
		            $splitArray=explode("(",$elevenArray[$i]);
		            $splitArray[1]=substr($splitArray[1],0,-1);
		            for($j=0;$j<count($DBASE_ARR);$j++)
                    {
                        if($DBASE_ARR[$j]["POSITION"]==1)
                        {
                            if($DBASE_ARR[$j]["TYPE"]==$splitArray[1])
			                                  {
			                    $runs="R".$k;
					    $strike="SR".$k;
			                    $wkts="Wic".$k;
			                    $economy="Econ".$k;
					    $dismissals="NOD".$k;
			                    $posList="SELECT position,{$runs} FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
			                    $posQuery=mysql_query($posList);
                                $result=mysql_fetch_assoc($posQuery);
                                if($i+1==$result['position'])
				                    $playerPositionContribution=(int)($result[$runs]+$result[$runs]*0.1);
                                else if(($i+1==$result['position']+1)||($i+1==$result['position']-1))
				                    $playerPositionContribution=(int)($result[$runs]+$result[$runs]*0.05);
			                    else
       				                $playerPositionContribution=(int)($result[$runs]-$result[$runs]*0.1);
			                    if($j==0)
			                    {
			       	                $batDetails="SELECT {$strike}, formFactor FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
						//  	echo $trainContribution;
						$batQuery=mysql_query($batDetails);
				                    $result=mysql_fetch_assoc($batQuery);
      				                $batContribution=($playerPositionContribution*$result[$strike]/100)*$result['formFactor'];
						$playerMatchContribution=$playerMatchContribution.";".$batContribution;




	    $displayResult.=<<<AB
	          <tr>
	      <td>{$splitArray[0]}</td>
		   <td>{$batContribution}</td>
	      </tr>
AB;
	   
						//echo $batContribution."<br />";
					            }
					            else if($j==2)
					            {
					                $allRoundDetails="SELECT {$wkts}, {$economy}, bowlingAverage, {$strike}, formFactor FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
					                $allRoundQuery=mysql_query($allRoundDetails);
					                $result=mysql_fetch_assoc($allRoundQuery);
            					    $batContribution=($playerPositionContribution*$result[$strike]/100)*$result['formFactor'];
					                if($result[$wkts]!=0)
					                    $bowlContribution=((11-$result[$economy])*10+5*(100-24/$result[$wkts]))*(($result[$wkts]+(10-$result[$economy]))/2);
					                else
					                    $bowlContribution=((11-$result[$economy])*10+5*(100-$result['bowlingAverage']))*(($result[$wkts]+(10-$result[$economy]))/2);
					                $allRoundContribution=($batContribution+$bowlContribution)/2;
							$playerMatchContribution=$playerMatchContribution.";".$allRoundContribution;

							//echo $allRoundContribution."<br />";
	    $displayResult.=<<<AB
	          <tr>
	      <td>{$splitArray[0]}</td>
		   <td>{$allRoundContribution}</td>
	      </tr>
AB;




					            }
				    	        else if($j==3)
					            {
					                $keepDetails="SELECT {$strike}, {$dismissals}, formFactor  FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
					                $keepQuery=mysql_query($keepDetails);
					                $result=mysql_fetch_assoc($keepQuery);
					                $keepContribution=($playerPositionContribution*$result[$strike]/100)*$result['formFactor']+5*$result[$dismissals];
							$playerMatchContribution=$playerMatchContribution.";".$keepContribution;

	    $displayResult.=<<<AB
	          <tr>
	      <td>{$splitArray[0]}</td>
		   <td>{$keepContribution}</td>
	      </tr>
AB;
					            }
			                }

                        }
                        else if($DBASE_ARR[$j]["COACH"]==0)
			            {
					        if($DBASE_ARR[$j]["TYPE"]==$splitArray[1])
			                {
					               
					                $bowlDetails="SELECT {$wkts}, {$economy}, average  FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
						           
						            $bowlQuery=mysql_query($bowlDetails);
			                        $result=mysql_fetch_assoc($bowlQuery);
			                        if($result[$wkts]!=0)
			                            $bowlContribution=((11-$result[$economy])*10+5*(100-24/$result[$wkts]))*(($result[$wkts]+(10-$result[$economy]))/2);
						            else
			                            $bowlContribution=((11-$result[$economy])*10+5*(100-$result['average']))*(($result[$wkts]+(10-$result[$economy]))/2);
						$playerMatchContribution=$playerMatchContribution.";".$bowlContribution;

	    $displayResult.=<<<AB
	          <tr>
	      <td>{$splitArray[0]}</td>
		   <td>{$bowlContribution}</td>
	      </tr>
		 
					      
AB;

						           // echo $bowlContribution."<br />";
                            }

			            }
		                else if($DBASE_ARR[$j]["COACH"]==1)
			            {
				            
				             if($DBASE_ARR[$j]["TYPE"]==$splitArray[1])
			                 {
			                    $coachDetails="SELECT formFactor FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
			                    $coachQuery=mysql_query($coachDetails);
			                    $result=mysql_fetch_assoc($coachQuery);
			                    $coachContribution=$result['formFactor'];
					    $playerMatchContribution=$playerMatchContribution.";".$coachContribution;
					    //			    echo $playerMatchContribution;
					    //echo $coachContribution;
			                 }
                        }
		            }
                }
	    }
	}
	       
    }
    if(isset($_SESSION['teamName_PPL']))
    {
            echo"<form action='display.php' method='POST' style='padding-left:175px;margin-left:55px;margin-bottom:10px;padding:20px;'>";
            echo"<input type='submit' value='Day0' name='Day0' />";
            echo"<input type='submit' value='Day1' name='Day1'/>";
            echo"<input type='submit' value='Day2' name='Day2'/>";
            echo"<input type='submit' value='Day3' name='Day3'/>";
            echo"<input type='submit' value='Day4' name='Day4' />";
            echo"<input type='submit' value='Day5' name='Day5'/>";
            echo"<input type='submit' value='Day6' name='Day6'/>";
            echo"<input type='submit' value='Day7' name='Day7'/>";
            echo "</form>";
	   
    }
    
}
$displayResult.="</table></div></body>";
echo $displayResult;

?>