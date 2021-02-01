<?php

namespace App\Helpers;

class FlashMessage
{

    private static function add($type, $text) {
        $_SESSION['flash_messages'] = $_SESSION['flash_messages'] ?? [];
        $_SESSION['flash_messages'][] = [
            'type' => $type,
            'text' => $text,
        ];
    }

    public static function get() {
        $_SESSION['flash_messages'] = $_SESSION['flash_messages'] ?? [];
        $arMessages = $_SESSION['flash_messages'];
        unset($_SESSION['flash_messages']);
        return $arMessages;
    }

    public static function addSuccess($text) {
        self::add('success', $text);
    }

    public static function addError($text) {
        self::add('error', $text);
    }

    public static function addWarning($text) {
        self::add('warning', $text);
    }

    public static function addInfo($text) {
        self::add('info', $text);
    }

}