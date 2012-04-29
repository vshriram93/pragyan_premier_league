<?php
$addPlayerToList=<<<AB
			<style>
				.ui-state-active1
				{
				background-color:rgba(255,255,255,.50);
				height:70%
				}
			</style>
		  <script type="text/javascript">
		  	 var classicView=0;
		  	 var amtIncrease=0;
		    var isHovered=false;
		    var image=new Array();
		    $("#ListPlayersImageBatsmanDiv").ready(function()
		    	{
		    		$("#ListPlayersImageDiv").css({'display':'block'});
		    		$("#ListPlayersImageBatsmanDiv").css({'display':'block'});
		    			    		
		    });
			/*********************************************************************/
			/**Removes the Elements From Local Storage For Probable Player(HTML5)*/
			/*********************************************************************/			
			function removeFromsessionStorage(a,imgSrc,imgName,imgId,imgAlt,imgClass,listId)
			{
				imageSource1="\'"+a+"\',\'"+imgSrc+"\',\'"+imgName+"\',\'"+imgId+"\',\'"+imgAlt+"\',\'"+imgClass+"\',\'"+listId+"\'";
				var storage=sessionStorage;
				var k=storage[imgName].split(";");
				if(k)
				{
					for(i=0;i<k.length;i++)
					{
						var t=new Array();						 
						t=k[i].split("|");
						if(t[0]==imageSource1) {k.splice(i,1);}					
					}
					sessionStorage[imgName]="";
					for(i=0;i<k.length;i++)
					{
						if(i) sessionStorage[imgName]+=";";
						sessionStorage[imgName]+=k[i];					
					}
				}
			}
			/*********************************************************************/			
			/*********************************************************************/			
			/*********************************************************************/			

			/*********************************************************************/
			/**     Function To Execute After Probable Player is Choosen         */
			/*********************************************************************/			
			
		function addToFinalListTableFn(dataToSend,idToAddResultantData)
			{
				
								
					var getPlayerDetails= $.ajax({
						url: "pages/getPlayerDetails.php",
						type: "POST",
						dataType:'json',
						data: dataToSend,
						datatype: "html"
					
						});
					getPlayerDetails.done(function(msg) {
							
					length=msg.length;
					if(idToAddResultantData=="ListPlayersClassicView"||idToAddResultantData=="getPlayerTrListForClassicView"){
length--;}
					for(i=0;i<length;i=i+2)
						{
					$("#"+idToAddResultantData+msg[i+1]+"Table").append(msg[i]);
					if(idToAddResultantData=="playersFinalList")
						{
							$("#confirmFinalList").css({'display':'block'});
							$("#probablePlayerTypeDiv").remove();
							$(".playerTypeDiv").remove();
							if(amtIncrease)
							{
							a=document.getElementById(idToAddResultantData+msg[i+1]+"Table");
							playerAmount=parseInt(a.childNodes[a.childNodes.length-1].childNodes[3].innerHTML);
							var valueToAppend=document.getElementById("balanceAmount1").innerHTML;
							value=(parseInt(valueToAppend.substr(1,valueToAppend.length)));
							value+=playerAmount;
							
							document.getElementById("balanceAmount1").innerHTML="$"+value;
							amtIncrease=1;

							}		
								
						}
										
					if(idToAddResultantData=="ListPlayersClassicView"||idToAddResultantData=="getPlayerTrListForClassicView")	
						{
							movedToProbableListFromClassicView(idToAddResultantData+msg[i+1],msg[i]);
						}

							}	
					if(idToAddResultantData=="playersFinalList")	
						{
							$("#confirmFinalList").css({'display':'block'});
							$(".FinalPlayerListTable").css({'display':'none'});
							$("#playersFinalListBatsmanDiv").css({'display':'block'});
							movedToFinalList();	
							}
				if(idToAddResultantData=="ListPlayersClassicView"||idToAddResultantData=="getPlayerTrListForClassicView")
						{
                      $("#ListPlayersClassicViewDiv").append(msg[length]);
                    	
		//RahulDravidBatsmanClassicViewOuterDetail
//			ViratKohli(Batsman)ProbablePlayerLi
				
		
	//		$(".ListPlayersClassicViewPlayerDetailsTable").ready(function () {
		var listPlayer=document.getElementsByClassName("listProbablePlayerLi");
			listPlayerLen=listPlayer.length;
			
			for(i=0;i<listPlayerLen;i++)
				{
							
							var splitData=listPlayer[i].id.split("(");
							splitData1=splitData[1].split(")");
							var removeElement=document.getElementById(splitData[0]+splitData1[0]+"ClassicViewOuterDetail");
						if(removeElement) removeElement.parentNode.removeChild(removeElement);
											 	
			 	 } 
                      
                       
                      
                      
                         }
					});
					getPlayerDetails.fail(function(jqXHR,textStatus) {
					alert1("Connection Failed");
					});
			
				
				
				}


		function probablePlayerListFn(a,classname)
			{
				
				$("#chooseFinalListDiv").css("display","block");
			
					document.getElementsByClassName("playerTypeDiv")[0].style.display="none";
					document.getElementById("probablePlayerTypeDiv").style.display="none";
										
					var probablePlayerArray=document.getElementsByClassName(classname);			
					var len=probablePlayerArray.length;
					dataToSend="getPlayerList=";					
					for(i=0;i<len;i++)
					{
					var plId=(probablePlayerArray[i].id);
					if(plId.length>16)
				{	
						if(i) dataToSend+="|";
					dataToSend+=plId.substr(0,plId.length-16);
							
				}
				}
			addToFinalListTableFn(dataToSend,"playersFinalList");
				removeThis=document.getElementById("slowConnectionP");
					removeThis.parentNode.removeChild(removeThis);						
						alert1("Choose 17 players From the list");
					


			}
			/*********************************************************************/			
			/*********************************************************************/			
			/*********************************************************************/			

			/*********************************************************************/
			/**  Function Will get Executed once the Player Image is loaded      */
			/*********************************************************************/			
		function playerImageLoaded(a,b,c)
		{
			if(c==1)
				{
									if(a.name=="loading") 
					{

						a.src=a.src;a.name=b;
					}					
				}
				if(c==0)
				{
				if(a.name=="loading") 
					{
							a.src=a.src;a.name=b;a.style.display="";
							
							parent=a.parentNode;
							if(parent){								
							for(i=0;i<parent.childNodes.length;i++)
								{
										k=parent.childNodes[i];
										if(k.tagName)
										if((k.tagName.toLowerCase()=="img")&&(k!=a)&&k.className=="loadingImage") parent.removeChild(k);
								}	}				
					}
				}
		}


			/**************************************************************************/
			/*Drag and Drop Function will get Executed once the player image is loaded*/
			/**************************************************************************/
			$(".ListPlayersImageDiv").ready(function()
			{
				enableDrag();
			});
			/***************************************************************************/			
			/***************************************************************************/			
			/***************************************************************************/			


			/**************************************************************************/
			/*  Code For Draggable and Droppable.this will enable drag and drop       */
			/**************************************************************************/

			function enableDrag(){
			$(function(){


			/**************************************************************************/
			/*           Code For Draggable.this will enable draggable                */
			/**************************************************************************/

				$(".magnify1").draggable({
					revert: "invalid",
					tolerance:'intersect',
					cursor: "move",
					helper:"clone"
				});
			/***************************************************************************/			
			/***************************************************************************/			
			/***************************************************************************/			

			/**************************************************************************/
			/*           Code For Droppable.this will enable drop feauture            */
			/**************************************************************************/

  			$( ".probablePlayerTypeClass" ).droppable({
			   accept: ".magnify1",
   			activeClass: "ui-state-active1",
			   hoverClass: "ui-state-hover1",
  			   drop: function( event, ui ) {
   			   	 $( this )
  				    .addClass( "ui-stav" )
  				    .find( "ul" )
  				    addMember($(this),ui.draggable);
				    checkComplete();
  				    }
  				 });
 			/***************************************************************************/			
			/***************************************************************************/			
			/***************************************************************************/			
			 });
				 }			




	     $(document).ready(function(){


			$("#openClassicView").click(function(){
			if(!classicView)
			{
			classicView=1;
			addToFinalListTableFn("getPlayerListForClassicView=\"getDetailsOfPlayer\"","ListPlayersClassicView");
			removeDiv=document.getElementById("ListPlayersImageDiv");
			removeDiv.parentNode.removeChild(removeDiv);
	//		removeDiv1=document.getElementById("listPlayerUl");
	//		removeDiv1.parentNode.removeChild(removeDiv1);
			document.getElementById("listPlayerClassicViewUl").id="listPlayerUl";

	//		a=document.getElementById("probablePlayerSelectedButton");
	//		if(a) a.parentNode.removeChild(a);
			var data=document.getElementById("openClassicView");
			data.innerHTML="Switch to Graphical view";
			
			//RahulDravidBatsmanClassicViewOuterDetail
//			ViratKohli(Batsman)ProbablePlayerLi
		








		 var DataToShow="ListPlayersClassicView"+"Batsman"+"Div";
			 $("#ListPlayersImageDiv").ready(function()
				 	{
				 		$("#ListPlayersImageDiv").css({'display':'none'});
					});
				$(".ListPlayersClassicViewPlayerDetailsDiv").css({'display':'none'});
				$("#ListPlayersClassicViewDiv").css({'display':'block'});
				$("#"+DataToShow).css({'display':'block'});


			}
			else
				{
					classicView=0;
					var request=confirm("Your Probable Player List will be Erased!!!Continue??");
					if(request)		window.location.href=window.location.href;			
					
		
						
				}
			});
			
			
			
					 var imageToShow="ListPlayersImage"+$(this).text()+"Div";
			   	 $(".ListPlayersImageDiv").css({'display':'none'});
 				    $("#ListPlayersImageBatsmanDiv").css({'display':'block'});				
					$("#"+imageToShow).css({'display':'block'});


			
				
			


			if(!document.getElementById("choosePlayer"))$('#mainDiv').append($("#choosePlayer"));

			/****************************************************************************/
			/*    Local Storage Used For Storing data in the local computer		       */
			/*    Can be used to retrive data even after Page Reloads	      	       */
			/****************************************************************************/

			/****************************************************************************/			
			/*           Checks whether browser supports sessionStorage                   */
			/*           Pulls the data From LocalHost once the page is reloaded        */
			/****************************************************************************/			
			
		    if(sessionStorage)
		    	{
						listPlayer=document.getElementById("listPlayerUl");
AB;
				for($i=0;$i<count($DBASE_ARR);$i++)
					{				
					$addPlayerToList.=<<<AB
							var dataStored=(sessionStorage["{$DBASE_ARR[$i]['TYPE']}"]);
							
												
							if(dataStored&&dataStored.length!=""){
							 			liArray=dataStored.split(";");
										for(i=0;i<liArray.length;i++)		
										{
											dataForLiArray=liArray[i].split("|");
							 				while(removeImage=document.getElementById(dataForLiArray[5]))
								 			{
								 				removeImage=document.getElementById(dataForLiArray[5]);
												removeImage=removeImage.parentNode;
								 				$(removeImage).css({'display':'none'});
				  								removeImage.parentNode.removeChild(removeImage);
				   						}
				   				var imgType=	'<img src='+dataForLiArray[4]+' alt=('+dataForLiArray[2]+') style="width:32px;height:32px;margin-bottom:-10px;"/>';
									$(listPlayer).append(
									$('<li id='+dataForLiArray[3]+' style="height:38px;" class='+'\'listProbablePlayerLi\''+' onmouseover="displayCancelIcon(this,1)" onmouseout="displayCancelIcon(this,0)">').append(
									imgType+
								  	dataForLiArray[1]+
  								  	'<img src="images/cancel.jpeg" alt="close" style="width:20px;height:20px;visibility:hidden;cursor:pointer"  class="cancelIconImg" onmousedown="imageClosed('+dataForLiArray[0]+')"/>'
								  
									));
	
									}
											
								}
							checkComplete();
			
AB;
					}
			$addPlayerToList.=<<<AB
	
}
			/****************************************************************************/			
			/****************************************************************************/			
			/****************************************************************************/			


			/****************************************************************************/			
			/*       Display the images when the player clicks the player type          */
			/****************************************************************************/			
	    			
			    $(".playerTypeLi").click(function(){
					
			   text=this.getElementsByTagName("IMG")[0];
				if(classicView)
					{
			 var DataToShow="ListPlayersClassicView"+$(text).attr("alt")+"Div";
			 $("#ListPlayersImageDiv").ready(function()
				 	{
				 		$("#ListPlayersImageDiv").css({'display':'none'});
					});
				$(".ListPlayersClassicViewPlayerDetailsDiv").css({'display':'none'});				
				$("#ListPlayersClassicViewDiv").css({'display':'block'});				
				$("#"+DataToShow).css({'display':'block'});

						
						}
				else{	
				
			 var imageToShow="ListPlayersImage"+$(text).attr("alt")+"Div";
					 $("#ListPlayersClassicViewDiv").css({'display':'none'});
			   	 $(".ListPlayersImageDiv").css({'display':'none'});
					$("#"+imageToShow).css({'display':'block'});
					}					
					});
			/****************************************************************************/			
			/****************************************************************************/			
			/****************************************************************************/			
    			
    			
    			
    			$(".playerTypeForFinalListLi").click(function(){
    				 text=this.getElementsByTagName("IMG")[0];
				
			    var tableToShow="playersFinalList"+$(text).attr("alt")+"Div";
			    $(".FinalPlayerListTable").css({'display':'none'});
				$("#"+tableToShow).css({'display':'block'});
					});


  				});
			/****************************************************************************/			
			/**                   End of document ready                                **/			
			/****************************************************************************/			



			/****************************************************************************/			
			/*  Adds the member to probable list once the player is dropped to the list */
			/****************************************************************************/			

			 function addMember(item,imageElement)
  			 {
			 	var trial="",t1,playerImgSource,t2,attrValue;
			 	imageElementId=imageElement.attr('id')

			/****************************************************************************/			
			/*             Removes the images from the list                             */
			/****************************************************************************/			
			 	while(imageRemoval=document.getElementById(imageElementId))
			 	{
			 		imageRemoval=document.getElementById(imageElementId);
					t2=imageRemoval;
				 	imageRemoval=imageRemoval.parentNode;
				 	t1=imageRemoval;
					trial=imageRemoval.parentNode;
				 	$(imageRemoval).css({'display':'none'});
				  	imageRemoval.parentNode.removeChild(imageRemoval);
			 }
			/****************************************************************************/			
			/*             End of while loop                                            */
			/****************************************************************************/			
			 
	  			listPlayer=document.getElementById("listPlayerUl");
				var id;
				id=imageElement.attr('alt');

				var t=id.split("(");
				t[1]=t[1].substr(0,t[1].length-1);
				id+="ProbablePlayerLi";
				var source='images/'+t[1]+'.png';
				
				imageSource1="\'"+trial.id+"\',\'"+t2.src+"\',\'"+t2.name+"\',\'"+t2.id+"\',\'"+t2.alt+"\',\'"+t2.className+"\',\'"+id+"\'";
				var storage=sessionStorage;
				if(!(storage[t2.name])) {storage[t2.name]="";storage[t2.name]=imageSource1+"|"+t[0]+"|"+t[1]+"|"+id+"|"+source+"|"+imageElementId;}
				else  storage[t2.name]+=";"+imageSource1+"|"+t[0]+"|"+t[1]+"|"+id+"|"+source+"|"+imageElementId;
            var sourceToAppend="<img src="+source+" alt=("+t[1]+") style='width:32px;height:32px;margin-bottom:-10px;'/>";            	
			
			
			
				$(listPlayer).append(
					$('<li id='+id+' class='+'\'listProbablePlayerLi\''+' style="height:38px;"onmouseover="displayCancelIcon(this,1)" onmouseout="displayCancelIcon(this,0)">').append(
						sourceToAppend+
					  t[0]+

		  '<img src="images/cancel.jpeg" alt="close" style="width:20px;height:20px;visibility:hidden;cursor:pointer" class="cancelIconImg" onmousedown="imageClosed('+imageSource1+')"/>'
			
				));
			}
			/****************************************************************************/			
			/*                End of addmember function                                 */			
			/****************************************************************************/			
	
	
			/****************************************************************************/			
			/*             Checks whether the list has reached the min position         */
			/**************************************************listPlayerUl**************************/			
	
	 		function checkComplete()
	 		{
				c=document.getElementById("listPlayerUl");
				var confirmImage;	   			
	   			if(c.childNodes.length==18) 
	   			{
					alert1("You Have Reached Min Level");
					}
					
					confirmImage='<img src="images/confirm.png" alt="confirm" id="probablePlayerSelectedButton" style="cursor:pointer;float:right;padding-right:27px" onclick="probablePlayerListFn(this,\'listProbablePlayerLi\')" />'
	   			if(c.childNodes.length>=18) 
	   			{

					if(!(document.getElementById("probablePlayerSelectedButton")))	$('#probablePlayerTypeDiv').prepend(confirmImage);
				}
				document.getElementById("incrementPlayerList").innerHTML=c.childNodes.length-1;
	 		}
			/****************************************************************************/			
			/*                End of checkcomplete function                             */			
			/****************************************************************************/			

			/****************************************************************************/			
			/*                when player image is clicked the style changed            */			
			/****************************************************************************/			
	
			function imageClicked(a)
			{
				$(".magnify1").css({'z-index':'-30'});
								
				$(".ui\-draggable").css({'z-index':'-30'});
				$(".ui\-draggable\-dragging").css({'z-index':'-30'});
				var q=document.getElementsByClassName("ListPlayersImageDiv");
				$(a).css({'z-index':'30'});
			}

			/****************************************************************************/			
			/*                End of imageClicked function                             */			
			/****************************************************************************/			
	
			/****************************************************************************/			
			/*                onmouseout the style changes to normal                    */			
			/****************************************************************************/			
			function imageOut(a)
			{
				$(".magnify1").css({'z-index':''});
				$(".ui\-draggable").css({'z-index':''});
				$(".ui\-draggable\-dragging").css({'z-index':''});
				
			}

			/****************************************************************************/			
			/*                End of imageout function                                  */			
			/****************************************************************************/			

			/****************************************************************************/			
			/*                function for removing player from probable list           */			
			/****************************************************************************/			
			
			function imageClosed(a,imgSrc,imgName,imgId,imgAlt,imgClass,listId)
			{
				var confirmation=confirm("Are You Sure");
				if(confirmation)	
				{
					textNode='<div class="playerNameImg" onmouseover="displayPlayerName(this,1)" onmouseout="displayPlayerName(this,0)" style="width:100px;height:110px">';
					textNode+='<img src="images/loading1.gif" class="loadingImage"/>'
					textNode+='<img src="'+imgSrc+'" style="width:100px;height:110px;cursor:move" class="'+imgClass+'" name="'+"loading"+'" id="'+imgId+'" alt="'+imgAlt+'" onmousedown="imageClicked(this)" onmouseup="imageOut(this)" onLoad="playerImageLoaded(this,\''+imgName+'\',0)"/>';
					textNode+='<img src="images/magnify.cur" style="width:30px;height:30px;cursor:pointer;display:none;" class="magnifyImage" onclick="playerDetails(this)"/>';				
					textNode+='<div style="text-align:center;visibility:hidden;" class="displayPlayerNameOnImageHover">'+imgId.substr(0,imgId.length-3)+'</div></div>'
					$("#"+a).append(textNode);
					removeList=document.getElementById(listId);
					removeList.parentNode.removeChild(removeList);				
					enableDrag();
					c=document.getElementById("listPlayerUl");
	   			if(c.childNodes.length==17) 
	   			{
						alert1("You Have Reduced From Min Level");
	   				$('#probablePlayerSelectedButton').remove();
					}	
					document.getElementById("incrementPlayerList").innerHTML=c.childNodes.length-1;
					removeFromsessionStorage(a,imgSrc,imgName,imgId,imgAlt,imgClass,listId);
	 			}
			}
		
			/****************************************************************************/			
			/*                End of imageclose function                                */			
			/****************************************************************************/			


			/****************************************************************************/			
			/*                displays cancel icon when hovered                         */			
			/****************************************************************************/			
			
			function displayCancelIcon(a,b)
			{
			if(b)		a.getElementsByClassName("cancelIconImg")[0].style.visibility="visible";
			else a.getElementsByClassName("cancelIconImg")[0].style.visibility="hidden";
			}
			
			/****************************************************************************/			
			/*                End of displayCancelIcon function                         */			
			/****************************************************************************/			

			/****************************************************************************/			
			/*                displays player Name when hover over player name          */			
			/****************************************************************************/			
		
			function displayPlayerName(a,b)
			{
			var changeToMade=a.getElementsByClassName("magnify1")[0];			
			if(b) 
				{
			$(".playerNameImg").css({'zIndex':'-30'});		
			a.getElementsByTagName("div")[0].style.visibility="visible";
				a.getElementsByClassName("magnifyImage")[0].style.display="block";
					$(changeToMade).css({'box-shadow':'0 0 15px #EEE'});	
					}	
			else  
				{
					a.getElementsByTagName("div")[0].style.visibility="hidden";
					a.getElementsByClassName("magnifyImage")[0].style.display="none";
				$(changeToMade).css({'box-shadow':'none'});	
		
							}
			}
			/****************************************************************************/			
			/*                End of displayplayername function                         */			
			/****************************************************************************/			
	
	
			function playerDetails(currentImage)
				{
					pictureZoom=currentImage.parentNode.getElementsByClassName("magnify1")[0];
					var imgSource=pictureZoom.src;
					var altName=$(pictureZoom).attr('alt');
					var imgName=pictureZoom.name;
					
					var image='<img src="'+imgSource+'" name="loading" alt="'+altName+'" class="magnifiedImage" onLoad="playerImageLoaded(this,\''+imgName+'\',1)">';
					var image1='<img src="images/cancel.jpeg" alt="close" class="closeIconForEnlargedImage" onmousedown="closeEnlargedImage(this)"/>';		

					$("#completeDetailOfPlayer").append(image);
					$("#completeDetailOfPlayer").append(image1);
					$("#frameDiv").css({'display':'none'});
					$("#completeDetailOfPlayer").css({'position':'absolute'});
					$("#mainDiv").css({'display:none':'0'});
					$("#completeDetailOfPlayer").css({'display':''});
					
					
					
					
				 dataToSend="playerType="+altName;					
					var getPlayerDetails= $.ajax({
						url: "pages/getPlayerDetails.php",
						type: "POST",
						data: dataToSend,
						datatype: "html"
						});
					getPlayerDetails.done(function(msg) {
					$("#completeDetailOfPlayer").append(msg);
					});
					getPlayerDetails.fail(function(jqXHR,textStatus) {
					alert1("Connection Failed");
					});
					

				}












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



			function closeEnlargedImage(a)
			{
				a=a.parentNode;
				child=a.childNodes;
				for(i=0;i<child.length;i++)
					{
						a.removeChild(child[i]);					
						i--;
					}			
					$("#frameDiv").css({'display':''});
					$("#mainDiv").css({'display':''});
				
					$("#completeDetailOfPlayer").css({'display':'none'});
	
			}
			function movedToFinalList()
			{
				$(".moveToFinalListImg").click(function () {
					if(document.getElementsByClassName("finalListLi").length<=16)
					{
						var tableTrData=this.parentNode.parentNode;		
						if(tableTrData.parentNode)
						{
							{
								
							playerAmount=parseInt(this.parentNode.parentNode.childNodes[3].innerHTML);
							var listId=this.id.substr(0,this.id.length-12);
							var plDetail=listId.split("(");
							plDetail[1]=plDetail[1].substr(0,plDetail[1].length-1);
							var source="images/"+plDetail[1]+".png";
							var dataToAppend='<li id=\''+listId+'FinalListLi\' class="finalListLi" onMouseOver="displayCancelIcon(this,1)" onMouseOut="displayCancelIcon(this,0)">';
							var dataRecieved=tableTrData.innerHTML;
							dataRecieved=dataRecieved.replace(/"/g,'~');
							var sourceToAppend='<img src='+source+' alt=('+plDetail[0]+') style="width:32px;height:32px;"/>';
						
							var valueToAppend=document.getElementById("balanceAmount1").innerHTML;
							
							value=(parseInt(valueToAppend.substr(1,valueToAppend.length)));
							
							value-=playerAmount;
							document.getElementById("balanceAmount1").innerHTML="$"+value;
						amtIncrease=1;
			
							
								if(value>0) 
							{						tableTrData.parentNode.removeChild(tableTrData);
													
							$("#listFinalPlayerUl").append(
				
							$(dataToAppend).append(
								sourceToAppend+
								plDetail[0]+
			   			 '<img src="images/cancel.jpeg" alt="close" style="width:20px;height:20px;cursor:pointer;visibility:hidden" class="cancelIconImg" onClick="removeNameFromFinalListFn(this)"/>'
							));probablePlayerListFn
									
									document.getElementById("incrementPlayerList").innerHTML=document.getElementsByClassName("finalListLi").length;							
							}	
							else 
								{
									value+=playerAmount;
									document.getElementById("balanceAmount1").innerHTML="$"+value;
										alert1("Amount InSufficient");							
								
								}
						}
						}
					checkFinalListComplete();
						}
					 if(document.getElementsByClassName("finalListLi").length==17){
						alert1("You have reached max no.");
							return;						
						}
                 
	
					});

			}
		
		
		
			function removeNameFromFinalListFn(cancelImg)
				{
					var removeElement=cancelImg.parentNode;
					addToFinalListTableFn("getPlayerList="+(removeElement.id).substr(0,removeElement.id.length-11),"playersFinalList");
					removeElement.parentNode.removeChild(removeElement);
					if(document.getElementsByClassName("finalListLi").length==16) 
					{
						alert1("Max Level Reduced");
						$("#confirmedFinalListCheckImg").css({'display':'none'});
						imageRemove=document.getElementById("confirmedFinalListCheckImg");
						imageRemove.parentNode.removeChild(imageRemove);
					
					}
						document.getElementById("incrementPlayerList").innerHTML=document.getElementsByClassName("finalListLi").length;
					
	
	
	
				}
		
			function checkFinalListComplete()
			{
					if(document.getElementsByClassName("finalListLi").length==17)
					{				
					if(!(document.getElementById("confirmedFinalListCheckImg")))
					{
						$("#chooseFinalListDiv").prepend('<img src="images/confirm.png" style="display:none;cursor:pointer;float:right;margin-right: 25px;" id="confirmedFinalListCheckImg"/>');
						{
   						$("#confirmedFinalListCheckImg").css({'display':'block'});
   						$("#confirmedFinalListCheckImg").click(function(){
							addTheFinalListToDatabase(this);		
			
				//			window.location.href=window.location.href;
 							}
   							
   							);              	
	                 	
                 	}   
					}
				}
				}		

			function addTheFinalListToDatabase(data)
				{
					addData=document.getElementsByClassName("finalListLi");
					
					dataToSend="finalList=";					
					
					for(i=0;i<addData.length;i++)
					{
					if(i) dataToSend+=";";
					var dataId=addData[i].id;
					dataId=dataId.substr(0,dataId.length-11);
					dataToSend+=dataId;
					
					
					
					}













			finalListRequest= $.ajax({
			url: "pages/finalSelection.php",
			type: "POST",
			data: dataToSend,
			datatype: "html"
			});
		finalListRequest.done(function(msg) {
				if(msg=="1") {window.location.href=window.location.href;}
				else 	alert1(msg);
			
			});
		finalListRequest.fail(function(jqXHR,textStatus) {
			alert1("Connection Failed");
			});

							
				
				}		
	

		

			function movedToProbableListFromClassicView(tableName,innerValue)
				{
	
				$(".tableTrClassicViewOuterDetail").ready(function(){
					
					$(".moveToProbablePlayerImg").click(function(){
						if(this.className=="moveToProbablePlayerImg")	
						{										
							insertClassicViewToLi(this);										
							this.className="moveToProbablePlayerImg1";
												
						}
													
						});
							
});
				}		
	 	
			function insertClassicViewToLi(data)
				{
				var idLength=data.id;
				idLength=idLength.substr(0,idLength.length-18);
			   var split=idLength.split("(");
				data=data.parentNode;
				data.parentNode.parentNode.removeChild(data.parentNode);
				var source=split[1].substr(0,split[1].length-1);
				liData='<li id="'+idLength+'ProbablePlayerLi"  class="listProbablePlayerLi" onmouseover="displayCancelIcon(this,1)" onmouseout="displayCancelIcon(this,0)" >';						
				$("#listPlayerUl").append(
 	    			$(liData).append(
					'<img src="images/'+source+'.png" alt="'+idLength+'" style="width:32px;height:32px;">'+
		  			split[0]+
					'<img src="images/cancel.jpeg" alt="close" style="width:20px;height:20px;visibility:hidden;cursor:pointer" class="cancelIconImg" onmousedown="classicViewImageClosed(this,\''+idLength+'\')"/>'
			));
			    checkComplete();					
				
				}
				function classicViewImageClosed(dataImg,imageClose)
				{
				
				addToFinalListTableFn("getPlayerTrListForClassicView="+imageClose,"ListPlayersClassicView");				
				dataImg=(dataImg.parentNode);
				dataImg.parentNode.removeChild(dataImg);
					c=document.getElementById("listPlayerUl");
	   			if(c.childNodes.length==16) 
	   			{
						alert1("You Have Reduced From Min Level");
	   				$('#probablePlayerSelectedButton').remove();
					}	
			document.getElementById("incrementPlayerList").innerHTML=c.childNodes.length-1;
	
					
					
					
					}
	</script>	




AB;
$addPlayerToList.=<<<AB
	<div id="choosePlayer" class="menuListUl">
        <div id="probablePlayerTypeDiv" class="probablePlayerTypeClass">
            Probable Players

            <ul id="listPlayerUl" type="none">
            </ul>
				<ul id="listPlayerClassicViewUl" type="none">
				</ul>
				  </div>
    	<div class="playerTypeDiv">
             <ul type="none" class="playerTypeUl">
AB;
	$i=0;
	for($i=0;$i<count($DBASE_ARR);$i++)
	{
	$addPlayerToList.=<<<AB
		<li class="playerTypeLi" style="cursor:pointer;" >		
		<img src="images/{$DBASE_ARR[$i]['TYPE']}2.png" alt="{$DBASE_ARR[$i]['TYPE']}" style=""/>
		</li>
AB;
	
}	$addPlayerToList.=<<<AB
		</ul>
		<div id="ListPlayersImageDiv">
    	
AB;
    $i=0;
    for($i=0;$i<count($DBASE_ARR);$i++)
    {
    $tableName="SELECT * FROM ".$DBASE_ARR[$i]["DBNAME"];
    $query =mysql_query($tableName,$connect);
     $player_img=array();
    $image=array();
    $player_id=array();
    $playerId=array();
    $num=0;
    while($player=mysql_fetch_array($query))
    {
        $player_img[$num]=$player['name'];
	 $playerImage[$num]=$player_img[$num];
        $image=explode(" ",$playerImage[$num]);
	$player_img=array();$player_id[$num]="";
	for($j=0;$j<count($image);$j++) $player_id[$num].=$image[$j];
	
	$playerId[$num]=$player["pl_id"];
        $num++;
    }
    $playid=NULL;
    $value=0;
    $addPlayerToList.=<<<AB
	  <div id="ListPlayersImage{$DBASE_ARR[$i]["TYPE"]}Div" class="ListPlayersImageDiv">
	  

AB;
    for($j=0;$j<$num;$j++)
    {
$addPlayerToList.=<<<AB
	<div class="playerNameImg" onmouseover="displayPlayerName(this,1)" onmouseout="displayPlayerName(this,0)"style="width:100px;height:110px">
	<img src="images/loading1.gif" class="loadingImage" />
	
	<script type="text/javascript">
		var img=new Image();
		img.src="images/players/{$DBASE_ARR[$i]["DBNAME"]}/{$playerId[$j]}.jpeg";
	</script>
   <img src="images/players/{$DBASE_ARR[$i]["DBNAME"]}/{$playerId[$j]}.jpeg" style="width:100px;height:110px;cursor:move;display:none;" class="magnify1"  id="{$player_id[$j]}Div" alt="{$player_id[$j]}({$DBASE_ARR[$i]["TYPE"]})" name="loading" onmousedown="imageClicked(this)" onmouseup="imageOut(this)" onload="playerImageLoaded(this,'{$DBASE_ARR[$i]["TYPE"]}',0)"/>
	<img src="images/magnify.cur" style="width:30px;height:30px;cursor:pointer;display:none;" class="magnifyImage" onclick="playerDetails(this)"/>
	<div style="text-align:center;visibility:hidden;" class="displayPlayerNameOnImageHover">{$player_id[$j]}</div>
	</div>
AB;
	}
$addPlayerToList.=<<<AB
	
	</div>
AB;
}
$addPlayerToList.=<<<AB
	</div>
	
	
	
	
	
	
		<div id="ListPlayersClassicViewDiv">
AB;
    $i=0;
    for($i=0;$i<count($DBASE_ARR);$i++)
    	{
    	$tableName="SELECT * FROM ".$DBASE_ARR[$i]["DBNAME"];
    	$query =mysql_query($tableName,$connect);
    	 $player_img=array();
    	$image=array();
    	$player_id=array();
    	$playerId=array();
    	$num=0;
    	while($player=mysql_fetch_array($query))
    		{
      	  $player_img[$num]=$player['name'];
	 			$playerImage[$num]=$player_img[$num];
      	  $image=explode(" ",$playerImage[$num]);
				$player_img=array();$player_id[$num]="";
				for($j=0;$j<count($image);$j++) $player_id[$num].=$image[$j];
				$playerId[$num]=$player["pl_id"];
      		  $num++;
    		}
		    $playid=NULL;
   		 $value=0;
   		 $addPlayerToList.=<<<AB
	  			<div id="ListPlayersClassicView{$DBASE_ARR[$i]["TYPE"]}Div" class="ListPlayersClassicViewPlayerDetailsDiv">
	  			<table id="ListPlayersClassicView{$DBASE_ARR[$i]["TYPE"]}Table" class="ListPlayersClassicViewPlayerDetailsTable" cellspacing='0'>
	  			<tr style="positon:fixed;">
AB;
		$setValueToDisplay=3; 
		if($DBASE_ARR[$i]["COACH"]==1) $setValueToDisplay--; 
		 for($j=0;$j<$setValueToDisplay;$j++)
   	  	{
				$addPlayerToList.=<<<AB
				   <th>{$DBASE_ARR[$i]["DISPLAY"][$j]}</th>
				   	  	
   	  	
   	  	
AB;
   	  	
   	  	}
			
				$addPlayerToList.=<<<AB
				<th>SELECT TEAM</th>
	  			</tr>
	  			</table>	  				
AB;
$addPlayerToList.=<<<AB
	
	</div>
AB;
}
				$addPlayerToList.=<<<AB
				<script>
			</script>
	
AB;

$addPlayerToList.=<<<AB
	</div>
	




















	</div>
	
	<div id="confirmFinalList">
	
		 <ul type="none" class="playerTypeForFinalListUl">
AB;
	$i=0;
	for($i=0;$i<count($DBASE_ARR);$i++)
	{
	$addPlayerToList.=<<<AB
			<li class="playerTypeForFinalListLi" style="cursor:pointer;" >
					<img src="images/{$DBASE_ARR[$i]['TYPE']}2.png" alt="{$DBASE_ARR[$i]['TYPE']}" style=""/>
</li>
AB;
	
}	$addPlayerToList.=<<<AB
		</ul>

AB;
	for($i=0;$i<count($DBASE_ARR);$i++)
	{
	$addPlayerToList.=<<<AB
			
			<div id="playersFinalList{$DBASE_ARR[$i]['TYPE']}Div" class="FinalPlayerListTable">
			<table id="playersFinalList{$DBASE_ARR[$i]['TYPE']}Table" style="{border: 0;padding-left: 20px;padding-right: 20px;}"></table>
			</div>
AB;
	}
	$addPlayerToList.=<<<AB
        </div>
		<div id="chooseFinalListDiv">
				Final List
	        <div id="finalPlayerListDiv">
            <ul id="listFinalPlayerUl" type="none">
   
            </ul>
    		 </div>
		</div>	

		</div>
		
		
AB;


?>

