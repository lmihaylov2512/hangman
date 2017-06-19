<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use common\helpers\PlayerHelper;

/**
 * This is the model class for table "player".
 *
 * @property string $id
 * @property integer $status
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Game[] $games
 */
class Player extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'player';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['email', 'password', 'auth_key', 'first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['email'], 'string', 'max' => 128],
            [['password'], 'string', 'max' => 64],
            [['auth_key', 'first_name', 'last_name'], 'string', 'max' => 32],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['player_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => PlayerHelper::STATUS_ACTIVE]);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => PlayerHelper::STATUS_ACTIVE]);
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    /**
     * Validates user password.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    /**
     * Generates password hash from password and sets it to the model.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * Generates "remember me" authentication key.
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
