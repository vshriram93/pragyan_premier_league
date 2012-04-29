<?php
include_once("config.lib.php");
$result=0;
    $query="SELECT * FROM `usersPlayerDetails`";
    $res=mysql_query($query);
    while($result=mysql_fetch_array($res)){
      $sum=0;
      for($i=0;$i<9;$i++){
	$splitData=explode(";",$result["ppl_playerContribution".$i]);
	for($j=1;$j<count($splitData);$j++) $sum=bcadd($sum,$splitData[$j],6);
    }
      echo $result["ppl_id"]."  ".$sum."<br/>";
    }
?>