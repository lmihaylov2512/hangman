<?php

namespace frontend\models;

use yii\base\Model;
use common\models\Player;
use common\helpers\PlayerHelper;

/**
 * 
 * @author Lachezar Mihaylov <contact@lmihaylov.com>
 */
class SignupForm extends Model
{
    public $email;
    public $password;
    public $password_repeat;
    public $first_name;
    public $last_name;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'password_repeat', 'first_name', 'last_name'], 'required'],
            [['email', 'first_name', 'last_name'], 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 128],
            ['email', 'unique', 'targetClass' => Player::className(), 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['first_name', 'last_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return;
        }
        
        $user = new Player(['status' => PlayerHelper::STATUS_ACTIVE, 'email' => $this->email, 'first_name' => $this->first_name, 'last_name' => $this->last_name]);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
