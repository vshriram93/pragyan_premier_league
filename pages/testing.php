<?php

{ echo"
    <div id=\"playertype\">
        <ul>
        <li>Batsman</li>
        <li>Bowler</li>
        <li>Wicket Keeper</li>
        <li>All Rounder</li>
        <li>Coach</li>
    </ul>
    </div>";
    echo "
          <div id=\"probable\">
          <ul id=\"list\">
          </ul>
          Probable Players
    </div>";
    $query =mysql_query("SELECT * FROM Sheet1",$connect);
    $player_img=array();
    $player_id=array();
    $num=0;
    while($player=mysql_fetch_array($query))
    {
        $player_img[$num]=$player['Name'].".jpg";
        $player_id[$num]=$player['Name'];
        $num++;
    }
    $playid=Null;
    echo"<div id=\"ListPlayers\">";
    for($i=0;$i<$num;$i++)
    {
    	$details=array();
   $details=explode(" ",$player_img[$i]);
  	  	$setdetail="";
  	$testing=array();
  		  	for($j=0;$j<count($details);$j++) {$setdetail.=$details[$j ];}
		$testing=explode(".",$setdetail);
		$setdetail=$testing[0]; 	  	

	echo "<img src='images/{$setdetail}' style=\"width:200px;height:150px\" class=\"magnify\" id='{$player_id[$i]}' />";
        $playid="player".$setdetail;
        $finadd="FinAdd".$setdetail;
        $probadd="ProbAdd".$setdetail;
        echo "
            <div id='{$playid}' style=\"display:block;position:fixed;top:300px;left:30px;z-index:100;\">
            <button id='{$finadd}'>Add to Cart</button><br />
            <button id='{$probadd}' onclick=\" return addprob('{$setdetail}')\">Add to Probable List</button>
            <!--Add to cart:<input type=\"radio\" name='{$finadd}' /><br />
            Add to Probable list:<input type=\"radio\" name='{$probadd}' />!-->
            </div>";


        //echo $player_id[$i];
    }
}
?>