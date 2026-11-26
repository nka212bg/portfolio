<!-- POPUP FEEFBACK -->
<div class="popup-view">
    <div class="popup-view__container">
        <!-- TOP -->
        <div class="popup-view__container__close" @click="showFeedback = false, document.querySelector('html').classList.remove('hide-scroll')">&times;</div>
        <div class="popup-view__container__top">
            <div v-if="!loading" class="popup-view__container__top-icon"></div>
            <div v-else class="popup-view__container__top-icon spin"></div>

            <div class="popup-view__container__top-header"><?= $t['feedback'] ?></div>
            <div class="popup-view__container__top-text"><?= $t['feedbackPopupText'] ?></div>
        </div>

        <!-- BOTTOM -->
        <form @submit.prevent="loading = true, $n.feedback($refs.emailInput.value, $refs.feedbackText.value, $refs.website.value).then(r => {
            loading = false;
            if (r !== 'success') return alert(r);
            alert('<?= $t['feedbackSent'] ?>');
            showFeedback = false, document.querySelector('html').classList.remove('hide-scroll');
        })" class="popup-view__container__bottom">
            <!-- honeypot: hidden from people, bots fill it in -->
            <input type="text" ref="website" tabindex="-1" autocomplete="off" aria-hidden="true" style="position: absolute; left: -9999px">
            <fieldset class="bottom-fieldset">
                <legend></legend>
                <input type="email" placeholder="<?= $t['email'] ?>..." ref="emailInput" value="<?= $subscribed ?? '' ?>" required <?= empty($subscribed) ? 'autofocus' : '' ?>>
            </fieldset>

            <fieldset class="bottom-fieldset">
                <legend></legend>
                <textarea placeholder="<?= $t['text'] ?>..." required ref="feedbackText" <?= empty($subscribed) ? '' : 'autofocus' ?>></textarea>
            </fieldset>
            <div class="bottom-buttons">
                <button class="button button--download" style="min-width: 100px"><?= $t['send'] ?></button>
                <div class="button button" style="min-width: 100px" @click="showFeedback = false, document.querySelector('html').classList.remove('hide-scroll')"><?= $t['cancel'] ?></div>
            </div>
        </form>
        <!-- <a href="privacy" target="_blank" class="popup-view__container__outer-content text--primary-2 text-center smaller--font-size link pt-1"><?= $t['privacyLinkText'] ?? '' ?></a> -->
    </div>
</div>