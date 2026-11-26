<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/phpmailer/index.php';

$_POST = json_decode(file_get_contents('php://input'), true) ?? [];


if (isset($_GET['feedback'])) {
    session_start();
    $text = trim($_POST['text'] ?? '');
    $from = trim($_POST['email'] ?? '');
    $subject = "Feedback";

    if (!empty($_POST['website'])) exit('success'); // honeypot filled -> bot, pretend it worked
    if (!filter_var($from, FILTER_VALIDATE_EMAIL) || $text === '') exit('Please enter a valid email and a message.');
    if (time() - ($_SESSION['lastFeedback'] ?? 0) < 60) exit('Please wait a minute before sending again.');
    $_SESSION['lastFeedback'] = time();

    echo (sendEmail($from, $subject, $text));
    ///
}
