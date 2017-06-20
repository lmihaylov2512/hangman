<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "multi_game".
 *
 * @property string $primary_id
 * @property string $secondary_id
 * @property string $created_at
 *
 * @property Game $primary
 * @property Game $secondary
 */
class MultiGame extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'multi_game';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['primary_id', 'secondary_id'], 'required'],
            [['primary_id', 'secondary_id'], 'integer'],
            [['created_at'], 'safe'],
            [['primary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['primary_id' => 'id']],
            [['secondary_id'], 'exist', 'skipOnError' => true, 'targetClass' => Game::className(), 'targetAttribute' => ['secondary_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'primary_id' => 'Primary ID',
            'secondary_id' => 'Secondary ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimary()
    {
        return $this->hasOne(Game::className(), ['id' => 'primary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondary()
    {
        return $this->hasOne(Game::className(), ['id' => 'secondary_id']);
    }
}
