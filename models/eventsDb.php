<?php

namespace app\models;

use Yii;

class MyModel extends \yii\db\ActiveRecord
{
    // Define properties corresponding to your database table columns
    public $id;
    public $event_name;
    public $date;
    public $venue;
    public $image;
    public $host_name;
    public $host_phone;
    public $host_email;

    // ... other model properties and methods

    public static function tableName()
    {
        return 'events'; // Replace with your actual table name
    }
}
