<?php

use App\Helpers\EntityImage;

if(!isset($arData) || empty($arData))
    return;
?>
<div class="row mb-3">
    <?php foreach ($arData as /** @var \App\Entity\Recipe $item */ $item) { ?>
        <div class="col">
            <div class="card">
                <a href="<?php echo url('recipe_detail', ['id' => $item->id]); ?>">
                    <img src="<?php echo EntityImage::getEntityImage('recipe', $item->image); ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="badge bg-warning text-dark"><?php echo $item->date; ?></span>
                        <a href="<?php echo url('recipe_detail', ['id' => $item->id]); ?>"><?php echo $item->name; ?></a>
                    </h5>
                    <p class="card-text"><?php echo ''; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>