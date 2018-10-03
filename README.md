# uploadimagephp
Simple PHP image upload, resize and rename. (GIF, PNG, JPG)

Demo http://facundoq.site/uploadimagephp/

1. import the createdb.sql file into phpmyadmin. this file creates a simple database to save the image path. In dbconfig.php you have to configure database details.

2. In index.php is the form that sends the image to the server and displays the uploaded images.

3. The most important file is upload.php where we receive the file, adjust the size, generate a new name for the file, upload the file to server and save the path in the database. 

