<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `multi_game`.
 */
class m170619_140208_create_multi_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `multi_game`
        $this->createTable('multi_game', [
            'primary_id' => $this->integer()->unsigned()->notNull(),
            'secondary_id' => $this->integer()->unsigned()->notNull(),
            'created_by' => $this->integer()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        // set primary key
        $this->addPrimaryKey(null, 'multi_game', ['primary_id', 'secondary_id']);
        
        // set foreign keys
        $this->addForeignKey('fk_multi_game_primary_id', 'multi_game', 'primary_id', 'game', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_multi_game_secondary_id', 'multi_game', 'secondary_id', 'game', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_multi_game_created_by', 'multi_game', 'created_by', 'player', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `multi_game`
        $this->dropTable('multi_game');
    }
}
