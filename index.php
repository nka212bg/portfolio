<?php
require 'components/header.php';
require 'components/headerMenu.php';
?>



<div v-scope='{ 
    popupFor : "Dev", 
}'>


    <div class="app-header-menu__right__social-link bigger--font-size text--secondary-8" @click="popupFor = 'Dev'">Dev</div>

    <div class="app-header-menu__right__social-link bigger--font-size text--secondary-8" @click="popupFor = 'design'">design</div>





    <div v-if="popupFor" class="popup-view">
        <div class="popup-view__container popup-view__container--fullWidth">
            <!-- TOP -->
            <div class="popup-view__container__close" @click="popupFor = false">&times;</div>
            <h1 class="ml-1 mt-05">{{popupFor}}</h1>
            <template v-if="popupFor === 'Dev'">
                <div class="popup-view__container-content">

                    <div class="portfolio-holder">
                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/door2.jpg')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 1</div>
                                <div class="item-description">Feelings potatoes break cats minute carried newspaper rear. Stick early excitement being better cucumber loaf scuttered, reaching hung. Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/items/Capture.PNG')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 2</div>
                                <div class="item-description">Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried excepttt.Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried excepttt.Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried excepttt.Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried excepttt. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/door2.jpg')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 1</div>
                                <div class="item-description">Feelings potatoes break cats minute carried newspaper rear. Stick early excitement being better cucumber loaf scuttered, reaching hung. Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/items/Capture.PNG')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 2</div>
                                <div class="item-description">Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/door2.jpg')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 1</div>
                                <div class="item-description">Feelings potatoes break cats minute carried newspaper rear. Stick early excitement being better cucumber loaf scuttered, reaching hung. Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/items/Capture.PNG')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 2</div>
                                <div class="item-description">Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/door2.jpg')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 1</div>
                                <div class="item-description">Feelings potatoes break cats minute carried newspaper rear. Stick early excitement being better cucumber loaf scuttered, reaching hung. Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="portfolio-holder__item">
                            <div class="img" style="background-image: url('/img/items/Capture.PNG')"></div>
                            <div class="portfolio-holder__item-content">
                                <div class="item-title">Item title text 2</div>
                                <div class="item-description">Clothes front railroad assertion started wait angels. Telegram fortunately squeeze ragged brown, charge bending. Together thought altogether carrying elusive lips hurt tried except. </div>
                                <div class="item-bottom">
                                    <div class="item-category">Design</div>
                                    <div class="item-tags">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>


                </div>
            </template>
            <template v-if="popupFor === 'design'">
                <h1>{{popupFor}}</h1>
            </template>
        </div>
    </div>

</div>

<?php require 'components/footer.php' ?>