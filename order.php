<?php
$HOST = 'localhost';
$USER = 'oleksandr188';
$PASS = 'S78345678sd';
$DB = 'oleksandr188';
$conn = mysqli_connect($HOST,$USER,$PASS,$DB);
mysqli_set_charset($conn,"utf8");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Отримуємо дані з форми
$fullName = $_POST['fullName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$shippingMethod = $_POST['shippingMethod'];
$branch = $_POST['branch'];

// Захищаємо дані від SQL-ін'єкцій
$fullName = mysqli_real_escape_string($conn, $fullName);
$phone = mysqli_real_escape_string($conn, $phone);
$email = mysqli_real_escape_string($conn, $email);
$shippingMethod = mysqli_real_escape_string($conn, $shippingMethod);
$branch = mysqli_real_escape_string($conn, $branch);

// Отримуємо поточну дату
$currentDate = date("Y-m-d");

// Записуємо дані у базу даних разом з поточною датою
$sql = "INSERT INTO registrations (fullName, phone, email, shippingMethod, branch, created_at) 
        VALUES ('$fullName', '$phone', '$email', '$shippingMethod', '$branch', '$currentDate')";

if ($conn->query($sql) === TRUE) {
        // Після успішного запису перенаправляємо на головну сторінку
        header("Location: Moto.html");
        exit(); // Завершуємо виконання скрипта
    } else {
        echo "Помилка: " . $sql . "<br>" . $conn->error;
    }}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT img FROM images ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row["img"];
} else {
    echo "img/anim8.jpeg";
}

$conn->close();
?>
