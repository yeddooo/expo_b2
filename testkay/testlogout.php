<?php
session_start(); // เริ่มต้น session

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    header("Location: log_in.php"); // ถ้าไม่ได้ล็อกอินให้ redirect ไปยังหน้า login
    exit();
}

// ดึง user_id จาก session
$user_id = $_SESSION['user_id'];

// สร้าง connection ไปยังฐ
include 'testlog_in.php';

// สร้าง query สำหรับลบข้อมูลผู้ใช้
$sql = "DELETE FROM log_in WHERE id = $student_id, name =  $id,email =  $email";

try {
// Execute query
$conn->query($sql);
// ลบ session หรือ token
session_unset();
session_destroy();

// Redirect ไปยังหน้า login หรือหน้าหลัก
header("Location: testlogin.php"); // หรือหน้าหลัก
exit();
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}
?>