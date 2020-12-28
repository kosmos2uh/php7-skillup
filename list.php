<?php
include "include/template/header.php";

$arNews = getLastNews();

?>
    <h1>Список новостей</h1>
    <div class="row mb-3">
        <div class="col-8">
            <ul class="list-group mb-3">
                <?php foreach ($arNews as $news) { ?>
                    <li class="list-group-item">
                        <span class="badge bg-warning text-dark"><?php echo $news['datetime']; ?></span>
                        <a href="<?php echo $news['url']; ?>"><?php echo $news['title']; ?></a>
                    </li>
                <?php } ?>
            </ul>
            <nav>
                <ul class="pagination pagination-lg">
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">1</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-4">
            <?php include "include/template/right_popular_news.php" ?>
        </div>
    </div>
<?php include "include/template/footer.php" ?>