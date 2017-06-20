<?php

namespace common\helpers;

use yii\helpers\ArrayHelper;
use common\models\{Game, GameAction};

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class GameActionHelper extends BaseHelper
{
    /** @var integer letter type flag */
    const TYPE_LETTER = 1;
    /** @var integer (full)word type flag */
    const TYPE_WORD = 2;
    
    public static function getTypesOptions()
    {
        return [
            self::TYPE_LETTER => 'Letter',
            self::TYPE_WORD => 'Word',
        ];
    }
    
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
    
    public static function countFailures(Game $game)
    {
        return GameAction::find()->where(['game_id' => $game->id, 'success' => DatabaseHelper::BOOLEAN_FALSE])->count('id');
    }
    
    public static function getLetters(Game $game)
    {
        return ArrayHelper::map($game->gameActions, 'input', 'success');
    }
    
    protected static function determineType(string $input)
    {
        if (mb_strlen($input) > 1) {
            return self::TYPE_WORD;
        }
        
        return self::TYPE_LETTER;
    }
    
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
}
