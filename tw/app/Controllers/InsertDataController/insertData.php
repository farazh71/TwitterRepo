<?php
function insertData($conn, $data)
{
    $name = $data['name'];
    $phone_or_email = $data['phone_or_email'];
    $username = $data['userName'];
    $password = $data['password'];
    $dob = $data['dob'];
    if (strpos($phone_or_email, '@') !== false) {
        $email = $phone_or_email;
        $phone = null;
    } else {
        $phone = $phone_or_email;
        $email = null;
    }
    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO twitterDB (username, email, password, dob, name, phone) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssss", $username, $email, $password, $dob, $name, $phone);

    // Execute query
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
// Here, $conn is the connection object that you have with your database
if (insertData($conn, $data)) {
    echo "Data inserted successfully";
} else {
    echo "Unable to insert data";
}
