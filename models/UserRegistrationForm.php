<?php

namespace app\models;

use Yii;
use yii\base\Model;

use yii\db\Connection;



class UserRegistrationForm extends Model
{
    public $user_name;
    public $password;
    public $password2;
    public $user_email;





    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['user_name', 'password', 'password2', 'user_email'], 'required'],

            ['user_email','email'],

            ['password2', 'compare', 'compareAttribute'=> 'password', 'message'=> "passwords don't match"],
        ];
    }


    public function save()
{
    // Check if username or email already exists
    $existingUser = User::find()->where(['user_name' => $this->user_name])->orWhere(['user_email' => $this->user_email])->one();

    if ($existingUser) {
        if ($existingUser->user_name === $this->user_name) {
            $this->addError('user_name', 'Username is already taken.');
        }
        if ($existingUser->user_email === $this->user_email) {
            $this->addError('user_email', 'Email is already taken.');
        }
        return false;
    }

    $db = Yii::$app->db;

    $db->createCommand()->insert('user', [
        'user_name' => $this->user_name,
        'password' => $this->password,
        'user_email' => $this->user_email,
    ])->execute();

    return true;
}


public function attributeLabels()
{
    return [
        'user_name' => 'username', // Specify the label for the username attribute
        'password' => 'password',
        'password2' => 'confirm password',
        'user_email' => 'email',
    ];
}





}
