
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-loose.dtd">
<?php
define('__PPL__','()$!%^^!%#');		

include("pages/config.lib.php");

if((isset($_POST['sellPlayer1']))&&(isset($_POST['buyPlayer1'])))
{
  $playerId=getId($_SESSION['teamName_PPL']);
  $_POST['sellPlayer1']=addslashes($_POST['sellPlayer1']);
  $sell1=$_POST['sellPlayer1'];
  $sellPlayer1="UPDATE {$USERDETAILDB} SET `sellPlayer1`='{$sell1}' WHERE `ppl_id`={$playerId}";
  echo $sellPlayer1;
  $sellPlayer1Query=mysql_query($sellPlayer1);
  $_POST['buyPlayer1']=addslashes($_POST['buyPlayer1']);
  $buy1=$_POST['buyPlayer1'];
  $buyPlayer1="UPDATE {$USERDETAILDB} SET `buyPlayer1`='{$buy1}' WHERE `ppl_id`={$playerId}";
  $buyPlayer1Query=mysql_query($buyPlayer1);
  
}
if((isset($_POST['sellPlayer2']))&&(isset($_POST['buyPlayer2'])))
{
  $playerId=getId($_SESSION['teamName_PPL']);
  $_POST['sellPlayer2']=addslashes($_POST['sellPlayer2']);
  $sell2=$_POST['sellPlayer2'];
  $sellPlayer2="UPDATE {$USERDETAILDB} SET `sellPlayer2`='{$sell2}' WHERE `ppl_id`={$playerId}";
  $sellPlayer1Query=mysql_query($sellPlayer2);
  $_POST['buyPlayer2']=addslashes($_POST['buyPlayer2']);
  $buy2=$_POST['buyPlayer2'];
  $buyPlayer2="UPDATE {$USERDETAILDB} SET `buyPlayer2`='{$buy2}' WHERE `ppl_id`={$playerId}";
  $buyPlayer2Query=mysql_query($buyPlayer2);
}
?>

<html>
	<head>
		<title><?php echo $PAGETITLE ?></title>
		<script type="text/javascript" src="scripts/jquery.js"></script>
		<script type="text/javascript" src="scripts/jqueryui.js"></script>
		<script type="text/javascript" src="scripts/main.js"></script>
		<script type="text/javascript" src="scripts/jquery.magnifier.js"></script>
		<script type="text/javascript" src="scripts/jquery.tinyscrollbar.min.js"></script>
		<script type="text/javascript">$(document).ready(function(){
		var slow="<div id=\"slowConnectionP\" style=\"display:inline;\"><div id=\"openClassicView\" style=\"display:inline;\">Switch to Lighter Version</div></div>";
            $("#choosePlayer").prepend(slow);
           	
            $("#menu_home").click(function(){
               window.location.href="index.php";
            });
            $("#instructions").click(function(){
               var popup1="<div id='popup1'>";
            });
        });</script>
        <?php
				$data=getAmt($_SESSION["teamName_PPL"]);				
        			$cash=<<<EOT
				<script type="text/javascript">$(document).ready(function(){
				        				
        				var cash="<div id=\"balanceAmount\"><img src='images/moneybag.png' alt=''/><h3>Current Balance: <div id=\"balanceAmount1\">\${$data}</div></h3></div>";
        				var playersChosen="<div id=\"playerChoosenCounter\"><h3>Players: <span id=\"incrementPlayerList\">0</span></h3></div>";
						$("#choosePlayer").prepend(playersChosen);

        				$("#choosePlayer").prepend(cash);
						        				
        });</script>
EOT;
			echo $cash;        
        ?>
		<script type="text/javascript" src="scripts/checkVideoSupport.js"></script>
		<link href="scripts/jqueryui.css" type="text/css" rel="stylesheet"/>
		<link href="scripts/main.css" type="text/css" rel="stylesheet"/><link href="scripts/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
    <?php
            echo $menuList;
    ?>
    <div id="background" style="width:100%;height:100%;">
       <img src="images/background1.jpg" alt=""/>
    </div>
	<div id="frameDiv">
        <div style="text-align: center"><img src="images/logo.png" height="200px" alt=""/></div>
        	<?php
		
		include_once("pages/includers.php");	
		if(isset($_SESSION["teamName_PPL"]))
		   {	
                   echo $showUserDetailsAtMenuList;   
		   
		   if(playerChoosen($_SESSION["teamName_PPL"])){
		      include_once("pages/choosePlayer.php");
		      echo $addPlayerToList;
		      }
		   
		   else{
		   $_SESSION["teamName_GameDay"]=getGame($_SESSION["teamName_PPL"]); 
                 
		   if(getSetNo($_SESSION["teamName_PPL"])<=(getGame($_SESSION["teamName_PPL"]))){ 
                   include_once("pages/chooseEleven.php");
		   echo $myPlayingEleven;
                   }
                   else{
		    include_once("pages/myPlaying11.php");
		   echo $myPlaying11;
             		}
		   include_once("pages/finalSelection.php");
		       }
 		   
		   }	
		   else 
 				{
					echo $addLoginFormChildToDiv;
				}
				
				
				
				
$choosenSixteen=0;
if(isset($_SESSION["teamName_PPL"])) $login=true;
else $login=false;
if($login)
{
	$query="SELECT * FROM {$USERDETAILDB} WHERE `ppl_id`=".getId($_SESSION["teamName_PPL"]);
	$res=mysql_query($query);
	$choosenSixteen=mysql_num_rows($res);
}
	if(!$choosenSixteen&&($login))
		{
         									
			   echo $addPlayerToList;
			         	
		}
$menu=<<<EOT
		<ul id="menu">
   		 <li id="menu_home">Home</li>
EOT;
	if(!$choosenSixteen&&($login))
	$menu.=<<<EOT
   	 <li id="menu_team">Select my Team</li>
EOT;
else if($login)
	 {
	$menu.=<<<EOT
   	 <li id="menuTeam">
EOT;

	$menu.=<<<EOT
	   My Team</li>
EOT;
	
	 }
	  if($login){

	  }
	$menu.=<<<EOT


   	 <li id="menuHowToPlay">How to Play</li>

   	 <li id="menu_rules"><a href="http://www.pragyan.org/12/home/events/managing_tech/pragyan_premier_league/+view&navigate=191" target="_blank" style="text-decoration:none;color:white;">Rules & Regulations</a></li>
   	 <li id="menu_contacts"><a href="http://www.pragyan.org/12/home/events/managing_tech/pragyan_premier_league/+view&navigate=177" target="_blank" style="text-decoration:none;color:white;">Contact Us</a></li>
EOT;
if($login)
  {
	$menu.=<<<EOT
    <li id="menu_result"><a href="./pages/display.php" target="_blank" style="text-decoration:none;color:white;">My Points</a></li>
EOT;

    
   }
	$menu.=<<<EOT
   
</ul>
EOT;
        echo $menu;

			?>
			<div id="mainDiv"></div>
	</div>
	<div id="completeDetailOfPlayer"></div>
	<div id="alertPlayerInfo"> </div>
	</body>
</html>
