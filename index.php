<!DOCTYPE html>
<html>
  <head>
		<title>something</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class = "navbar">Galary</div>
		<div id = "content">
			<form method="post" action="index.php" enctype="multipart/form-data">
				<div>
					<label for="file" class="lable">
					<input type="file" id="file" name="image" accept="image/*">
					
						<i class="fa fa-cloud-upload"></i>
						
						Upload</label>
				<input class="upload" type="submit" name="upload" value="UPLOAD">

				</div>
			</form>
		</div>

		<?php
			$con = mysqli_connect("localhost", "root", "", "image");
			if(isset($_POST['upload']))
			{
				$file = $_FILES['image']['name'];

				$query = "INSERT INTO upload(image) VALUES('$file')";
				$res = mysqli_query($con,$query);

				if($res){
					move_uploaded_file($_FILES['image']['tmp_name'],"$file");
				}
				$sel = "SELECT * FROM upload";
				$que = mysqli_query($con, $sel);

				$output = "";
				if(mysqli_num_rows($que) < 1)
				{
					$output .= "<h3>No image Uploaded</h3>";
				}
				else{
						while($row = mysqli_fetch_array($que))
						{

							$output = "<div class='column'><img class='preview-image' src='".$row['image']."'></div>" . $output;
						}
				}
					echo "<div class='row'>" . $output ."</div>";
			}
		?> 
		<footer>		
			<div class = "navbar">FULLSTACK CHALLENGE - 2020</div>
		</footer>
	</body>
<html>