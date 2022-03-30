<!-- HEADER MENU -->
<div class="app-header-banner">
    <?php
    $hideMenuLogo = true;
    require 'private/components/headerMenu.php';
    ?>


    <div class="banner">
        <a href="/?t=<?= $i18n["selectedLanguage"] ?>" class="banner__logo">
            <img src="/img/logo_white.svg" alt="Inna’s Journals logo" />
            <h1><?= $t['title'] ?></h1>
        </a>
        <h1 class="banner__text"><?= $headerBannerText ?></h1>
    </div>


</div>