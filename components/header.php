<?php
$netProtocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$i18n = require "utils/locale/index.php";
$t = $i18n["language"];
$pageTitle = (isset($meta_title) ? $meta_title : $t['myName']) . " | " . $t['title'];
$siteUrl = 'https://portfolio.metatronprime.com';
$socialImg = "$siteUrl/" . ($meta_social_img ?? 'items/img/bg_1.jpg');

// SEO: one clean URL per language ("/" = en, "/?t=fr" = fr)
$path = strtok($_SERVER['REQUEST_URI'], '?');
$langUrl = fn($l) => $siteUrl . $path . ($l == 'en' ? '' : "?t=$l");
$canonical = $langUrl($i18n["selectedLanguage"]);

// JSON-LD: projects = titled Dev items from items.json
$projects = [];
foreach (json_decode(file_get_contents(__DIR__ . '/../items/items.json'), true) as $item) {
    if (($item['category'] ?? '') != 'Dev' || empty($item['title'])) continue;
    preg_match('/href="([^"]+)"/', $item['description'] ?? '', $link);
    $projects[] = array_filter([
        "@type" => "ListItem",
        "position" => count($projects) + 1,
        "item" => array_filter([
            "@type" => "CreativeWork",
            "name" => html_entity_decode($item['title'], ENT_QUOTES | ENT_HTML5),
            "url" => $link[1] ?? null,
            "image" => $siteUrl . $item['img'],
            "description" => trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(preg_replace('/<a .*?<\/a>|<br\s*\/?>/', ' ', $item['description'] ?? '')), ENT_QUOTES | ENT_HTML5))),
        ]),
    ]);
}
$jsonLd = [
    "@context" => "https://schema.org",
    "@graph" => [
        [
            "@type" => "Person",
            "@id" => "$siteUrl/#person",
            "name" => "Nik Atanasov",
            "url" => "$siteUrl/",
            "image" => "$siteUrl/img/avatar.png",
            "jobTitle" => "Full-stack Developer",
            "email" => "mailto:nka212bg@gmail.com",
            "address" => ["@type" => "PostalAddress", "addressLocality" => "Montreal", "addressRegion" => "QC", "addressCountry" => "CA"],
            "knowsAbout" => ["JavaScript", "Vue.js", "Node.js", "Electron", "Capacitor", "PHP", "Java", "SQL", "UI/UX design", "Graphic design", "3D modeling"],
            "sameAs" => ["https://www.linkedin.com/in/metatronprime/", "https://github.com/nka212bg", "https://gitlab.com/nka212bg"],
        ],
        [
            "@type" => "WebSite",
            "@id" => "$siteUrl/#website",
            "url" => "$siteUrl/",
            "name" => "Nik Atanasov Portfolio",
            "inLanguage" => $i18n["availableLanguages"],
            "publisher" => ["@id" => "$siteUrl/#person"],
        ],
        [
            "@type" => "ItemList",
            "@id" => "$siteUrl/#projects",
            "name" => "Featured Projects",
            "itemListElement" => $projects,
        ],
    ],
];
?>

<!DOCTYPE html>
<html lang="<?= $i18n["selectedLanguage"] ?>" style='background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.9)), url("/items/img/bg_<?= rand(1, 8) ?>.jpg");'>

<head>
    <title><?= $pageTitle ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?= $meta_description ?? $t['meta_description'] ?>">
    <meta name="keywords" content="<?= $meta_keywords ?? $t['meta_keywords'] ?>">
    <link rel="icon" type="image/svg+xml" href="<?= $icon ?? 'img/logo.svg' ?>">
    <link rel="canonical" href="<?= $canonical ?>">
    <?php foreach ($i18n["availableLanguages"] as $l): ?>
    <link rel="alternate" hreflang="<?= $l ?>" href="<?= $langUrl($l) ?>">
    <?php endforeach ?>
    <link rel="alternate" hreflang="x-default" href="<?= $langUrl('en') ?>">



    <!-- social media -->
    <meta property="og:title" content="<?= $pageTitle ?>" />
    <meta property="og:site_name" content="<?= $pageTitle ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta property="og:image" content="<?= $socialImg ?>" />
    <meta property="og:url" content="<?= $canonical ?>" />
    <meta property="og:locale" content="<?= $i18n["selectedLanguage"] ?>_CA" />
    <meta name="twitter:title" content="<?= $pageTitle ?>" />
    <meta name="twitter:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="<?= $socialImg ?>" />



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

    <script src="script/main.js"></script>
    <script src="https://portfolio.metatronprime.com/analitics/analitics.js" async></script>
    <script src="https://chat.oceandiv.com/chat-api/frame?id=1&dark&hue=205" async></script>

    <!-- Schema.org JSON-LD markup -->
    <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

</head>

<body>