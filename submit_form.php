<?php

$message = $_POST["message"];
$email = $_POST["email"];
$privacyCheckbox = filter_input(INPUT_POST, "privacyCheckbox", FILTER_VALIDATE_BOOL);

// Check if all three fields are empty
if (empty($email) && empty($message) && !$privacyCheckbox) {
    die("Please fill out all fields and accept the terms of the privacy policy");
}

if (empty($email) && empty($message)) {
    die("Please fill out all fields and accept the terms of the privacy policy");
}

// Check if privacy checkbox is checked
if ( ! $privacyCheckbox) {
    die("Please accept the terms of the privacy policy");
}

// Validate email
if (empty($email)) {
    die("Please enter your email address");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Validate message
if (empty($message)) {
    die("Please enter a message.");
}

// to add server side validation checks for security (javascript) - future work
// client-side validation is not sufficient for security, as it can be bypassed.

//connect to database
$host = "localhost";
$dbname = "message_db";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_errno());
}

//echo "Connection successful.";

//avoid sql injection attack --> use prepared statement
$sql = "INSERT INTO request (message, email)
        VALUES(?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ss", $message, $email);

mysqli_stmt_execute($stmt);

echo "Record saved successfully."

?>