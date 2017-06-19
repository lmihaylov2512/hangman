<?php

namespace common\helpers;

use common\models\Word;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class WordHelper extends BaseHelper
{
    public static function getRandomWords($category = null, int $limit = 1, bool $asArray = false)
    {
        if ($limit < 1) {
            return;
        }
        
        $query = Word::find()->filterWhere(['category_id' => $category])->orderBy('RAND()')->limit($limit)->asArray($asArray);
        
        return $limit === 1 ? $query->one() : $query->all();
    }
}
