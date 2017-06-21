<?php

namespace common\helpers;

use yii\helpers\ArrayHelper;
use common\models\{Game, GameAction};

/**
 * Basic game action helper class.
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 * @since 1.0
 */
class GameActionHelper extends BaseHelper
{
    /** @var integer letter type flag */
    const TYPE_LETTER = 1;
    /** @var integer (full)word type flag */
    const TYPE_WORD = 2;
    
    /**
     * Returns an array with all action types.
     * 
     * @return array all action types
     */
    public static function getTypesOptions()
    {
        return [
            self::TYPE_LETTER => 'Letter',
            self::TYPE_WORD => 'Word',
        ];
    }
    
    /**
     * Creates a new game action as determines its type and success flag.
     * 
     * @param Game $game the specific game instance
     * @param string $input
     * @return GameAction|null if the creation is successful then return action object, otherwise null
     */
    public static function create(Game $game, string $input)
    {
        if ($game->status != GameHelper::STATUS_ACTIVE) {
            return;
        }
        
        // create a new game action instance
        $action = new GameAction(['game_id' => $game->id, 'input' => $input]);
        $action->type = static::determineType($input);
        $action->success = (int) static::checkIsSuccess($game, $action);
        
        return $action->save() ? $action : null;
    }
    
    /**
     * Returns the number of the fail actions for a specific game.
     * 
     * @param Game $game the game instance
     * @return integer the number of fail actions
     */
    public static function countFailures(Game $game)
    {
        return GameAction::find()->where(['game_id' => $game->id, 'success' => DatabaseHelper::BOOLEAN_FALSE])->count('id');
    }
    
    /**
     * Pulls game actions, prepares them like array structure and returns.
     * 
     * @param Game $game
     * @return array all tried actions like (input => success) pairs
     */
    public static function getLettersArray(Game $game)
    {
        return ArrayHelper::map($game->gameActions, 'input', 'success');
    }
    
    /**
     * Returns a list with tried actions letters based on above method.
     * 
     * @param Game $game
     * @return array all tried letters list
     */
    public static function getLettersList(Game $game)
    {
        return array_keys(static::getLettersArray($game));
    }
    
    /**
     * Reconsiders the game status after a new action is created.
     * 
     * @param GameAction $action specific game action instance
     * @return integer|null the new game status or null
     */
    public static function considerGameStatus(GameAction $action)
    {
        switch ($action->type) {
            case self::TYPE_LETTER:
                return static::considerStatusLetterType($action);
            case self::TYPE_WORD:
                return static::considerStatusWordType($action);
            default:
                return;
        }
    }
    
    /**
     * Decides the input type and returns the result.
     * 
     * @param string $input
     * @return integer the input type
     */
    protected static function determineType(string $input)
    {
        if (mb_strlen($input) > 1) {
            return self::TYPE_WORD;
        }
        
        return self::TYPE_LETTER;
    }
    
    /**
     * Determines the value for action "success" flag.
     * 
     * @param Game $game the game instance
     * @param GameAction $action game action instance
     * @return boolean the result from checking
     */
    protected static function checkIsSuccess(Game $game, GameAction $action)
    {
        switch ($action->type) {
            case self::TYPE_LETTER:
                return static::checkLetterType($game->word, $action->input);
            case self::TYPE_WORD:
                return static::checkWordType($game->word, $action->input);
            default:
                return false;
        }
    }
    
    protected static function checkLetterType(string $word, string $letter)
    {
        return mb_stripos($word, $letter) !== false;
    }
    
    protected static function checkWordType(string $word, string $input)
    {
        return strcasecmp($word, $input) === 0;
    }
    
    protected static function considerStatusLetterType(GameAction $action)
    {
        if ($action->success == DatabaseHelper::BOOLEAN_TRUE) {
            if (!in_array(GameHelper::HIDDEN_CHARACTER, GameHelper::hideWord($action->game, static::getLettersList($action->game)))) {
                return GameHelper::STATUS_WON;
            }
        } else {
            if (static::countFailures($action->game) >= $action->game->attempts) {
                return GameHelper::STATUS_LOST;
            }
        }
    }
    
    protected static function considerStatusWordType(GameAction $action)
    {
        if ($action->success == DatabaseHelper::BOOLEAN_TRUE) {
            return GameHelper::STATUS_WON;
        }
        
        return GameHelper::STATUS_LOST;
    }
}
