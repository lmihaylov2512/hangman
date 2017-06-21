<?php

namespace common\helpers;

use yii\db\Migration;

/**
 * The class implements utilities about database.
 * 
 * @author Lachezar Mihaylov <l.mihaylov@15tech.org>
 * @since 1.0
 */
class DatabaseHelper extends BaseHelper
{
    /** @var integer database boolean true */
    const BOOLEAN_TRUE = 1;
    /** @var integer database boolean false */
    const BOOLEAN_FALSE = 0;
    
    /** @var string database date and time format */
    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    /** @var string database date format */
    const DATE_FORMAT = 'Y-m-d';
    
    /** @var integer zero value for defaults */
    const DEFAULT_ZERO = 0;
    
    /**
     * Considers the database driver and return specific creating table options.
     * 
     * @param Migration $migration the migration instance
     * @return string|null specific table options
     */
    public static function getTableOptions(Migration $migration)
    {
        switch ($migration->db->driverName) {
            case 'mysql':
                return 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            default:
                return;
        }
    }
}
