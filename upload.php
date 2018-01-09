<?php 
 
 //importing dbDetails file 
 require_once 'dbconfig.php';
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 //checking the required parameters from the request 
 if(isset($_FILES['image']['name'])){
 
 
 //getting file info from the request 
 $fileinfo = pathinfo($_FILES['image']['name']);
 
 //getting the file extension 
 $extension = $fileinfo['extension'];
 

 if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
 	{
        echo 'Unknown image format.';
    }

//jpg-jpeg     
if($extension=="jpg" || $extension=="jpeg" )
    {
        $uploadedfile = $_FILES['image']['tmp_name'];
        $src = imagecreatefromjpeg($uploadedfile);
        list($width,$height)=getimagesize($uploadedfile);
        
        //set new width
        $newwidth1=350;
        $newheight1=($height/$width)*$newwidth1;
        $tmp1=imagecreatetruecolor($newwidth1,$newheight1);
                
        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

        //new random name        
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
                
        $filename1 = "img/". $newfilename;
                    
        imagejpeg($tmp1,$filename1,100);
        
        imagedestroy($src);
        imagedestroy($tmp1);
        //insert in database
        $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ('$filename1');");

        echo "<html>
		<head>
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=index.php'>
			<script>
				alert('The image has been uploaded .');
			</script>
		</body>
        </html>";
    }

//png
    else if($extension=="png")
    {
        $uploadedfile = $_FILES['image']['tmp_name'];
        $src = imagecreatefrompng($uploadedfile);
        list($width,$height)=getimagesize($uploadedfile);

        //set new width            
        $newwidth1=350;
        $newheight1=($height/$width)*$newwidth1;
        $tmp1=imagecreatetruecolor($newwidth1,$newheight1);
                
        imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);
        
        //new random name
        $temp = explode(".", $_FILES["image"]["name"]);
        $newfilename = round(microtime(true)) . '.' . end($temp);
                
        $filename1 = "img/". $newfilename;
                    
        imagejpeg($tmp1,$filename1,100);
        
        imagedestroy($src);
        imagedestroy($tmp1);

        //insert in database
        $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ('$filename1');");

        echo "<html>
		<head>
		</head>
		<body>
			<meta http-equiv='REFRESH' content='0 ; url=index.php'>
			<script>
				alert('The image has been uploaded .');
			</script>
		</body>
        </html>";    
    }    
    else if($extension=="gif") {
    $uploadedfile = $_FILES['image']['tmp_name'];
    
    //new random name

    $temp = explode(".", $_FILES["image"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
                
    $filename1 = "img/". $newfilename;

	move_uploaded_file($uploadedfile,$filename1);

    //insert in database
    $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ('$filename1');");
    

    echo "<html>
    <head>
    </head>
    <body>
        <meta http-equiv='REFRESH' content='0 ; url=index.php'>
        <script>
            alert('The image has been uploaded .');
        </script>
    </body>
    </html>";
    }
    else    
    {
        echo 'error';
    }

}
}

