<?php
// Connection to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "print_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
// Function to find the next available printer
function findNextAvailablePrinter()
{
    global $conn;

    // Find the next available printer
    $sql = "SELECT id FROM printers WHERE status = 0 ORDER BY id LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id"];
    } else {
        // If no available printers, return a default value or handle the case accordingly
        return 0;
    }
}

// Function to check printer availability
function checkPrinterAvailability($printerId, $startTime, $endTime)
{
    global $conn;

    $sql = "SELECT COUNT(*) as count FROM reservations 
            WHERE printer_id = $printerId
            AND ((start_time <= '$startTime' AND end_time >= '$startTime') 
            OR (start_time <= '$endTime' AND end_time >= '$endTime'))";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    return $row['count'] == 0;
}

// Function to reserve printer
function reservePrinter($printerId, $startTime, $hours, $userName)
{
    global $conn;

    // Add hours and 30 minutes to calculate end time
    $endTime = date('Y-m-d H:i:s', strtotime("$startTime + $hours hours + 30 minutes"));

    $sql = "INSERT INTO reservations (printer_id, start_time, end_time, user_name) 
            VALUES ($printerId, '$startTime', '$endTime', '$userName')";

    if ($conn->query($sql) === TRUE) {
        echo "Printer reserved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Main reservation logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $startTime = $_POST["start_time"];
    $hours = $_POST["hours"];
    $userName = $_POST["user_name"];

    // Find the next available printer
    $printerId = findNextAvailablePrinter();

    if ($printerId != 0) {
        // Check printer availability
        $sql = "SELECT end_time FROM reservations WHERE printer_id = $printerId ORDER BY end_time DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastEndTime = $row["end_time"];

            // Check if there is enough time gap
            $startTime = max($startTime, $lastEndTime);
            reservePrinter($printerId, $startTime, $hours, $userName);
        } else {
            // If no previous reservations, reserve immediately
            reservePrinter($printerId, $startTime, $hours, $userName);
        }
    } else {
        echo "No available printers.";
    }
}

// Display printers and reservation form
$sql = "SELECT * FROM printers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Printer Reservation System</title>
</head>

<body>
    <h2>Printer Reservation System</h2>
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <!-- ใส่ค่าเริ่มต้นที่ได้จาก PHP เป็น value ในฟอร์ม -->
        <label for="start_time">Start Time:</label>
        <input type="datetime-local" name="start_time" required><br>
        <label for="hours">Number of Hours:</label>
        <input type="number" name="hours" min="1" required><br>
        <label for="user_name">Your Name:</label>
        <input type="text" name="user_name" required><br>
        <input type="submit" value="Reserve Printer">
    </form>
</body>

</html>

<?php
$conn->close();
?>
