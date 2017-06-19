<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "game_action".
 *
 * @property string $id
 * @property string $game_id
 * @property integer $type
 * @property string $input
 * @property integer $success
 * @property string $created_at
 *
 * @property Game $game
 */
class GameAction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'game_action';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['game_id', 'type', 'input', 'success'], 'required'],
            [['game_id', 'type', 'success'], 'integer'],
            [['created_at'], 'safe'],
            [['input'], 'string', 'max' => 64],
            [['game_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['game_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'game_id' => 'Game ID',
            'type' => 'Type',
            'input' => 'Input',
            'success' => 'Success',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGame()
    {
        return $this->hasOne(Game::className(), ['id' => 'game_id']);
    }
}
