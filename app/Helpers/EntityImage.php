<?php

namespace App\Helpers;

use App\Helpers\StringHelper;

class EntityImage
{
    public static function saveEntityImage($entity, $image_field_name) {
        $uploaded_file_name = '';
        if(!empty($_FILES[$image_field_name])) {
            $arFile = &$_FILES[$image_field_name];
            $ext = $arFile['type'] == 'image/png' ? 'png' : 'jpg';
            $originalFilename = pathinfo($arFile['name'], PATHINFO_FILENAME);
            $safeFilename = StringHelper::translit($originalFilename);
            $uniqid = uniqid();
            $subdir_name_1 = substr($uniqid, -4, -2);
            $subdir_name_2 = substr($uniqid, -2);
            $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $entity . '/' . $subdir_name_1 . '/' . $subdir_name_2 . '/';
            if(!is_dir($uploads_dir)) {
                mkdir($uploads_dir, '0777', true);
            }

            $fileName = $safeFilename . '-' . $uniqid . '.' . $ext;

            if(move_uploaded_file($arFile['tmp_name'], $uploads_dir . '/' . $fileName)) {
                $uploaded_file_name = $subdir_name_1 . '/' . $subdir_name_2 . '/' . $fileName;
            }
        }
        return $uploaded_file_name;
    }

    public static function getEntityImage($entity, $file_name) {
        $src = '';
        if($file_name != '') {
            $src = '/upload/' . $entity . '/' . $file_name;
        }
        return $src;
    }

    public static function deleteEntityImage($entity, $file_name) {
        $file_path = $_SERVER['DOCUMENT_ROOT'] . self::getEntityImage($entity, $file_name);
        if(is_file($file_path)) {
            unlink($file_path);
        }
    }
}