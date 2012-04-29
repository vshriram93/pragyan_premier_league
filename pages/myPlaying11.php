<?php
$my11=getListEleven($_SESSION["teamName_PPL"]);
$myPlaying11="";
$myPlaying11.=<<<html
	<style>
	#playerSortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
	#playerSortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
	#playerSortable li span { position: absolute; margin-left: -1.3em; }
	</style>
	<script type="text/javascript">
	$(function() {
		$( "#playerSortable" ).sortable();
		$( "#playerSortable" ).disableSelection();
	});
	$(document).ready(function(){
	dataToSend="getImages={$my11}";
	playerRequest= $.ajax({
						url: "pages/getPlayerList.php",
						type: "POST",
						dataType:'json',
						data: dataToSend,
						datatype: "html"
					
						});
		playerRequest.done(function(msg) {
			$("#menuMyTeamDiv").append(msg[0]);

			});
		playerRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});
	
var confirmImage='<img src="images/confirm.png" alt="confirm" id="confirmButtonForMy11" style="cursor:pointer;float:right;padding-right:27px"  />'
	$("#DragMyEleven").append(confirmImage);
var confirmImage='<input type="button" id="confirmFinalButtonForMy11" style="cursor:pointer;float:right;padding-right:27px;width:35px;" value="FinalConfirm" />'
	$("#DragMyEleven").append(confirmImage);








		$("#confirmFinalButtonForMy11").click(function(){
			var dataToSend="confirmThis=confirm";
			finalListRequest= $.ajax({
			url: "pages/finalSelection11.php",
			type: "POST",
			data: dataToSend,
			datatype: "html"
			});
		finalListRequest.done(function(msg) {
			window.location.href=window.location.href;
			});
		finalListRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});
		
		});
		


















		$("#confirmButtonForMy11").click(function(){
			var dataToSend="MyPlayingEleven1=";	
			var data=document.getElementsByClassName("ui\-state\-default");
			for(i=0;i<data.length;i++)
				{
					dat=data[i].childNodes[0].id;
					dat=dat.substr(0,dat.length-22);
					dataToSend+=dat;
					if(i!=data.length-1) dataToSend+=";"
										
				}
			finalListRequest= $.ajax({
			url: "pages/finalSelection11.php",
			type: "POST",
			data: dataToSend,
			datatype: "html"
			});
		finalListRequest.done(function(msg) {
			alert1("submission successful<br/>keep changing your playing order till tommorrow morning");
                      
			});
		finalListRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});
		
		});
		










		$("#changePlayerPosition").click(function(){
			
			$(".MyPlayingElevenFinalList").css({'display':'none'});
			$("#DragMyEleven").css({'display':'block'});
		});
		$("#playerTrainingSession").click(function(){
			$(".MyPlayingElevenFinalList").css({'display':'none'});
			$("#TrainingSession").css({'display':'block'});
			
			var k= prompt("Enter the amount you want to spend for training session");			
				if(k){
				var balAmt=document.getElementById("balanceAmount1");
				 balAmt=parseInt(balAmt.innerHTML);   
				if(balAmt>=k){
				var con=confirm("Are you sure");
				if(con){
				dataToSend="amountToSpend="+k;
			amtRequest= $.ajax({
			url: "pages/finalSelection11.php",
			type: "POST",
			data: dataToSend,
			datatype: "html"
			});
		amtRequest.done(function(msg) {
			alert1("submission successful");
			balAmt-=k;
			document.getElementById("balanceAmount1").innerHTML=balAmt;
			});
		amtRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});
				
				}
				}
				}
		});
		
	});
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
	

	</script>










	<div id="menuMyTeamDiv" class="menuListUl" style="padding-left: 15px; padding-right: 15px; display: block;">
  <input type="button" value="finalize Playing Team" id="changePlayerPosition"/>
		
	  <input type="button" value="Training session" id="playerTrainingSession"/>
	
	<div class="MyPlayingElevenFinalList" id="DragMyEleven">

			  <h3>Drag and drop a  Player To an alternate position to change his playing position</h3>
	<ul id="playerSortable" style="float:left;">
		
html;
	$my112=getListEleven($_SESSION["teamName_PPL"]);
	$my11=explode(";",$my112);
	
	for($i=0;$i<count($my11);$i++)
	{
	$splitData=explode("(",$my11[$i]);
	$splitData[1]=substr($splitData[1],0,-1);	
	$myPlaying11.=<<<html
	
	<li class="ui-state-default" style="position:relative;top:10px;" id="{$splitData[0]}{$splitData[1]}ClassicViewOuterDetail" onmouseover="fullStats(this)" onmouseout="fullStats1(this)" class="tableTrClassicViewOuterDetail"><span style="position:relative;top:-10px;" id="{$splitData[0]}({$splitData[1]})ClassicViewOuterDetail"><img src="images/{$splitData[1]}2.png" alt="{$splitData[1]}" style=""/><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>{$splitData[0]}	</span></li>
html;
	}
	$myPlaying11.=<<<html
	</ul>
	</div>

		</div>
	  	  	<div class="MyPlayingElevenFinalList" id="TrainingSession">
	  This money will be used in training for the present team.You can spent seperately for each day team

html;

	  $data=getAmt($_SESSION["teamName_PPL"]);
$cash=<<<EOT
  <script type="text/javascript">$(document).ready(function(){
      
      var cash="<div id=\"balanceAmount\"><img src='images/moneybag.png' alt=''/><h3>Current Balance: <div id=\"balanceAmount1\">{$data}</div></h3></div>";
      $("#TrainingSession").prepend(cash);

      
    });</script>
EOT;
echo $cash;        

	$myPlaying11.=<<<html

</div>

html;
	
?>
