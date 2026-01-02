<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $service = $_POST["service"];
    $serviceDate = $_POST["service_date"];
    $specialRequest = $_POST["special_request"];

    // SQL query to insert data into the 'users' table
    $sql = "INSERT INTO users (name, email, service, serviceDate, spRequest)
            VALUES ('$name', '$email', '$service', '$serviceDate', '$specialRequest')";

    if (empty($name) || empty($email) || empty($service) || empty($serviceDate)) {
        // Redirect with error message if any field is empty
        $_SESSION['message'] = "Please fill up the form completely";
        header("Location: /tas/index.html");
        exit();
    }
    if ($conn->query($sql) === TRUE) {
        // Successful booking
        echo "New record created successfully";

        // Redirect back to the form page after a delay
        echo "<script>
                setTimeout(function() {
                    window.location.href = '/tas/index.html';
                }, 3000); // 3000 milliseconds (3 seconds) delay before redirect
            </script>";

        // Display a popup
        echo "<script>
                setTimeout(function() {
                    alert('Booking successful!');
                }, 500); // 500 milliseconds delay before displaying the popup
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
