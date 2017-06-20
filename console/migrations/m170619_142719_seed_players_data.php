<?php

use yii\db\Migration;
use common\helpers\DatabaseHelper;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class m170619_142719_seed_players_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // populate sample players entities
        $this->batchInsert('player', ['status', 'email', 'password', 'auth_key', 'first_name', 'last_name'], [
            ['status' => DatabaseHelper::STATUS_ACTIVE, 'email' => 'admin@admin.com', 'password' => Yii::$app->security->generatePasswordHash('admin123'), 'auth_key' => Yii::$app->security->generateRandomString(), 'first_name' => 'Admin', 'last_name' => 'Admin'],
            ['status' => DatabaseHelper::STATUS_ACTIVE, 'email' => 'me@lmihaylov.com', 'password' => Yii::$app->security->generatePasswordHash('lacho123'), 'auth_key' => Yii::$app->security->generateRandomString(), 'first_name' => 'Lachezar', 'last_name' => 'Mihaylov'],
        ]);
    }
    
    /**
     * @inheritdoc
     */
    public function down()
    {
        // delete sample players
        $this->delete('player', ['email' => ['admin@admin.com', 'me@lmihaylov.com']]);
    }
}
