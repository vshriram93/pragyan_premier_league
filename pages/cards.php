<?php
	if(isset($_FILES["file"]["name"]))
		{
	 	 if ($_FILES["file"]["error"] > 0)
   		 {
    			echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    	 	 }
  	  	 else
    		 {
    			if(!(is_dir("images/")))
    				{
    					exec("mkdir images/");
			    		if(!(is_dir("images/players"))) exec("images/uploads");
					}
    			if (file_exists("upload/" . $_FILES["file"]["name"]))
      			{
      				echo $_FILES["file"]["name"] . " already exists. ";
      			}
    			else 
      			{
      				move_uploaded_file($_FILES["file"]["tmp_name"],"" . $_FILES["file"]["name"]);
      				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      			}
			}
		}d
	else {
	$cardDetails=<<<AB
		<div id="cardDetailsId">
			<form action="./cards.php" method="post" enctype="multipart/form-data">
				<label for="file">Filename:</label>
				<input type="file" name="playerImage" id="file" />
				<br />
				<input type="submit" name="submit" value="Submit" />
			</form>

	</div>
AB;
	
	echo $cardDetails;
	}
?>
