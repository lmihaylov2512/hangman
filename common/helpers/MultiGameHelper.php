<?php

namespace common\helpers;

use common\models\{Player, Game};

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class MultiGameHelper extends BaseHelper
{
    public static function duplicateGame(Player $player, Game $game)
    {
        $duplicate = GameHelper::start($player, $game->word0);
        
        
    }
}
