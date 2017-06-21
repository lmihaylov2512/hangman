<?php

namespace common\helpers;

use yii\db\Expression;
use common\models\{Player, Game};

/**
 * Player helper class.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class PlayerHelper extends BaseHelper
{
    /**
     * Closes only passed games list for specific player.
     * 
     * @param Player $player user/player instance
     * @param array $games list of games id/s
     * @return integer the number of successfully closed games
     */
    public static function closeActiveGames(Player $player, array $games)
    {
        // define permanent conditions
        $condition = [
            'player_id' => $player->id,
            'status' => GameHelper::STATUS_ACTIVE,
        ];
        
        if (!empty($games)) {
            $condition['id'] = $games;
        }
        
        return Game::updateAll(['status' => GameHelper::STATUS_INCOMPLETE, 'closed_at' => new Expression('NOW()')], $condition);
    }
    
    /**
     * Closes all active games for a specific player(user).
     * 
     * @param Player $player passed player instance
     * @return integer the number of closed games
     */
    public static function closeAllActiveGames(Player $player)
    {
        return static::closeActiveGames($player, []);
    }
    
    /**
     * Makes a report grouped by game status and returns number of the games for corresponding status.
     * 
     * @param Player $player the player instance
     * @return array made report
     */
    public static function doStatistics(Player $player)
    {
        return Game::find()->select(['label' => 'status', 'value' => 'COUNT(*)'])->where(['player_id' => $player->id])->groupBy('status')->asArray(true)->all();
    }
}
