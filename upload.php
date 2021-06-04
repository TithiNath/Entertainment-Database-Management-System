<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>

 <link rel="stylesheet" href="./search.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	   
</head>
<body>  

    <div id="fixed-header">
            <div class="in-bg"></div>
             <section class="container" id="con-width">
                <input class="light-table-filter" data-table="order-table" placeholder="Search by artist,year......." type="text">
                <table class="order-table">
	    <thread>
		   <th>MOVIE</th>
		   <th>ACTOR</th>
		   <th>MOVIE DESCRIPTION</th>
		   <th>YEAR</th>
		   <th>POSTER</th>
		   <th>TRAILER</th>
		</thread>
		
	    <tbody>
		<?php
		
		$con = mysqli_connect('localhost','root','','flick');
        
		
		  if (isset($_POST['submit'])) {
			  echo "<br>";
			  echo "<br>";
			  
			$movie = $_POST['movie'];  
			 print_r($movie);
			 echo "<br>";
			
			$rating = $_POST['rating'];
            print_r($rating);
			 echo "<br>";
			 
			$url = $_POST['url']; 
			 print_r($url);
			 echo "<br>";
			 
			 $description = $_POST['description']; 
			 print_r($description);
			 echo "<br>";
			
			$year = $_POST['year']; 
			 print_r($year);
			 echo "<br>";
			 
			 $genre = $_POST['genre'];  
			 print_r($genre);
			 echo "<br>";
			 
			$actor = $_POST['actor'];  
			 print_r($actor);
			 echo "<br>";
			 
			$gender = $_POST['gender'];  
			 print_r($gender);
			 echo "<br>";
			 
			 $age = $_POST['age'];  
			 print_r($age);
			 echo "<br>";
			 
			 $director = $_POST['director']; 
			 print_r($director);
			 echo "<br>";
		    
			
			$files = $_FILES['file'];
			 
			 print_r($files);
			
			  $filename = $files['name'];
			  $filerror = $files['error'];
			  $filetmp = $files['tmp_name'];
			  
			  $target = 'upload/'.$filename;
			  
			  
			   
                $sa = "INSERT INTO actors( actor,gender,age) VALUES ('$actor','$gender','$age')";				
				       
				$sa =  mysqli_query($con,$sa);
				
				 $qt = "INSERT INTO genre (genre) VALUES ('$genre')";
			   
		         $queryt =  mysqli_query($con,$qt);
				 
				 
				  $d = "INSERT INTO director (director_name) VALUES ('$director')";
			   
		         $dr =  mysqli_query($con,$d);
				 
				 
				  $qrty = "INSERT INTO mov_review(description,year,poster,genre_id,actor_id) VALUES  ('$description','$year','$target',(select genre_id from genre where genre ='$genre'),
				 (select actor_id from actors where actor='$actor'))";
			  
			      $qet =  mysqli_query($con,$qrty);
				 
                 $rty = "INSERT INTO movie ( movie_name,rating,url,movie_review_id,director_id) VALUES ('$movie','$rating','$url',
				 (select movie_review_id from mov_review where description='$description'),(select director_id from director where director_name ='$director'))";
				 
				 $wow =  mysqli_query($con,$rty);
			       
			  
			   
			
			   $msg = "";
		
			  
			  
			  
			  
			  if (move_uploaded_file($filetmp,$target))
			     {
				  $msg = "Image uploaded successfully";
                   	}else{
  		              $msg = "Failed to upload image";
  	                      }
		  
				     
			           $row = mysqli_query($con,"Select m.movie_name,a.actor,r.description,r.year,r.poster,m.url from movie m inner join  mov_review r 
					     on m.movie_review_id = r.movie_review_id inner join actors a on a.actor_id = r.actor_id ");
						 
			                /*if (!$check1_res) {
                               printf("Error: %s\n", mysqli_error($con));
                                exit();
                                 }*/
				       
					  
					   
				       while($result = mysqli_fetch_array($row)){
						   
						    ?>
				
				            <tr>
							<td> <?php echo $result['movie_name']; ?> </td>
							<td> <?php echo $result['actor']; ?> </td>
				            <td> <?php echo $result['description']; ?> </td>
					        <td> <?php echo $result['year']; ?> </td>
		                    <td> <img src=" <?php echo $result['poster']; ?>"></td>
							<td> <?php echo $result['url']; ?> </td>
				            </tr>
                      				  
				             <?php
					   }
							 
				}
		?>
		</tbody>
	   
	    </table>
		
		</table>
		</section>
        </div>
		
       </div>
   <script src="./search.js"></script>
   
</body>
</html>


		
          




