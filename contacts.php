<?php
include "include/header.php";
?>
    <h1>Контакты</h1>
    <div class="row mb-3">
        <div class="col-8">
            <p>В начале декабря полыхнуло: главный тренер «Мехелена» Воутер Вранкен достаточно неожиданно на своей пресс-конференции отреагировал на вопрос журналиста по поводу украинского легионера команды.</p>
            <h4>Наши контакты</h4>
            <ul class="mb-3">
                <li>Адрес: Ул.Парковая, 32</li>
                <li>Телефон: 654658651</li>
                <li>Email: email@email.com</li>
            </ul>
            <h4>Связаться с нами</h4>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="contact_name" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name">
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Ваш Email</label>
                    <input type="email" class="form-control" id="contact_email" placeholder="name@example.com" name="contact_email">
                </div>
                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Ваш телефон</label>
                    <input type="email" class="form-control" id="contact_phone" name="contact_phone">
                </div>
                <div class="mb-3">
                    <label for="contact_message" class="form-label">Example textarea</label>
                    <textarea class="form-control" id="contact_message" rows="3" name="contact_message"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Отправить сообещние</button>
                </div>
            </form>
        </div>
        <div class="col-4">
            <?php include "include/right_popular_news.php" ?>
        </div>
    </div>
<?php include "include/footer.php" ?>