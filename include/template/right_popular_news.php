<?php
$arNews = getPopularNew();
?>
<h3>Популярные новости</h3>
<ul class="list-group">
    <?php foreach ($arNews as $news) { ?>
        <li class="list-group-item">
            <span class="badge bg-warning text-dark"><?php echo $news['datetime']; ?></span>
            <a href="<?php echo $news['url']; ?>"><?php echo $news['title']; ?></a>
        </li>
    <?php } ?>
</ul>