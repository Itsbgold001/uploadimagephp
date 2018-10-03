<html>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image"/>
    <button type="submit">Upload</button>
    </form>
    
    <?php 
    require_once('dbconfig.php');
    
    $sql =mysqli_query($con, "SELECT * FROM images;");

    while($row=mysqli_fetch_array($sql)) {
    $img = $row['img'];    
    echo "<div align='center'><img src='$img'></div>";
    }
    ?>
</body>
</html>