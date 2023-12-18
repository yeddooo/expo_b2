<?php include 'main_book.php'?>
<?php
    $name = $_POST['firstname'];
    $student_id = $_POST['student_id'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];

    $sql = "INSERT INTO user(`username`, `student_ID`, `date`, `hour`) VALUES ('$name',' $student_id ',' $date','$hour')" ;
    try {
        $conn->exec($sql);
        echo "บันทึกข้อมูลเรียบร้อย";
    } catch (PDOException $e) {
        echo "ผิดพลาด: " . $e->getMessage();
    }
?>