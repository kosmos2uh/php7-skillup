<?php
include "include/header.php";

$mail_sended = false;
$form_submitted = false;
$error_message = '';

if(!empty($_POST)) {

    $form_submitted = true;

    $name = $_POST['contact_name'] ?? '';
    $email = $_POST['contact_email'] ?? '';
    $phone = $_POST['contact_phone'] ?? '';
    $message = $_POST['contact_message'] ?? '';

    $mail_message = 'Дата: ' . date("j.m.Y H:i:s") . PHP_EOL;
    $mail_message .= 'Имя: ' . $name . PHP_EOL;
    $mail_message .= 'Email: ' . $email . PHP_EOL;
    $mail_message .= 'Телефон: ' . $phone . PHP_EOL;
    $mail_message .= 'Текст сообщения: ' . $message . PHP_EOL . PHP_EOL;

//    $result = mail('admin@mysite.com', 'Новый запрос с фоормы', $mail_message);

    try {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/log/mail.log';
        $handler = fopen($file, 'a');
        fwrite($handler, $mail_message);
        fclose($handler);
        $mail_sended = true;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }

}
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
            <?php if($form_submitted) { ?>
                <?php if($mail_sended) { ?>
                <div class="alert alert-success" role="alert">
                    Ваше сообщение успешно отправлено
                </div>
                <?php } else { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="col-4">
            <?php include "include/right_popular_news.php" ?>
        </div>
    </div>
<?php include "include/footer.php" ?>