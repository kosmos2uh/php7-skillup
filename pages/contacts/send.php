<?php

if(!empty($_POST)) {

    $_SESSION['mail_form'] = [
        'status' => 0,
        'message' => '',
    ];

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
        $_SESSION['mail_form']['status'] = 1;
        $_SESSION['mail_form']['message'] = 'Ваше сообщение успешно отправлено';
    } catch (Exception $e) {
        $_SESSION['mail_form']['message'] = $e->getMessage();
    }

}

header("Location: " . url('contacts'));