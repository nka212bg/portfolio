<!-- HEADER MENU -->
<div class="app-header-menu" v-scope='{ 
    langMenuState : false, 
    langs: <?= json_encode($i18n["availableLanguages"]) ?> , 
    selectedLang: "<?= $i18n["selectedLanguage"] ?>",
    hideMenuLogo: "<?= isset($hideMenuLogo) && $hideMenuLogo ?>",
    showFeedback : false, 
    loading: false
}'>

    <a v-if="!hideMenuLogo" href="/?t=<?= $i18n["selectedLanguage"] ?>" class="app-header-menu__left">
        <img src="/img/logo.svg" class="app-header-menu__left__logo" alt="logo" />
        <h1 class="app-header-menu__left__company-name mobile-hide"><?= $t['myName'] ?></h1>
    </a>
    <div v-else></div>
    <div class="app-header-menu__right">
        <a href="https://www.linkedin.com/in/metatronprime/" target="_blank" class="app-header-menu__right__social-link big--font-size text--blue"></a>
        <a href="https://github.com/nka212bg" target="_blank" class="app-header-menu__right__social-link big--font-size text--white"></a>
        <a href="https://gitlab.com/nka212bg" target="_blank" class="app-header-menu__right__social-link big--font-size text--alert"></a>
        <div class="app-header-menu__right__social-link bigger--font-size text--secondary-8" @click="showFeedback = true, document.querySelector('html').classList.add('hide-scroll')"></div>
        <div class="app-header-menu__right__lang-switch" :class="{'active': langMenuState}" @click="langMenuState = !langMenuState">
            <div class="switch-item">{{selectedLang}}</div>
            <div v-show="langMenuState">
                <div v-for="(lang, i) in langs" :key="i">
                    <div class="switch-item" v-if="selectedLang != lang" @click="location.href = `/?t=${lang}`">{{lang}}</div>
                </div>
            </div>
        </div>
    </div>

    <template v-if="showFeedback">
        <?php include  'components/popupFeedback.php' ?>
    </template>
</div>