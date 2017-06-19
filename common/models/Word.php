<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property string $id
 * @property string $category_id
 * @property string $letters
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Game[] $games
 * @property Category $category
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'letters'], 'required'],
            [['category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['letters'], 'string', 'max' => 64],
            [['letters'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'letters' => 'Letters',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['word_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
