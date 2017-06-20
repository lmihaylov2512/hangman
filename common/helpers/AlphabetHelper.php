<?php

namespace common\helpers;

/**
 * Storage class for alphabets of different languages.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class AlphabetHelper extends BaseHelper
{
    /** @var array all kinds alphabets like (language => letters list) pairs */
    protected static $alphabets = [
        'bg' => ['а', 'б', 'в', 'г', 'д', 'е', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ь', 'ю', 'я'],
        'en' => ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
    ];
    
    /**
     * Returns supported languages based on alphabets array keys.
     * 
     * @return array supported languages list
     */
    public static function getSupportedLanguages()
    {
        return array_keys(static::$alphabets);
    }
    
    /**
     * Returns letters list, if the language exists, otherwise null.
     * 
     * @param string $language specific language
     * @param bool $upperCase whether the alphabet must be transform to upper case
     * @return array|null specific alphabet letters
     */
    public static function getAlphabet(string $language, bool $upperCase = false)
    {
        if (in_array($language, static::getSupportedLanguages())) {
            if ($upperCase) {
                return array_map(function ($letter) { return mb_strtoupper($letter); }, static::$alphabets[$language]);
            }
            
            return static::$alphabets[$language];
        }
    }
    
    /**
     * Performs grouping of alphabet letters according to length for each group.
     * 
     * @param string $language language alphabet
     * @param int $length the number of letters for every group
     * @param bool $upperCase whether the alphabet must be transform to upper case
     * @return array the whole alphabet with grouped letters
     */
    public static function getGroupedAlphabet(string $language, int $length, bool $upperCase = false)
    {
        $alphabet = static::getAlphabet($language, $upperCase);
        $count = ceil(count($alphabet) / $length);
        $groups = [];
        
        for ($i = 0; $i < $count; $i++) {
            $groups[] = array_slice($alphabet, $i * $length, $length);
        }
        
        return $groups;
    }
}
