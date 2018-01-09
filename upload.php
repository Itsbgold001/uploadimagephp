<?php 
 
//importing dbconfig file 
require_once 'dbconfig.php';
 
//this is our upload folder 
$upload_folder = 'img/';        
 
if($_SERVER['REQUEST_METHOD']=='POST'){
 
//checking the required parameters from the request 
if(isset($_FILES['image']['name'])){
  
    //getting file info from the request 
    $fileinfo = pathinfo($_FILES['image']['name']);
 
    //getting the file extension 
    $extension = $fileinfo['extension'];

    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
 	    {
            echo 'Unknown image format';
 		    $errors=1;
        }

    //jpg-jpeg     
    if($extension=="jpg" || $extension=="jpeg" )
        {
            $uploadedfile = $_FILES['image']['tmp_name'];
            $src = imagecreatefromjpeg($uploadedfile);
            list($width,$height)=getimagesize($uploadedfile);
            
            //set the width for adjustment
            $newwidth=350;
            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
                
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
        
            //random filename
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
                
            $filename = $upload_folder. $newfilename;
                    
            imagejpeg($tmp,$filename,100);
        
            imagedestroy($src);
            imagedestroy($tmp);

            //insert db
            $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ($filename);");
    }

    //png
    else if($extension=="png")
        {
            $uploadedfile = $_FILES['image']['tmp_name'];
            $src = imagecreatefrompng($uploadedfile);
            list($width,$height)=getimagesize($uploadedfile);

            //set the width for adjustment            
            $newwidth=350;
            $newheight=($height/$width)*$newwidth;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
                
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
           
            //random filename        
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
                
            $filename = $upload_folder. $newfilename;
                    
            imagejpeg($tmp,$filename,100);
        
            imagedestroy($src);
            imagedestroy($tmp);
            
            //insert db
            $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ($filename);");
    }    
    //gif
    else
        {
            $uploadedfile=$_FILES['image']['tmp_name'];
            //random filename
            $temp = explode(".", $_FILES["image"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
                
            $filename = $upload_folder. $newfilename;

            move_uploaded_file($uploadedfile,$upload_folder."/".$newfilename);

            //insert db
            $insert=mysqli_query($con, "INSERT INTO images (img) VALUES ($filename);");
        }
}
}