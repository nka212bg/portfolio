<?php
require 'components/header.php';
require 'components/headerMenu.php';
?>

<div v-scope='{ 
    items: <?= file_get_contents("items/items.json") ?>,
    common: <?= file_get_contents("items/common.json") ?>,
    selectedItem: null,
    filterTag : null,
    filterBy(val){
        const items = JSON.parse(JSON.stringify(this.items));
        items.forEach(e => val && !e.tags.includes(val) && e.category != val ? (e.hide = true) : delete e.hide);
        this.items = items;
        this.filterTag = val;
    },   
}'>


    <div class="m-6 p-6 flex-center flex-middle">Something, something</div>

    <!-- ITEMS -->
    <div style="position: relative;">
        <div v-if="filterTag" class="flex-center smaller--font-size link text--white" style="position: absolute; top: 0; left: 33px" @click="filterBy(null)"><span :style="{color: common.tags[filterTag].color, fontFamily: 'var(--font-logos)' }" class="small--font-size mr-05">{{common.tags[filterTag].icon}}</span> filtered by {{filterTag}}</div>
        <div class="home-portfolio p-2">
            <div v-for="(item, i) in items" :key="i" v-show="!item.hide" class="portfolio-item" @click="selectedItem = item">
                <div class="img" :style="`background-image: url('${item.img}')`"></div>
                <div class="portfolio-item-content">
                    <div class="item-title">{{item.title}} {{item.hide}}</div>
                    <div class="item-description">{{item.description}}</div>
                    <div class="item-bottom">
                        <div class="item-category" @click.stop="filterBy(item.category)">{{item.category}}</div>
                        <div class="item-tags">
                            <span v-for="(tag, t) in item.tags" :key="t" class="item-tags-tag" :title="tag" :style="{color: common.tags[tag].color}" @click.stop="filterBy(tag)">{{common.tags[tag].icon}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div v-if="selectedItem" class="popup-view">
        <div class="popup-view__container popup-view__container--fullWidth">
            <!-- TOP -->
            <div class="popup-view__container__close" @click="selectedItem = null">&times;</div>
            <h1 class="ml-1 mt-05">{{selectedItem}}</h1>
        </div>
    </div>

</div>

<?php require 'components/footer.php' ?>