<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `game_action`.
 */
class m170615_162752_create_game_action_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `game_action`
        $this->createTable('game_action', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'game_id' => $this->integer()->unsigned()->notNull(),
            'type' => $this->smallInteger()->unsigned()->notNull()->comment('1-Letter;2-Word'),
            'input' => $this->string(64)->notNull(),
            'success' => $this->boolean()->unsigned()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        // set foreign keys
        $this->addForeignKey('fk_game_action_game_id', 'game_action', 'game_id', 'game', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `game_action`
        $this->dropTable('game_action');
    }
}
