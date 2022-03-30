<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/phpmailer/index.php';

$_POST = json_decode(file_get_contents('php://input'), true);


if (isset($_GET['feedback'])) {
    $text = $_POST['text'];
    $from = $_POST['email'];
    $subject = "Feedback";

    echo (sendEmail($from, $subject, $text));
    ///
}
