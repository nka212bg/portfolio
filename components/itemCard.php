<?php
$images = json_encode(glob('items/' . $card["item_id"] . '/images/*'));
?>

<!-- ITEM CARD -->
<div class="item-card" v-scope='{currentImgIndex : 0, img: <?= $images ?>}'>
    <!-- TOP -->
    <div class="item-card__top tilt-img-container <?= !$card['store_link'] ? "item-card__top--free" : "" ?>">
        <div v-if="img.length > 1" class="img-indicators">
            <div v-for="(image, index) in img.length" :key="index" class="indicator" :class="{'active': index == currentImgIndex}" @click="currentImgIndex = index"></div>
        </div>
        <img :src="img[currentImgIndex]" alt="img" class="item-card__top__image tilt-img" @click="currentImgIndex >= img.length - 1 ? currentImgIndex = 0 : currentImgIndex++" loading="lazy">
    </div>

    <!-- BOTTOM -->
    <div class="item-card__bottom">
        <!-- TITLE -->
        <div class="block light text-center ellipsis-1 big--font-size mb-025"><?= $card["title"] ?></div>

        <!-- STATS -->
        <div class="flex-center small--font-size cursor-default pb-1">
            <?php if (!$card['store_link']) { ?><span title="<?= $t["downloadsCount"] ?>" class="mr-1"><span class="text--secondary-7 mr-025"></span><?= $card['downloads_count'] ?></span><?php } ?>
            <span title="<?= $t["rating"] ?>" ><span class="text--alert mr-025"></span><?= $card['rating'] . '/' . $card['rating_count'] ?></span>
            <?php if ($card['hidden']) { ?><span class="ml-1"><span class="text--error mr-025"></span>HIDDEN</span><?php } ?>
        </div>
        <!-- BUTTONS -->
        <div class="buttons-group flex-center mt-1" style="gap: 10px">
            <a href="/item-view?id=<?= $card["item_id"] ?>&t=<?= $i18n["selectedLanguage"] ?>" class="button button--primary"><?= $t["details"] ?></a>
        </div>
    </div>
</div>