<?php

namespace common\helpers;

use yii\helpers\ArrayHelper;
use common\models\{Game, GameAction};

class GameActionHelper extends BaseHelper
{
    const TYPE_LETTER = 1;
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
        $action = new GameAction(['game_id' => $game->id, 'input' => $input]);
        $action->type = static::determineType($input);
        $action->success = static::checkIsSuccess($game, $action);
        
        $action->save();
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
            case self::TYPE_LETTER: return static::checkLetterType($game->word, $action->input);
            case self::TYPE_WORD: return static::checkWordType($game->word, $action->input);
            default: return false;
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
