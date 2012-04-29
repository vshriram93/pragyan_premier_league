<?php
$myPlayingEleven = "";
if(isset($_SESSION["teamName_PPL"])){
if(getSetNo($_SESSION["teamName_PPL"])<8){
$myPlayingEleven .= <<<SCRIPT
	<script type="text/javascript">
		function getMyPlayerList(dataToSend,idToAppend)
			{
				
						var getPlayerList= $.ajax({
						url: "pages/getPlayerList.php",
						type: "POST",
						dataType:'json',
						data: dataToSend,
						datatype: "html"
					});
					getPlayerList.done(function(msg) {
			
					if(idToAppend=="myPlayingSixteen"){
					for(i=0;i<msg.length-1;i=i+2)
						{
						
						$("#"+idToAppend+msg[i+1]+"Table").append(msg[i]);
						trId=($(msg[i]).attr('id'));
						trId=trId.substr(0,trId.length-22);
						trId=trId.substr(0,trId.length-msg[i+1].length);
						movedToMyPlaying11(trId,msg[i+1]);
						}
						$("#ListPlayersClassicViewDiv").append(msg[msg.length-1]);
						printMyTeamSixteen(msg);
						
					}
			
					
			
										
					});
					getPlayerList.fail(function(jqXHR,textStatus) {
					});
			
			
						
			}
	/******************************************************************************/
	/*         call ajax for getting my playing sixteen                           */
	/*******************************************************************************/
	
	
	getMyPlayerList("getMyListSixteen={$_SESSION['teamName_PPL']}","myPlayingSixteen");
	
	
	/******************************************************************************/
	/*         call ajax for getting my playing sixteen ends                      */
	/*******************************************************************************/
	
	
	/******************************************************************************/
	/*         function to display my team                                        */
	/*******************************************************************************/
	
	function printMyTeamSixteen(msg){

	}
	
	/******************************************************************************/
	/*         function to display my team ends                                   */
	/*******************************************************************************/
	
		function fullStats(a){
                   var x=a.id;
                   x=x.substr(0,x.length-22);
			       $(".ClassicViewInnerDetailDiv1").css({'display':'none'});
			       $("#"+x+"ClassicViewInnerDetailDiv1").css({'display':'block'});
				   $("#"+x+"ClassicViewInnerDetailDiv1").css({'float':'left'});

                       }
			function fullStats1(a)
			{
				         $(".ClassicViewInnerDetailDiv1").css({'display':'none'});
			
			}
	
	
	
	
	$(document).ready(function(){
	    $(".playerTypeLi").click(function(){
			   text=this.getElementsByTagName("IMG")[0];
				 var DataToShow="myPlayingSixteen"+$(text).attr("alt")+"Div";
				 $("#ListPlayersImageDiv").ready(function()
				 	{
				 		$("#ListPlayersImageDiv").css({'display':'none'});
					});
				$(".ListPlayersClassicViewPlayerDetailsDiv").css({'display':'none'});				
				$("#ListPlayersClassicViewDiv").css({'display':'block'});				
				$("#"+DataToShow).css({'display':'block'});
					});

		$("#chooseFinalListDiv").css({'display':'block'});
        


	});
	
	
	
	
	
	
	
	
	
	
	
	
	
		function movedToMyPlaying11(plName,plType)
				{
				$("#"+plName+plType+"ClassicViewOuterDetail").ready(function(){
	             var a=document.getElementById(plName+plType+"ClassicViewOuterDetail");
				 a=a.getElementsByClassName("moveToProbablePlayerImg")[0];
                 





				$(a).click(function(){
				 if(reached11())
				 {
				playerId="<li id='"+plName+"("+plType+")My11Team' class='myPlaying11List' onmouseover='displayCancelIcon(this,1)' onmouseout='displayCancelIcon(this,0)'>";
				$("#listFinalPlayerUl").append(
				$(playerId).append(
				'<img src="images/'+plType+'.png" alt="'+plType+'" style="width:32px;height:32px;">'+
		  		plName+
				'<img src="images/cancel.jpeg" alt="close" style="width:20px;height:20px;visibility:hidden;cursor:pointer" class="cancelIconImg" onmousedown="classicViewImageClosed(this,\''+plType+'\')"/>'
				));
	
				var removeElement=document.getElementById(plName+plType+"ClassicViewOuterDetail");
					removeElement.parentNode.removeChild(removeElement);	
					$(".ClassicViewInnerDetailDiv1").css({'display':'none'});
					var noOfPlayer=document.getElementsByClassName("myPlaying11List");
		if(noOfPlayer.length==11) {
		confirmImage='<img src="images/confirm.png" alt="confirm" id="confirmButtonForMy11" style="cursor:pointer;float:right;padding-right:27px" onclick="confirmMy11(this,\'listProbablePlayerLi\')" />'
		  var isSetData=document.getElementById("confirmButtonForMy11");
		if(!(isSetData))$("#chooseFinalListDiv").prepend(confirmImage);
		}					
				 }	
				 				else {
					alert1("you have reached maximum level");
					
					
				
				}				
				 
				 	});
				
});
				}
	
	function reached11()
	{
		var noOfPlayer=document.getElementsByClassName("myPlaying11List");
		if(noOfPlayer.length==11) {
		confirmImage='<img src="images/confirm.png" alt="confirm" id="confirmButtonForMy11" style="cursor:pointer;float:right;padding-right:27px" onclick="confirmMy11(this,\'listProbablePlayerLi\')" />'
		  var isSetData=document.getElementById("confirmButtonForMy11");
		if(!(isSetData))$("#chooseFinalListDiv").prepend(confirmImage);
		
		
		
			return 0;
			
			
		}
		return 1;
	}
	function confirmMy11(a,b)
	{
		var confirmThis=confirm("Are you Sure");
		if(confirmThis)
			{
			dataToSend="MyPlayingEleven="
			var noOfPlayer=document.getElementsByClassName("myPlaying11List");
			for(i=0;i<noOfPlayer.length;i++)
				{
					var IdPlayer=noOfPlayer[i].id;
					IdPlayer=IdPlayer.substr(0,IdPlayer.length-8);
					dataToSend+=IdPlayer+";";
				}
				dataToSend=dataToSend.substr(0,dataToSend.length-1);		
			}
		
		
		
		
		finalListRequest= $.ajax({
			url: "pages/finalSelection11.php",
			type: "POST",
			data: dataToSend,
			datatype: "html"
			});
		finalListRequest.done(function(msg) {
				if(msg=="1") {window.location.href=window.location.href;}
				else alert1(msg);
			
			});
		finalListRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});
				
	
	}
	function islevel11removed()
	{
		var a=document.getElementById("confirmButtonForMy11");
		if(a) a.parentNode.removeChild(a);
		
	}
	function classicViewImageClosed(imageIconClosed,type)
		{
			
			var parentNodeImage=imageIconClosed.parentNode;
			parentNodeImageId=parentNodeImage.id;
			islevel11removed();
			parentNodeImageId=parentNodeImageId.substr(0,parentNodeImageId.length-8);
			dataToSend="getPlayerDetailFor="+parentNodeImageId;
			
	
				var getPlayerList= $.ajax({
						url: "pages/getPlayerList.php",
						type: "POST",
						dataType:'json',
						data: dataToSend,
						datatype: "html"
					});
					getPlayerList.done(function(msg) {
			
			
			
						
						$("#"+"myPlayingSixteen"+msg[1]+"Table").append(msg[0]);
						trId=($(msg[0]).attr('id'));
						trId=trId.substr(0,trId.length-22);
						trId=trId.substr(0,trId.length-msg[1].length);
						movedToMyPlaying11(trId,msg[1]);
						$("#ListPlayersClassicViewDiv").append(msg[msg.length-1]);
						printMyTeamSixteen(msg);
						parentNodeImage.parentNode.removeChild(parentNodeImage);			
						
				
			
			
			
			
			
			
			
			
										
					});
					getPlayerList.fail(function(jqXHR,textStatus) {
					});
			
	
		}
	
	
	
	
	
	function displayCancelIcon(plAttribute,boolValue)
	{
		this1=plAttribute;
		if(boolValue==1) this1.getElementsByClassName("cancelIconImg")[0].style.visibility="visible"; 
		if(boolValue==0) this1.getElementsByClassName("cancelIconImg")[0].style.visibility="hidden"; 
	}
	</script>
SCRIPT;

$value = "hello";

$myPlayingEleven .= <<<SETUPDIV
		<div id ="menuMyTeamDiv" class="menuListUl" style="padding-left:15px;padding-right:15px;">
SETUPDIV;
		$data=getSetNo($_SESSION["teamName_PPL"]);				
        			$cash=<<<EOT
				<script type="text/javascript">$(document).ready(function(){
				        				
        				var cash="<div id=\"balanceAmount\" ><h3>Game: <div id=\"balanceAmount1\" >"+(parseInt({$data})+1)+"</h3></div>";
        				$("#menuMyTeamDiv").prepend(cash);
      });</script>
EOT;
			echo $cash;        
		
		
$myPlayingEleven .= <<<SETUPDIV
		
		
		
			<div class="playerTypeDiv">
             <ul type="none" class="playerTypeUl">
SETUPDIV;
/*********************************************/
/*    display player type at top             */
/*********************************************/

$i = 0;
for ($i = 0; $i < count($DBASE_ARR)-1; $i++) {
	$myPlayingEleven .= <<<SETUPDIV
		<li class="playerTypeLi" style="cursor:pointer;" >		
		<img src="images/{$DBASE_ARR[$i]['TYPE']}2.png" alt="{$DBASE_ARR[$i]['TYPE']}" style=""/>
		</li>
SETUPDIV;

}
/*********************************************/
/*    display player type at top ends        */
/*********************************************/

/*********************************************/
/*    display his team sixteen               */
/*********************************************/

$myPlayingEleven .= <<<SETUPDIV
		</ul>
		</div>



		<div id="ListPlayersClassicViewDiv">
SETUPDIV;
$i = 0;
for ($i = 0; $i < count($DBASE_ARR)-1; $i++) {
	$tableName = "SELECT * FROM " . $DBASE_ARR[$i]["DBNAME"];
	$query = mysql_query($tableName, $connect);
	$myPlayingEleven .= <<<SETUPDIV
	  			<div id="myPlayingSixteen{$DBASE_ARR[$i]["TYPE"]}Div" class="ListPlayersClassicViewPlayerDetailsDiv">
	  			<table id="myPlayingSixteen{$DBASE_ARR[$i]["TYPE"]}Table" class="ListPlayersClassicViewPlayerDetailsTable" cellspacing='0'>
	  			<tr style="positon:fixed;">
SETUPDIV;
	$setValueToDisplay = 3;
	if ($DBASE_ARR[$i]["COACH"] == 1)
		$setValueToDisplay--;
	for ($j = 0; $j < $setValueToDisplay; $j++) {
		$myPlayingEleven .= <<<SETUPDIV
			   <th>{$DBASE_ARR[$i]["DISPLAY"][$j]}</th>
				   	
   	  	
   	  	
SETUPDIV;

	}

	$myPlayingEleven .= <<<SETUPDIV
				<th>SELECT TEAM</th>
	  			</tr>
	  			</table>	  				
SETUPDIV;
	$myPlayingEleven .= <<<SETUPDIV
	
	</div>
SETUPDIV;
}

/*********************************************/
/*    display his team sixteen ends here     */
/*********************************************/

$myPlayingEleven .= <<<SETUPDIV
			

</div>
	<div id="myPlayingEleven">
	</div>
	<div id="chooseFinalListDiv">
				Final List
	        <div id="finalPlayerListDiv">
            <ul id="listFinalPlayerUl" type="none">
   
            </ul>
    		 </div>
		</div>	
	




</div>
SETUPDIV;
}}
?>