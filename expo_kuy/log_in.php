<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'login_db';

try {
  $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>check are you cpe student?</h1>
    <form action="testlogin.php" method="post">   
        First name:<br>
        <input type="text" name="firstname" id="name"><br>
        student ID:<br>
        <input type="text" name="student_id" id="id" ><br>
        Gamil:<br>
        <input type="text" name="gmail" id="gmailz" ><br>
        <input type="submit" value="submit">
      </form>
</body>
</html>  