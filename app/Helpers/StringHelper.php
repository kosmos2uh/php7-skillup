<?php


namespace App\Helpers;


class StringHelper
{
    static function translit($string, $replacement = '-') {
        $string = mb_strtolower($string, 'utf-8');
        $from = array('ї','Ї','є','Є','ю','Ю','я','Я','ё','Ё','э','Э','ы','Ы','ж','Ж','й','Й','щ','Щ','ш','Ш','ч','Ч','х','Х',
            'а','А','б','Б','в','В','г','Г','д','Д','е','Е','з','З','и','И','к','К','л','Л','м','М','н','Н','о','О',
            'п','П','р','Р','с','С','т','Т','у','У','ф','Ф','х','Х','ц','Ц','Ь','ь','ъ','Ъ',
            'ґ', 'Ґ', 'є', 'Є', 'і', 'І', 'ї', 'Ї');

        $to = array('jy', 'Jy', 'je', 'Je', 'yu', 'Yu', 'ya', 'Ya', 'yo', 'Yo', 'e',  'E',  'y',  'Y',  'zh', 'Zh', 'j',  'J',  'sch','Sch','sh', 'Sh', 'ch', 'Ch', 'h',  'H',
            'a',  'A',  'b',  'B',  'v',  'V',  'g',  'G',  'd',  'D',  'e',  'E',  'z',  'Z',  'i',  'I',  'k',  'K',  'l',  'L',  'm',  'M',  'n',  'N',  'o',  'O',
            'p',  'P',  'r',  'R',  's',  'S',  't',  'T',  'u',  'U',  'f',  'F',  'h',  'H',  'c',  'C',  "",  "",  "",  "",
            'g', 'G', 'e', 'E', 'i', 'I', 'i', 'I');
        $string = str_replace($from, $to, $string);
        $string = preg_replace('/[^' . $replacement . '0-9a-zа-яёґєіїА-ЯЁҐЄІЇ]/i', ' ', $string);
        $string = preg_replace('/[' . $replacement . '\s]+/', $replacement, $string);
        return trim($string, $replacement);
    }
}