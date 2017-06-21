<?php

namespace common\helpers;

use common\models\{Player, Game, MultiGame};

/**
 * Base helper class about logic and control of the multi games.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class MultiGameHelper extends BaseHelper
{
    public static function getJoinedGame(Player $player, Game $game)
    {
        return MultiGame::findOne(['primary_id' => $game->id, 'created_by' => $player->id]);
    }
    
    public static function hasJoinedGame(Player $player, Game $game)
    {
        return static::getJoinedGame($player, $game) !== null;
    }
    
    public static function start(Player $player, Game $game)
    {
        if (static::hasJoinedGame($player, $game)) {
            return;
        }
        
        $duplicate = GameHelper::start($player, $game->word0);
        
        if ($duplicate !== null) {
            $game->link('secondaries', $duplicate, ['created_by' => $player->id]);
            
            return $duplicate;
        }
    }
}
