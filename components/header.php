<?php
$netProtocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$i18n = require "utils/locale/index.php";
$t = $i18n["language"];
?>

<!DOCTYPE html>
<html lang="<?= $i18n["selectedLanguage"] ?>">

<head>
    <title><?= isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['title'] ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?= $meta_description ?? $t['meta_description'] ?>">
    <meta name="keywords" content="<?= $meta_keywords ?? $t['meta_keywords'] ?>">
    <link rel="icon" type="image/png" href="<?= $icon ?? 'img/fav.png' ?>">



    <!-- social media -->
    <meta property="og:title" content="<?= isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['title'] ?>" />
    <meta property="og:site_name" content="<?= isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['title'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta property="og:image" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]/" . ($meta_social_img ?? 'img/social_img.png') ?>" />
    <meta property="og:url" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
    <meta name="twitter:title" content="<?= isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['title'] ?>" />
    <meta name="twitter:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@www.<?= "$_SERVER[HTTP_HOST]" ?>" />
    <meta name="twitter:image" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]/" . ($meta_social_img ?? 'img/social_img.png') ?>" />



    <!-- CSS -->
    <link rel="stylesheet" href="css/fonts/fonts.css">
    <link rel="stylesheet" href="css/global.css">

    <!-- PWA -->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#2d3748" />
    <link rel="apple-touch-icon" href="img/fav.png">


    <!-- SCRIPTS -->
    <!-- https://vuejsexamples.com/petite-vue-6kb-subset-of-vue-optimized-for-progressive-enhancement/  petit vue tutorial -->
    <script src="script/petite-vue.js" defer init></script>
    <script src="https://nkatanasov.com/analitics/analitics.js" defer></script>
    <script src="script/main.js" defer></script>

</head>

<body>