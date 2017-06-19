<?php

namespace common\helpers;

/**
 * 
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class AlphabetHelper extends BaseHelper
{
    protected static $alphabets = [
        'bg' => ['а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я'],
        'en' => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
    ];
    
    public static function getSupportedLanguages()
    {
        return array_keys(static::$alphabets);
    }
    
    public static function getAlphabet(string $language, bool $upperCase = false)
    {
        if (in_array($language, static::getSupportedLanguages())) {
            if ($upperCase) {
                return array_map(function ($letter) { return mb_strtoupper($letter); }, static::$alphabets[$language]);
            }
            
            return static::$alphabets[$language];
        }
    }
}
