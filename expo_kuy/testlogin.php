<?php
    include 'log_in.php'; // เชื่อมต่อฐานข้อมูล
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $student_id = $_POST['student_id'];
        $name = $_POST['firstname']; // เพิ่มบรรทัดนี้
        $gmail = $_POST['gmail'];

        if ($student_id >= 66070501000 && $student_id <= 66070501060) {
            $sql = "INSERT INTO `login`(`name`, `id`, `email`) VALUES ('$name', '$student_id', '$gmail')";
        
            try {
                $conn->exec($sql);
                echo "เข้าสู่ระบบเรียบร้อย";
                header("Location: main_book.php");
                exit();
            } catch (PDOException $e) {
                echo "ผิดพลาด: " . $e->getMessage();
            }
        } 
        if ($student_id >= 66070501099) {
            $sql = "INSERT INTO `login`(`name`, `id`, `email`) VALUES ('$name', '$student_id', '$gmail')";
        
            try {
                $conn->exec($sql);
                echo "เข้าสู่ระบบเรียบร้อย";
                header("Location: admin_login.php");
                exit();
            } catch (PDOException $e) {
                echo "ผิดพลาด: " . $e->getMessage();
            }
        } else {
            echo "คุณไม่ใช่ cpe !";
        }
    }
 ?>