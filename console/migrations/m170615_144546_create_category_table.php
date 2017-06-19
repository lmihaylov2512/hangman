<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `category`.
 */
class m170615_144546_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `category`
        $this->createTable('category', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string(64)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `category`
        $this->dropTable('category');
    }
}
