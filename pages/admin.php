<?php
include_once("config.lib.php");
include_once("conn.php");
if(isset($_SESSION['teamName_PPL']))
{
   for($k=1;$k<9;$k++)
   {
        $gameName="Day".($k-1);
        if(isset($_POST[$gameName]))
        {
	  $_POST[$gameName]=addslashes($_POST[$gameName]);
	  $playingEleven="ppl_playingEleven".$k;
	  $trainingSet="ppl_trainingSession".$k;
	  $wkts="Wic".$k;
	  $economy="Econ".$k;
	  $playerList="SELECT * FROM {$USERDETAILDB}";
	  $query=mysql_query($playerList);
          while($res=mysql_fetch_array($query))
	  {
	    $playerMatchContribution="";
	    $elevenList=$res[$playingEleven];
	    $trainingAmount=$res[$trainingSet]/10000;
	    $elevenArray=explode(";",$elevenList);
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
		      $posList="SELECT * FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
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
			$batDetails="SELECT * FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
			$batQuery=mysql_query($batDetails);
			$result=mysql_fetch_assoc($batQuery);
      		        $batContribution=($playerPositionContribution*$result[$strike]/10)*$result['formFactor'];
			$batContribution=$batContribution+($batContribution*$trainingAmount);
			$playerMatchContribution=$playerMatchContribution.";".$batContribution;
		      }
		      else if($j==2)
		      {
			 $allRoundDetails="SELECT * FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
			 $allRoundQuery=mysql_query($allRoundDetails);
			 $result=mysql_fetch_assoc($allRoundQuery);
            		 $batContribution=($playerPositionContribution*$result[$strike]/10)*$result['formFactor'];
			 if($result[$wkts]!=0)
			   $bowlContribution=((11-$result[$economy])*10+5*(100-24/$result[$wkts]))*(($result[$wkts]+(10-$result[$economy]))/2);
			 else
			   $bowlContribution=((11-$result[$economy])*10+5*(100-$result['bowlingAverage']))*(($result[$wkts]+(10-$result[$economy]))/2);
		         $allRoundContribution=($batContribution+$bowlContribution)/2;
			 $allRoundContribution=$allRoundContriburion+($allRoundContribution*$trainingAmount);
			 $playerMatchContribution=$playerMatchContribution.";".$allRoundContribution;
		      }
		      else if($j==3)
		      {
			 $keepDetails="SELECT *  FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
			 $keepQuery=mysql_query($keepDetails);
			 $result=mysql_fetch_assoc($keepQuery);
			 $keepContribution=($playerPositionContribution*$result[$strike]/10)*$result['formFactor']+5*$result[$dismissals];
			 $keepContribution=$keepContribution+($keepContribution*$trainingAmount);
			 $playerMatchContribution=$playerMatchContribution.";".$keepContribution;
						 
		     }
		   }

                  }
                  else if($DBASE_ARR[$j]["COACH"]==0)
		  {
		    if($DBASE_ARR[$j]["TYPE"]==$splitArray[1])
		    {
		      $bowlDetails="SELECT *  FROM {$DBASE_ARR[$j]['DBNAME']} WHERE name='{$splitArray[0]}'";
		      $bowlQuery=mysql_query($bowlDetails);
	       	      $result=mysql_fetch_assoc($bowlQuery);
		      if($result[$wkts]!=0)
			$bowlContribution=((11-$result[$economy])*10+5*(100-24/$result[$wkts]))*(($result[$wkts]+(10-$result[$economy]))/2);
		      else
			$bowlContribution=((11-$result[$economy])*10+5*(100-$result['average']))*(($result[$wkts]+(10-$result[$economy]))/2);
		      $bowlContribution=$bowlContribution+($bowlContribution*$trainingAmount);
		      $playerMatchContribution=$playerMatchContribution.";".$bowlContribution;
		    }
		  }
		}
	      }
	      
	      $contributionField="ppl_playerContribution".$k;
	      $insertContribution="UPDATE {$USERDETAILDB} SET {$contributionField}='{$playerMatchContribution}' , `ppl_day`=$k , `ppl_set`=$k WHERE `ppl_id`=".$res["ppl_id"];
	      $insertQuery=mysql_query($insertContribution);
	       if($insertQuery) 	  
	      	echo "Database updated";
	     }	
	 }
       }
   }
}
if(($_SESSION['teamName_PPL'])==$ADMIN)
    {
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day0' name='Day0' /></form>";
            echo"<form action='admin.php' method='POST'>";

            echo"<input type='submit' value='Day1' name='Day1'/></form>";

            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day2' name='Day2'/></form>";
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day3' name='Day3'/></form>";
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day4' name='Day4' /></form>";
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day5' name='Day5'/></form>";
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day6' name='Day6'/></form>";
            echo"<form action='admin.php' method='POST'>";
            echo"<input type='submit' value='Day7' name='Day7'/>";
            echo "</form>";
	   
    }
  

?>