<?php
include "include/header.php";
$arNews = [];

$xml = 'http://k.img.com.ua/rss/ru/all_news2.0.xml';
$strXML = file_get_contents($xml);
$objXML = simplexml_load_string($strXML, 'SimpleXMLElement', LIBXML_NOCDATA);
$jsonXML = json_encode($objXML);
$arXML = json_decode($jsonXML, true);

foreach ($arXML['channel']['item'] as $item) {
    $arNews[] = [
        'id' => $item['guid'],
        'datetime' => date('H:i', strtotime($item['pubDate'])),
        'title' => $item['title'],
        'url' => '/detail.php?id=' . $item['guid'],
    ];
}

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
            <?php include "include/right_popular_news.php" ?>
        </div>
    </div>
<?php include "include/footer.php" ?>