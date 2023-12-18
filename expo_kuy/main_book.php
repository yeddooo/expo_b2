<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'exploraion_database';

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
    <h1>hello</h1>
    <form action="process.php" method="post">   
        First name:<br>
        <input type="text" name="firstname" id="name" onchange="selectNamey()"><br>
        student ID:<br>
        <input type="text" name="student_id" id="id" onchange="selectID()" ><br>
        <input type="date" name="date" id="birthday" onchange="selectBirthday()"><br>
        hour:<br>
        <input type="text" name="hour" id="hour" onchange="selectID()" ><br>
        <input type="submit" value="submit">
        <a href="Logout.php" class="logout">Logout</a>
        <div id="result"></div>
        <div id="result1"></div>
        <div id="result2"></div>
      </form>
</body>
<script>
    function selectBirthday() {
        var birthday = document.getElementById("birthday").value;
        document.getElementById("result").innerHTML = "วัน เดือน ปีเกิด คือ "+birthday;
    }
    function selectNamey(){
        var name  = document.getElementById("name").value;
        document.getElementById("result1").innerHTML = "วัน เดือน ปีเกิด คือ "+name;
    }
    function selectID(){
        var id = document.getElementById("id").value;
        document.getElementById("result2").innerHTML = "วัน เดือน ปีเกิด คือ "+id;
    }
</script>
</html>  