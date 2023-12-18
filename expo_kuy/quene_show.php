<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quenes</title>
</head>
<body>
    <h1>this is quenese</h1>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quenese</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }   
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<?php
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "exploraion_database";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // ดึงข้อมูลทั้งหมดจากตารางในฐานข้อมูล
        $sql = "SELECT * FROM user"; // แทน your_table_name ด้วยชื่อตารางที่ต้องการดึงข้อมูล
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>student ID</th><th>username</th><th>date</th><th>hour</th></tr>";

            // วนลูปแสดงข้อมูล
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . $row['student_ID'] . "</td><td>" . $row['username'] . "</td><td>" . $row['date'] . "</td><td>". $row['hour'] . "</td></tr>";
            }

            echo "</table>";  
        } else {
            echo "ไม่พบข้อมูล";
        }
    } catch (PDOException $e) {
        echo "ผิดพลาด: " . $e->getMessage();
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn = null;
?>

</body>
</html>

</body>
</html>