<!-- HEADER MENU -->
<div class="app-header-menu" v-scope='{ 
    langMenuState : false, 
    langs: <?= json_encode($i18n["availableLanguages"]) ?> , 
    selectedLang: "<?= $i18n["selectedLanguage"] ?>",
    hideMenuLogo: "<?= isset($hideMenuLogo) && $hideMenuLogo ?>"
}'>

    <a v-if="!hideMenuLogo" href="/?t=<?= $i18n["selectedLanguage"] ?>" class="app-header-menu__left">
        <img src="/img/logo.svg" class="app-header-menu__left__logo" alt="Inna’s Journals logo" />
        <h1 class="app-header-menu__left__company-name"><?= $t['title'] ?></h1>
    </a>
    <div v-else></div>
    <div class="app-header-menu__right">
        <!-- <a href="//instagram.com/innasjournals/" target="_blank" class="app-header-menu__right__social-link instagram" :class="{' text--white': hideMenuLogo}"></a> -->
        <a href="//pinterest.ca/innasjournals/" target="_blank" class="app-header-menu__right__social-link pinterest" :class="{' text--white': hideMenuLogo}"></a>
        <div class="app-header-menu__right__lang-switch" :class="{'active': langMenuState}" @click="langMenuState = !langMenuState">
            <div class="switch-item">{{selectedLang}}</div>
            <div v-show="langMenuState">
                <div v-for="(lang, i) in langs" :key="i">
                    <div class="switch-item" v-if="selectedLang != lang" @click="location.href = `/?t=${lang}`">{{lang}}</div>
                </div>
            </div>
        </div>
    </div>
</div>