<?php

namespace common\helpers;

use yii\db\Expression;
use common\models\{Player, Game};

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class PlayerHelper extends BaseHelper
{
    public static function closeActiveGames(Player $player, array $games)
    {
        $condition = [
            'player_id' => $player->id,
            'status' => GameHelper::STATUS_ACTIVE,
        ];
        
        if (!empty($games)) {
            $condition['id'] = $games;
        }
        
        return Game::updateAll(['status' => GameHelper::STATUS_INCOMPLETE, 'closed_at' => new Expression('NOW()')], $condition);
    }
    
    public static function closeAllActiveGames(Player $player)
    {
        return static::closeActiveGames($player, []);
    }
    
    public static function openIncompleteGame(Player $player, Game $game)
    {
        
    }
}
