<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `game`.
 */
class m170615_162710_create_game_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `game`
        $this->createTable('game', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'player_id' => $this->integer()->unsigned()->notNull(),
            'word_id' => $this->integer()->unsigned()->notNull(),
            'status' => $this->smallInteger()->unsigned()->notNull()->comment('0-Incomplete;1-Active;2-Won;3-Lost'),
            'word' => $this->string(64)->notNull(),
            'attempts' => $this->smallInteger()->unsigned()->notNull(),
            'is_multi' => $this->boolean()->unsigned()->notNull()->defaultValue(DatabaseHelper::BOOLEAN_FALSE)->comment('0-Not multi;1-Multi'),
            'started_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'finished_at' => $this->timestamp()->null(),
            'closed_at' => $this->timestamp()->null(),
            'opened_at' => $this->timestamp()->null(),
        ], DatabaseHelper::getTableOptions($this));
        
        // set foreign keys
        $this->addForeignKey('fk_game_player_id', 'game', 'player_id', 'player', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_game_word_id', 'game', 'word_id', 'word', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `game`
        $this->dropTable('game');
    }
}
