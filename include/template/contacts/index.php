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
        <form method="post" action="<?php echo url('contacts_send_form'); ?>">
            <div class="mb-3">
                <label for="contact_name" class="form-label">Ваше имя</label>
                <input type="text" class="form-control" id="contact_name" name="contact_name" required>
            </div>
            <div class="mb-3">
                <label for="contact_email" class="form-label">Ваш Email</label>
                <input type="email" class="form-control" id="contact_email" placeholder="name@example.com" name="contact_email" required>
            </div>
            <div class="mb-3">
                <label for="contact_phone" class="form-label">Ваш телефон</label>
                <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required>
            </div>
            <div class="mb-3">
                <label for="contact_message" class="form-label">Example textarea</label>
                <textarea class="form-control" id="contact_message" rows="3" name="contact_message" required></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Отправить сообещние</button>
            </div>
        </form>
        <?php if(isset($_SESSION['mail_form'])) { ?>
            <div class="alert alert-<?php echo $_SESSION['mail_form']['status'] == 1 ? 'success' : 'danger'; ?>" role="alert">
                <?php echo $_SESSION['mail_form']['message']; ?>
            </div>
            <?php
            unset($_SESSION['mail_form']);
        } ?>
    </div>
    <div class="col-4">
        <?php includeBlock('right_popular_news');  ?>
    </div>
</div>