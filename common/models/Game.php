<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "game".
 *
 * @property string $id
 * @property string $player_id
 * @property string $word_id
 * @property integer $status
 * @property string $word
 * @property integer $attempts
 * @property string $started_at
 * @property string $finished_at
 * @property string $closed_at
 * @property string $opened_at
 *
 * @property Player $player
 * @property Word $word0
 * @property GameAction[] $gameActions
 */
class Game extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['player_id', 'word_id', 'status', 'word', 'attempts'], 'required'],
            [['player_id', 'word_id', 'status', 'attempts'], 'integer'],
            [['started_at', 'finished_at', 'closed_at', 'opened_at'], 'safe'],
            [['word'], 'string', 'max' => 64],
            [['player_id'], 'exist', 'skipOnError' => true, 'targetClass' => Player::className(), 'targetAttribute' => ['player_id' => 'id']],
            [['word_id'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'player_id' => 'Player ID',
            'word_id' => 'Word ID',
            'status' => 'Status',
            'word' => 'Word',
            'attempts' => 'Attempts',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'closed_at' => 'Closed At',
            'opened_at' => 'Opened At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayer()
    {
        return $this->hasOne(Player::className(), ['id' => 'player_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWord0()
    {
        return $this->hasOne(Word::className(), ['id' => 'word_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGameActions()
    {
        return $this->hasMany(GameAction::className(), ['game_id' => 'id']);
    }
}
