<?php
$availableLangs = ["en", "fr"];
$selectedLang = $_GET['t'] ?? $_COOKIE['t'] ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) ?? 'en';


$isLegal = in_array($selectedLang, $availableLangs);
!$isLegal && ($selectedLang = 'en');


if (!$isLegal || isset($_GET['t']) || !isset($_COOKIE['t'])) {
    setcookie('t', $selectedLang, time() + (86400 * 30), "/"); // 86400 = 1 day
}


$lang = require("langs/en.php");
if ($selectedLang != "en") {
    $tempLang = require("langs/{$selectedLang}.php");
    $tempKeys = array_keys($tempLang);
    foreach ($lang as $key => $value) {
        !in_array($key, $tempKeys) && $tempLang[$key] = $value;
    }
    $lang = $tempLang;
}


return [
    "language" => $lang,
    "availableLanguages" => $availableLangs,
    "selectedLanguage" => $selectedLang
];
