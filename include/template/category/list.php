<?php

use App\Helpers\EntityImage;

if(!isset($arData) || empty($arData))
    return;
?>
<div class="row mb-3">
    <?php foreach ($arData as /** @var \App\Entity\Category $item */ $item) { ?>
        <div class="col">
            <div class="card">
                <a href="<?php echo ''; ?>">
                    <img src="<?php echo EntityImage::getEntityImage('category', $item->image); ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?php echo ''; ?>"><?php echo $item->name; ?></a>
                    </h5>
                </div>
            </div>
        </div>
    <?php } ?>
</div>