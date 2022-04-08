<?php
require 'components/header.php';
require 'components/headerMenu.php';
?>

<div class="home" v-scope='{ 
    items: <?= file_get_contents("items/items.json") ?>,
    common: <?= file_get_contents("items/common.json") ?>,
    selectedItem: null,
    selectedItemIndex: null,
    filterTag : null,
    filterBy(val){
        const items = JSON.parse(JSON.stringify(this.items));
        items.forEach(e => val && !e.tags?.includes(val) && e.category != val ? (e.hide = true) : delete e.hide);
        this.items = items;
        this.filterTag = val;
        window.scrollTo(0, 350);
    }, 
    changeItem(n){
        this.selectedItemIndex = this.selectedItemIndex + n;
        this.selectedItemIndex >= this.items.length && (this.selectedItemIndex = 0);
        this.selectedItemIndex < 0 && (this.selectedItemIndex = this.items.length - 1);
        this.selectedItem = this.items[this.selectedItemIndex];
    },
    msr(){
        $n.masonry()
    }
}'>



    <div class="home-hero">
        <img src="/img/avatar.png" alt="Nik Atanasov logo">
        <div class="home-hero-text">
            <div class="hero-title" v-html="`<?= $t['title'] ?>`"></div>
            <div class="hero-description" v-html="`<?= $t['description'] ?>`"></div>
        </div>
    </div>



    <!-- ITEMS -->
    <div class="home-portfolio">
        <div v-if="filterTag" class="flex-center smaller--font-size link text--white" style="position: absolute; top: 0; left: 33px" @click="filterBy(null)"><span :style="{color: common.tags[filterTag].color, fontFamily: 'var(--font-logos)' }" class="small--font-size mr-05">{{common.tags[filterTag].icon}}</span> filtered by {{filterTag}}</div>
        <div v-for="(item, i) in items" :key="i" v-show="!item.hide" class="portfolio-item">

            <img :src="item.img" class="img" alt="item-image" loading="lazy" @click="selectedItem = item, selectedItemIndex = i, document.querySelector('html').classList.add('hide-scroll')">

            <div v-if="item.title || item.description" class="portfolio-item-content">
                <div v-if="item.title" class="item-title" v-html="item.title"></div>
                <div v-if="item.description" class="item-description" v-html="item.description"></div>
                <div v-if="item.category || (item.tags && item.tags.length)" class="item-bottom">
                    <div v-if="item.category" class="item-category" @click="filterBy(item.category)">{{item.category}}</div>
                    <div v-if="item.tags && item.tags.length" class="item-tags">
                        <span v-for="(tag, t) in item.tags" :key="t" class="item-tags-tag" :title="tag" :style="{color: common.tags[tag].color}" @click="filterBy(tag)">{{common.tags[tag].icon}}</span>
                    </div>
                </div>
            </div>
            <div v-else-if="item.category || (item.tags && item.tags.length)" class="portfolio-item-content content-single">
                <div v-if="item.category || (item.tags && item.tags.length)" class="item-bottom">
                    <div v-if="item.category" class="item-category" @click="filterBy(item.category)">{{item.category}}</div>
                    <div v-if="item.tags && item.tags.length" class="item-tags">
                        <span v-for="(tag, t) in item.tags" :key="t" class="item-tags-tag" :title="tag" :style="{color: common.tags[tag].color}" @click="filterBy(tag)">{{common.tags[tag].icon}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div v-if="selectedItem" class="popup-view">
        <!-- NAVIGATION -->
        <div class="popup-view__container__nav">
            <div class="nav-arrow" @click="changeItem(-1)"></div>
            <div class="nav-arrow" @click="changeItem(1)"></div>
        </div>
        <div class="popup-view__container popup-view__container--fullWidth">
            <img :src="selectedItem.img" alt="image">
            <!-- TOP -->
            <div class="popup-view__container__close" @click="selectedItem = null, document.querySelector('html').classList.remove('hide-scroll')">&times;</div>

            <div class="home-popup">
                <div class="home-popup-content">

                    <div v-if="selectedItem.title || selectedItem.category" class="item-title" v-html="`${selectedItem.title || ''}${selectedItem.title && selectedItem.category ? ' | ' : ''}${selectedItem.category || ''}`"></div>
                    <div v-if="selectedItem.description" class="item-description" v-html="selectedItem.description"></div>

                    <div v-if="selectedItem.tags && selectedItem.tags.length" class="item-bottom">
                        <div class="item-tags">
                            <span v-for="(tag, t) in selectedItem.tags" :key="t" class="item-tags-tag" :title="tag" :style="{color: common.tags[tag].color}">{{common.tags[tag].icon}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require 'components/footer.php' ?>