<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class TicketForm extends Model
{
    public $name;
    public $email;
    public $phone;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['phone', 'match', 'pattern' => '^0',],

        ];
    }

  
}