<?php

namespace common\helpers;

use yii\db\Expression;
use common\models\{Game, Player, Word};

/**
 * This game helper class has several methods that implement important business logic for moving game-flow forward.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class GameHelper extends BaseHelper
{
    /** @var integer flag for incomplete(inactive) game status */
    const STATUS_INCOMPLETE = 0;
    /** @var integer flag for active(playing) game status */
    const STATUS_ACTIVE = 1;
    /** @var integer flag for won game status */
    const STATUS_WON = 2;
    /** @var integer flag for lost game status */
    const STATUS_LOST = 3;
    
    /** @var integer maximum allowed wrong attempts per game */
    const GAME_ATTEMPTS = 5;
    
    /** @var string character that will be use to hide the unknown letter/s */
    const HIDDEN_CHARACTER = '_';
    
    protected static $unfinishedStatuses = [
        self::STATUS_INCOMPLETE,
        self::STATUS_ACTIVE,
    ];
    
    protected static $finishedStatuses = [
        self::STATUS_WON,
        self::STATUS_LOST,
    ];
    
    /**
     * Returns available game statuses options in array structure.
     * 
     * @return array game statuses options (status id => status name) pairs
     */
    public static function getStatusesOptions()
    {
        return [
            self::STATUS_INCOMPLETE => 'Incomplete',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_WON => 'Won',
            self::STATUS_LOST => 'Lost',
        ];
    }
    
    /**
     * Returns only the unfinished statuses.
     * 
     * @return array list with unfinished statuses
     */
    public static function getUnfinishedStatuses()
    {
        return static::$unfinishedStatuses;
    }
    
    public static function getFinishedStatuses()
    {
        return static::$finishedStatuses;
    }
    
    public static function start(Player $player, Word $word, $isMulti = false)
    {
        // close all active games of the player
        PlayerHelper::closeAllActiveGames($player);
        
        // create a new game instance
        $game = new Game();
        $game->player_id = $player->id;
        $game->word_id = $word->id;
        $game->status = self::STATUS_ACTIVE;
        $game->word = $word->letters;
        $game->attempts = self::GAME_ATTEMPTS;
        $game->is_multi = (int) $isMulti ?? DatabaseHelper::BOOLEAN_FALSE;
        
        return $game->save() ? $game : null;
    }
    
    public static function openClosedGame(Player $player, Game $game)
    {
        if ($player->id != $game->player_id || $game->status != self::STATUS_INCOMPLETE) {
            return false;
        }
        
        PlayerHelper::closeAllActiveGames($player);
        
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
