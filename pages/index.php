<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/template/header.php";

$arNews = getLastNews(10);
$arPhotoNews = getPhotoNews();

?>
    <h1>Новости - это вам не старости!</h1>
    <div class="row mb-3">
        <div class="col">
            <img src="https://fakeimg.pl/800x200/282828/eae0d0/?text=Banner" alt="banner" class="w-100 img-fluid" />
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-8">
            <h3>Посдедние новости</h3>
            <ul class="list-group">
                <?php foreach ($arNews as $news) { ?>
                    <li class="list-group-item">
                        <span class="badge bg-warning text-dark"><?php echo $news['datetime']; ?></span>
                        <a href="<?php echo $news['url']; ?>"><?php echo $news['title']; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="col-4">
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/include/template/right_popular_news.php" ?>
        </div>
    </div>
    <div class="row mb-3">
        <?php foreach ($arPhotoNews as $news) { ?>
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
<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/template/footer.php" ?>