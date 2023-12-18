<?php
include '';

$name = $_POST['firstname'];
$student_id = $_POST['student_id'];
$gmail = $_POST['gmail'];

// ตรวจสอบว่า id อยู่ในช่วง 1-10 หรือไม่
if ($student_id >= 66070501000 && $student_id <= 66070501060) {
    $sql = "INSERT INTO `login`(`name`, `id`, `email`) VALUES ('$name', '$student_id', '$gmail')";

    try {
        $conn->exec($sql);
        echo "เข้าสู่ระบบเรียบร้อย";
    } catch (PDOException $e) {
        echo "ผิดพลาด: " . $e->getMessage();
    }
} else {
    echo "คุณไม่ใช่ cpe !";
}
?>

