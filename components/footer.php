<!-- FOOTER -->
<div class="footer-view mt-4" v-scope='{showFeedback : false, loading: false}'>
    <!-- POPUP MENU -->
    <div class="footer-menu">
        <a href="/?t=<?= $i18n["selectedLanguage"] ?>" class="footer-menu__item"></a>
        <div class="footer-menu__item" @click="showFeedback = true, document.querySelector('html').classList.add('hide-scroll')"><?= $t['feedback'] ?></div>
        <a href="about?t=<?= $i18n["selectedLanguage"] ?>" class="footer-menu__item"><?= $t['about'] ?></a>
        <a href="privacy?t=<?= $i18n["selectedLanguage"] ?>" class="footer-menu__item"><?= $t['privacy'] ?> & <?= $t['terms'] ?></a>
    </div>

    <template v-if="showFeedback">
        <?php include  'components/popupFeedback.php' ?>
    </template>
</div>
</body> 

</html>