<?php
if(!isset($arData) || empty($arData))
    return;
?>
<div class="row mb-3">
    <?php foreach ($arData as $news) { ?>
        <div class="col">
            <div class="card">
                <a href="<?php echo $news['url']; ?>">
                    <img src="<?php echo $news['image']; ?>" class="card-img-top" alt="<?php echo $news['title']; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?php echo $news['url']; ?>"><?php echo $news['title']; ?></a>
                    </h5>
                    <p class="card-text"><?php echo $news['description']; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>