<?php
// session_start();
require 'private/components/header.php';
require 'private/components/headerMenu.php';

require 'private/model/items.php';
$cardItems = Items::getAllItems($isAdmin);
?>

<!-- PAGE HERO -->
<div class="page-hero pt-5 pb-6 mb-3">
    <div class="page-hero__content">
        <h1 class="mb-1 uppercase light"><?= $t['ourProducts'] ?></h1>
        <div class="light small--font-size"><?= $t['description'] ?></div>
    </div>
</div>

<!-- ITEMS --> 
<div class="items-container mb-6">
    <?php foreach ($cardItems as $card) include  'private/components/itemCard.php' ?>
</div>

 
<?php require 'private/components/footer.php' ?> 