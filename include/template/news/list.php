<?php
if(!isset($arData) || empty($arData))
    return;
?>
<ul class="list-group mb-3">
    <?php foreach ($arData as $news) { ?>
        <li class="list-group-item">
            <span class="badge bg-warning text-dark"><?php echo $news['datetime']; ?></span>
            <a href="<?php echo $news['url']; ?>"><?php echo $news['title']; ?></a>
        </li>
    <?php } ?>
</ul>