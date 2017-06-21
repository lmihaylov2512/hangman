<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * Handles the creation of table `player`.
 */
class m170615_153306_create_player_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // create table `player`
        $this->createTable('player', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'status' => $this->boolean()->unsigned()->notNull()->defaultValue(DatabaseHelper::DEFAULT_ZERO)->comment('0-Inactive;1-Active'),
            'email' => $this->string(128)->notNull(),
            'password' => $this->string(64)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'first_name' => $this->string(32)->notNull(),
            'last_name' => $this->string(32)->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], DatabaseHelper::getTableOptions($this));
        
        // set unique index
        $this->createIndex('idx_player_email', 'player', 'email', true);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drop table `player`
        $this->dropTable('player');
    }
}
