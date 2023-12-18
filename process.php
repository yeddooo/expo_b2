<?php
// Connect to MySQL (assuming XAMPP default credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "printer_kuy";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
$user_name = $_POST['user_name'];
$start_time = $_POST['start_time'];
$hours = $_POST['hours'];  

// Calculate end_time
$end_time = date('H:i', strtotime("$start_time + $hours hours"));

// Insert data into the 'user' table
$user_sql = "INSERT INTO user (user_name, start_time, hours, end_time, printer_number) VALUES ('$user_name', '$start_time', $hours, '$end_time', 1)";
if ($conn->query($user_sql) === TRUE) {
    echo "User Record added successfully";

    // Retrieve the user_id
    $user_id = $conn->insert_id;

    // Check if any printer is available
    $check_available_printers_sql = "SELECT COUNT(*) AS available_printers FROM print_queue WHERE status = 0";
    $result_check_available = $conn->query($check_available_printers_sql);
    $row_check_available = $result_check_available->fetch_assoc();
    $available_printers = $row_check_available['available_printers'];

    if ($available_printers > 0) {
        // Find the first available printer
        $available_printer_sql = "SELECT printer_number FROM print_queue WHERE status = 0 LIMIT 1";
        $result = $conn->query($available_printer_sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $available_printer = $row['printer_number'];

            // Update the end_time and status of the selected printer
            $update_printer_time_sql = "UPDATE print_queue SET end_time = '$end_time', status = 1 WHERE printer_number = $available_printer";
            $conn->query($update_printer_time_sql);

            // Insert data into the 'print_queue' table
            $print_queue_sql = "INSERT INTO print_queue (user_id, user_name, start_time, hours, end_time, printer_number, status) VALUES ($user_id, '$user_name', '$start_time', $hours, '$end_time', $available_printer, 1)";
            if ($conn->query($print_queue_sql) === TRUE) {
                echo "<br>Print Queue Record added successfully";
            } else {
                echo "<br>Error: " . $print_queue_sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "<br>No available printers.";
    }
} else {
    echo "<br>Error: " . $user_sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
