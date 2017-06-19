<?php

namespace common\helpers;

use yii\db\Expression;
use common\models\{Game, Player, Word};

class GameHelper extends BaseHelper
{
    const STATUS_INCOMPLETE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WON = 2;
    const STATUS_LOST = 3;
    
    const GAME_ATTEMPTS = 5;
    
    const HIDDEN_CHARACTER = '_';
    
    protected static $unfinishedStatuses = [
        self::STATUS_INCOMPLETE,
        self::STATUS_ACTIVE,
    ];
    
    public static function getStatusesOptions()
    {
        return [
            self::STATUS_INCOMPLETE => 'Incomplete',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_WON => 'Won',
            self::STATUS_LOST => 'Lost',
        ];
    }
    
    public static function getUnfinishedStatuses()
    {
        return static::$unfinishedStatuses;
    }
    
    public static function start(Player $player, Word $word)
    {
        PlayerHelper::closeAllActiveGames($player);
        
        $game = new Game();
        $game->player_id = $player->id;
        $game->word_id = $word->id;
        $game->status = self::STATUS_ACTIVE;
        $game->word = $word->letters;
        $game->attempts = self::GAME_ATTEMPTS;
        
        return $game->save() ? $game : null;
    }
    
    public static function openClosedGame(Game $game)
    {
        if ($game->status != self::STATUS_INCOMPLETE) {
            return false;
        }
        
        $game->status = self::STATUS_ACTIVE;
        $game->opened_at = new Expression('NOW()');
        
        return $game->save(false, ['status', 'opened_at']);
    }
    
    public static function hideWord(Game $game, array $letters)
    {
        // initialize characters storage and prepare the letters
        $chars = [];
        $letters = array_map(function ($letter) { return mb_strtolower($letter); }, $letters);
        
        // iterate each word character and decide whether to replace with hidden character
        for ($i = 0, $len = mb_strlen($game->word) - 1; $i <= $len; $i++) {
            // if the character is set, continue with the next
            if (isset($chars[$i])) {
                continue;
            }
            
            $char = mb_substr($game->word, $i, 1);
            
            // if the character is the first or last, show it
            if ($i === 0 || $i === $len) {
                $chars[$i] = $char;
                continue;
            }
            
            // if the character is a "space", show it plus the previuos and next one
            if ($char === ' ') {
                $chars[$i] = $char;
                $chars[$i - 1] = mb_substr($game->word, $i - 1, 1);
                $chars[$i + 1] = mb_substr($game->word, $i + 1, 1);
                continue;
            }
            
            // if the character is known, show it, otherwise hide it
            if (in_array(mb_strtolower($char), $letters, true)) {
                $chars[$i] = $char;
            } else {
                $chars[$i] = self::HIDDEN_CHARACTER;
            }
        }
        
        return $chars;
    }
}
