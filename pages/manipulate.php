<?php
include_once("config.lib.php");
$query="SELECT * FROM `usersPlayerDetails`";
$result=mysql_fetch_array($res)) {
  $k[11];
  for($i=1;$i<9;$i++) {
    if($result[]) {
      $splitData=explode(";",$result["ppl_playerContribution".$i]);
      for($j=1;$j<count($splitData);$j++) {
	$k[$j]=$splitData[$j] % 10000;
	echo $k[$j]." ";
      }
    }
    echo "\n";
  }
 }
?>  