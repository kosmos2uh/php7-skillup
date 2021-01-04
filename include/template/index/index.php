<h1>Новости - это вам не старости!</h1>
<div class="row mb-3">
    <div class="col">
        <img src="https://fakeimg.pl/800x200/282828/eae0d0/?text=Banner" alt="banner" class="w-100 img-fluid" />
    </div>
</div>
<div class="row mb-3">
    <div class="col-8">
        <?php if(isset($arData['news']) && !empty($arData['news'])) { ?>
            <h3>Посдедние новости</h3>
            <?php printTemplateHtml('news/list', $arData['news']); ?>
        <?php } else { ?>
            <p>Новостей нет</p>
        <?php } ?>
    </div>
    <div class="col-4">
        <?php includeBlock('right_popular_news');  ?>
    </div>
</div>

<?php
if(isset($arData['photo_news']) && !empty($arData['photo_news'])) {
    printTemplateHtml('news/index_photo_news', $arData['photo_news']);
}
?>