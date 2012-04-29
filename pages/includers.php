<?php 
	$setMenuList="";
	$setMenuList.=<<<AB
	
			<script type="text/javascript">
			$(document).ready(function()
				{
$(".menuListUl").css({'display':'none'});
	$("#mainDiv").append($("#menuMyTeamDiv"));
	$("#mainDiv").append($("#menuHome"));
	$("#mainDiv").append($("#menu_HowToPlay"));
	$("mainDiv").append($("#choosePlayer"));
$("#mainDiv").append($("#menuSellOut"));
	
		$("#menuHome").css({'display':'block'});
	
				$("#menu_sell").click(function()
				{
					$(".menuListUl").css({'display':'none'});
					$("#menuSellOut").css({'display':'block'});
				});
	
			$("#menuTeam").click(function()
				{
					$(".menuListUl").css({'display':'none'});
					$("#menuMyTeamDiv").css({'display':'block'});
				});
			$("#menu_team").click(function()
				{
					$(".menuListUl").css({'display':'none'});
					$("#choosePlayer").css({'display':'block'});
				});
				
			$("#menu_home").click(function()
				{
					$(".menuListUl").css({'display':'none'});
					$("#menuHome").css({'display':'block'});
				});

					
				$("#menuHowToPlay").click(function()
					{
					$(".menuListUl").css({'display':'none'});
					$("#menu_HowToPlay").css({'display':'block'});


						});
			$("#menu_myResult").click(function()
				{
					$(".menuListUl").css({'display':'none'});
					$("#menu_result").css({'display':'block'});
				});

	});
					
		</script>
AB;
$setMenuList.=<<<AB
	
       <div id="menuHome" class="menuListUl" style="padding-left:15px;padding-right:15px;">
    
        
        
        
<p style="margin-left: 40px; text-align: center; ">

	<span style="font-family:lucida sans unicode,lucida grande,sans-serif;"><br />

	</span></p>

<p style="text-align: justify;">

  <span style="font-size:14px;"><span style="font-family:verdana,geneva,sans-serif;"><span style="color:#000033;"><span style="font-size:18px;"><span style="font-family:comic sans ms,cursive;"><strong><u>Finally the wait is over!!!</u><br/><br/> Thank you for your patience and unending support. The kind of response we got from you guys was overwhelming and despite all the bottlenecks along the way, the fact that we had 250 final elevens makes us give you guys a salute.<br><br/> Please click on the following link to the google doc which contains the list of the TOP 24 teams that go through and for those of you who could not make it, there is always a next time and Team PPL promises to make that next time the most memorable one.<br/> <a href="https://docs.google.com/spreadsheet/pub?key=0Am8R9WqBnkbEdHkxYzRrNHRXVVBWZ3BucE91bnBvM2c&output=html">Click here for Results</a><br/><br/> Follow us at <a href="http://www.facebook.com/pages/Pragyan-Premier-League/314948425201871">facebook</a> </strong></span></span></span></span></span></p>

<p style="text-align: justify;">

	<span style="font-size:18px;">
		<span style="font-family:comic sans ms,cursive;">
			<strong>
				<span style="color:#000033;">
				</span>
<p >

			<br/>
<span style="color:#000033;">
			   																					   




        
    </div>
       <div id="menu_HowToPlay" class="menuListUl" style="padding-left:15px;padding-right:15px;">
  
        
        
        		Hi and welcome to PPL. We are delighted to welcome you on-board and hope you enjoy the experience.
        PPL this year is a whole new affair and we sincerely believe that to play to your best potential, it is important for you to go through the following rules and regulations:
            
		<div align="center"  id="title"><b>HOW TO PLAY</b></div>
		<div align="center">
    <ul>
      <li>
        <div align="left">The initial home page looks as shown below.It has two options of REGISTER and LOGIN at the top right corner of the page.
If you are a new user then click on the register link to complete registering for the Pragyan Premier League. </div>
      </li>
      
    </ul>
   	<p><img src="images/home.jpg" alt="HOME" width="521" height="209"></p>
	</div>
	
	<div align="center">
    <ul>
      <li>
        <div align="left">If you have already registered then click on login and enter the TeamName and Password to view your main page. 
 </div>
      </li>
      
    </ul>
   	<p><img src="images/login.jpg" alt="LOGIN" width="521" height="209"></p>
	</div>
	
 <div align="center">
    <ul>
      <li>
        <div align="left">There are two views primarily available to you- Graphical and Classical. Graphical is for high-speed internet users and the Classical is for slow net connections.</div>
      </li>
      
    </ul>
   	<p><img src="images/viewchange.jpg" alt="VIEWCHANGE" width="521" height="209"></p>
	</div>
	
	<div align="center">
    <ul>
      <li>
        <div align="left">There is a section called the Probable Players List in which as you are navigating the list of players, you can keep adding those players whom you may consider taking in your squad.</div>
      </li>
      
    </ul>
   	<p><img src="images/probableplayer.jpg" alt="PROBABLEPLAYER COLUMN" width="521"></p>
	</div>
	
	<div align="center">
    <ul>
      <li>
        <div align="left">When you a reach a limit of 16, an alert will be shown to you. However, you can continue adding players to your list.</div>
      </li>
	   <li>
        <div align="left">When you Click on the button Confirm, you will be now taken to a new screen where you have to narrow down your list to 16 final players.</div>
      </li>
         </ul>
   	<p><img src="images/confirm.jpg" alt="CONFIRM LIST"></p>
	</div>
	
	<div align="center">
    <ul>
      
	   <li><div align="left">Each squad can have a maximum of 6 batsmen, 6 bowlers, 2 keepers, 2 All-Rounders.</div></li>
            <li><div align="left">Every squad can have a maximum of one team coach.</div></li>
            <li><div align="left">If you choose, the Graphical View, you can Drag and Drop the players into the Probable Players List whereas in the Classical View, you can click on Add to Team.</div></li>
         </ul>
   	<p><img src="images/draganddrop.jpg" alt="HOW TO DRAG AND DROP"></p>
	</div>
	
	 <div align="center">
    <ul>
      <li>
        <div align="left">On hover on the pictures you can view the name of the player and a magnify symbol on the top right corner of the picture as shown below.click on the magnify symbol to view the full details about the player. .</div>
      </li>
      
    </ul>
   	<p><img src="images/hoverimage.jpg" alt="ON HOVER IMAGE"  height="209"></p>
	</div>
	
	
	 <div align="center">
    <ul>
      <li>
        <div align="left">This shown the magnified image of the person.Click on the cross button to revert back the original page. .</div>
      </li>
      
    </ul>
   	<p><img src="images/magnify.jpg" alt="MAGNIFIED IMAGE"  height="209"></p>
	</div>
	
	<div align="center">
    <ul>
      
	   <li><div align="left">Once your team adheres the limit of the number of batsmen, bowlers, keepers and all-rounders you can click on a button called<b> Confirm</b>.</div></li>
              </ul>
   	<p><img src="images/finallist.jpg" alt="FINALIZE"></p>
	<p><img src="images/final.jpg" alt="FINALIZE" width="521" height="209"></p>
	</div>
	
	<div align="center">
    <ul>
      
	   <li><div align="left">On finalization, your team will be registered.</div></li>
              </ul>
   
	</div>
             In case of any doubts, feel free to call us at any point of time.
            </div>
AB;
$setMenuList.=<<<AB
    <div id="menuSellOut" class="menuListUl" style="padding-left:15px;padding-right:15px;">
  <form action="index.php" method="POST">
 Sell:<br/>
  Player1:<input type="text" name="sellPlayer1" id=""/>
  Player2:<input type="text" name="sellPlayer2" id=""/><p></p>
 Buy:<br/>
  Player1:<input type="text" name="buyPlayer1" id=""/>
  Player2:<input type="text" name="buyPlayer2" id=""/><br />
<input type ="submit" name="" value="change" />
  </form>
</div>	
            
AB;
	
	echo $setMenuList;


	
?>
