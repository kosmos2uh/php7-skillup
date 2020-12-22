<?php
include "include/header.php";
$arNews = [
        ['datetime' => '19:16', 'title' => 'Тайсон согласовал контракт с Интернасьоналом', 'url' => '#',],
        ['datetime' => '19:11', 'title' => 'Дети более уязвимы перед новым штаммом коронавируса', 'url' => '#',],
        ['datetime' => '19:01', 'title' => 'Россия направила в ЦАР 300 военных инструкторов', 'url' => '#',],
        ['datetime' => '18:56', 'title' => 'Нафтогаз и Укрнафта урегулировали многолетний спор', 'url' => '#',],
        ['datetime' => '18:55', 'title' => 'Редкач обвинил украинского боксера в покупке боя', 'url' => '#',],
        ['datetime' => '18:50', 'title' => 'Мистер Олимпия, слияние планет и борщ: фото дня', 'url' => '#',],
        ['datetime' => '18:40', 'title' => 'В ЦОЗ ожидают для Украины самую "слабую" вакцину', 'url' => '#',],
        ['datetime' => '18:33', 'title' => 'Масштабный пожар на складах Киева потушен', 'url' => '#',],
        ['datetime' => '18:29', 'title' => 'На руднике в Канаде нашли мумию древнего волка', 'url'  => '#',],
];

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