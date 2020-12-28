<?php
include $_SERVER['DOCUMENT_ROOT'] . "/include/template/header.php";

$arNews = getLastNews(10);
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
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a href="#">
                    <img src="http://placekitten.com/250/150" class="card-img-top" alt="Cat">
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">Card title</a>
                    </h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/include/template/footer.php" ?>