<?php

namespace common\helpers;

use common\models\Word;

/**
 * The word helper class.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class WordHelper extends BaseHelper
{
    /**
     * Generates random word based on database algorithms.
     * 
     * @param array|integer $category specific category/s for word/s
     * @param int $limit the number of random words
     * @param bool $asArray whether return word like array or object
     * @return common\models\Word|common\models\Word[]|null random word object or list with random words, or null
     */
    public static function getRandomWords($category = null, int $limit = 1, bool $asArray = false)
    {
        if ($limit < 1) {
            return;
        }
        
        $query = Word::find()->filterWhere(['category_id' => $category])->orderBy('RAND()')->limit($limit)->asArray($asArray);
        
        return $limit === 1 ? $query->one() : $query->all();
    }
}
