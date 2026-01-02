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
    $email = $_POST["email"];

    $sql = "INSERT INTO notification (email) VALUES ('$email')";
    if (empty($email)) {
        // Redirect with error message if any field is empty
        $_SESSION['message'] = "Please Enter email";
        header("Location: /tas/index.html");
        exit();
    }
    if ($conn->query($sql) === TRUE) {
        // Successful booking
        echo "Registered created successfully";

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