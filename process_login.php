<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember = isset($_POST["remember"]) ? true : false;

    // Perform authentication logic here (validate against database, for example)

    // Set session variables
    $_SESSION["username"] = $username;
    $_SESSION["remember"] = $remember;

    // Redirect to the second page
    header("Location: questions_page.html");
    exit();
}
?>
