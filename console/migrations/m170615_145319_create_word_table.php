<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `word`.
 */
class m170615_145319_create_word_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `word`
        $this->createTable('word', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'letters' => $this->string(64)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        // set foreign keys
        $this->addForeignKey('fk_word_category_id', 'word', 'category_id', 'category', 'id', 'RESTRICT', 'CASCADE');
        
        // set indexes
        $this->createIndex('idx_word_letters', 'word', 'letters', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `word`
        $this->dropTable('word');
    }
}
