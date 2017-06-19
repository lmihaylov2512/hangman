<?php

namespace common\helpers;

use common\models\Category;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class CategoryHelper extends BaseHelper
{
    public static function getCategoriesArray($asArray = true)
    {
        return static::pullCategoriesRows($asArray);
    }
    
    public static function getCategoriesOptions()
    {
        return ArrayHelper::map(static::pullCategoriesRows(true), 'id', 'name');
    }
    
    protected static function pullCategoriesRows($asArray = true)
    {
        return Category::getDb()->cache(function (\yii\db\Connection $db) use ($asArray) {
            return Category::find()->asArray($asArray)->all();
        }, self::TTL_60_MIN, new DbDependency(['sql' => 'SELECT MAX(`updated_at`) FROM ' . Category::getTableSchema()->name]));
    }
}
