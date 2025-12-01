<?php
$netProtocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$i18n = require "utils/locale/index.php";
$t = $i18n["language"];
?>

<!DOCTYPE html>
<html lang="<?= $i18n["selectedLanguage"] ?>" style='background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.9)), url("/items/img/bg_<?= rand(1, 8) ?>.jpg");'>

<head>
    <title><?= (isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['myName'] . " | " . $t['title']) . " | " .  date("Y m") ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="<?= $meta_description ?? $t['meta_description'] ?>">
    <meta name="keywords" content="<?= $meta_keywords ?? $t['meta_keywords'] ?>">
    <link rel="icon" type="image/svg+xml" href="<?= $icon ?? 'img/logo.svg' ?>">



    <!-- social media -->
    <meta property="og:title" content="<?= (isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['myName'] . " | " . $t['title'])  . " | " .  date("Y m") ?>" />
    <meta property="og:site_name" content="<?= (isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['myName'] . " | " . $t['title']) . " | " .  date("Y m") ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta property="og:image" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]/" . ($meta_social_img ?? 'items/img/bg_' . rand(1, 8) . '.jpg') ?>" />
    <meta property="og:url" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" />
    <meta name="twitter:title" content="<?= (isset($meta_title) ? $meta_title . " | " . $t['title']  : $t['myName'] . " | " . $t['title']) . " | " .  date("Y m") ?>" />
    <meta name="twitter:description" content="<?= $meta_description ?? $t['meta_description'] ?>" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@www.<?= "$_SERVER[HTTP_HOST]" ?>" />
    <meta name="twitter:image" content="<?= "$netProtocol://$_SERVER[HTTP_HOST]/" . ($meta_social_img ?? 'items/img/bg_' . rand(1, 8) . '.jpg') ?>" />



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
    <!-- <script src="script/shuffle.js"></script> -->
    <!-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> -->

    <script src="script/main.js"></script>
    <script src="https://portfolio.metatronprime.com/analitics/analitics.js" async></script>

    <!-- Schema.org JSON-LD markup -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [{
                    "@type": "Person",
                    "@id": "https://portfolio.metatronprime.com/#person",
                    "name": "Nik Atanasov",
                    "url": "https://portfolio.metatronprime.com/",
                    "image": "https://portfolio.metatronprime.com/items/img/morse.jpg",
                    "jobTitle": "Developer, UI/UX/3D",
                    "sameAs": [
                        "https://www.linkedin.com/in/metatronprime/",
                        "https://github.com/nka212bg",
                        "https://gitlab.com/nka212bg"
                    ]
                },
                {
                    "@type": "WebSite",
                    "@id": "https://portfolio.metatronprime.com/#website",
                    "url": "https://portfolio.metatronprime.com/",
                    "name": "Nik Atanasov Portfolio",
                    "publisher": {
                        "@id": "https://portfolio.metatronprime.com/#person"
                    }
                },
                {
                    "@type": "ItemList",
                    "@id": "https://portfolio.metatronprime.com/#projects",
                    "name": "Featured Projects",
                    "itemListElement": [{
                        "@type": "ListItem",
                        "position": 1,
                        "item": {
                            "@type": "CreativeWork",
                            "name": "Morse Code App",
                            "url": "https://portfolio.metatronprime.com/morse",
                            "image": {
                                "@type": "ImageObject",
                                "url": "https://portfolio.metatronprime.com/items/img/morse.jpg",
                                "width": 1600,
                                "height": 900,
                                "caption": "Morse Code App interface"
                            },
                            "description": "A helper app for converting Morse code to text and vice versa."
                        }
                    }]
                }
            ]
        }
    </script>

</head>

<body>