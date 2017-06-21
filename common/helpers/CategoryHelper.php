<?php

namespace common\helpers;

use common\models\Category;
use yii\caching\DbDependency;
use yii\helpers\ArrayHelper;

/**
 * Category helper class. It contains useful methods for retrieving categories list.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class CategoryHelper extends BaseHelper
{
    /**
     * Returns all categories in array structure.
     * 
     * @param bool $asArray whether return arrays or objects
     * @return array all categories array
     */
    public static function getCategoriesArray(bool $asArray = true)
    {
        return static::pullCategoriesRows($asArray);
    }
    
    /**
     * Returns all categories options.
     * 
     * @return array all categories options (id => name) pairs
     */
    public static function getCategoriesOptions()
    {
        return ArrayHelper::map(static::pullCategoriesRows(true), 'id', 'name');
    }
    
    /**
     * Pulls categories data from existing cache or directly from database.
     * If they are got from database, then keep them in cache.
     * 
     * @param bool $asArray whether return elements like array or object
     * @return array pulled categories
     */
    protected static function pullCategoriesRows(bool $asArray = true)
    {
        return Category::getDb()->cache(function () use ($asArray) {
            return Category::find()->asArray($asArray)->all();
        }, self::TTL_60_MIN, new DbDependency(['sql' => 'SELECT MAX(`updated_at`) FROM ' . Category::getTableSchema()->name]));
    }
}
