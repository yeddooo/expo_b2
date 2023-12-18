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
    $printerId = $_POST["printer"];
    $startTime = $_POST["start_time"];
    $hours = $_POST["hours"];
    $userName = $_POST["user_name"];

    // Find the next available printer
    $sql = "SELECT id FROM printers WHERE status = 0 ORDER BY id LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $printerId = $row["id"];

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
