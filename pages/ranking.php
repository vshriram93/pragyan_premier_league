	<?php
include_once("config.lib.php");
$result=0;
    $query="SELECT * FROM `usersPlayerDetails`";
    $res=mysql_query($query);
    while($result=mysql_fetch_array($res)){
      $sum=0;
      for($i=1;$i<9;$i++){
	if($result["ppl_playerContribution".$i]){
	$splitData=explode(";",$result["ppl_playerContribution".$i]);
	
	for($j=1;$j<count($splitData);$j++) {// if((int)$splitData[$j]>=5000) $splitData[$j]=4000+rand(0,1000);

$sum=$sum+$splitData[$j];}//bcadd($sum,$splitData[$j],6);echo $sum." ";}
   
	}
	// $joinArray=join(";",$splitData);
	 // echo $joinArray."<br/>";
	 // $pplCont="ppl_playerContribution".$i;
	// $query="UPDATE `{$USERDETAILDB}` SET `{$pplCont}`='{$joinArray}' WHERE `ppl_id`={$result['ppl_id']}";
	// mysql_query($query);

      }
      echo $result["ppl_id"]."  ".$sum."<br/>";
      $query="UPDATE `{$USERDETAILDB}` SET `resultFinal`={$sum} WHERE `ppl_id`={$result['ppl_id']}";
      mysql_query($query);

    }
?>
