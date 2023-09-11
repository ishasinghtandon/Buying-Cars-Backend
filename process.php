<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $carOptions = implode(", ", $_POST["carOptions"]);

    // Database connection
    include("includes/db_connection.php");

    // Insert data into the database
    $sql = "INSERT INTO customer_responses (name, phone, email, address, car_options) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $phone, $email, $address, $carOptions);

    if ($stmt->execute()) {
        // Data inserted successfully
        header("Location: index.php?success=1");
        exit();
    } else {
        // Error occurred
        header("Location: index.php?error=1");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
