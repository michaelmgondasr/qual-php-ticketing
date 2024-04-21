<?php


namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class EventForm extends Model
{
    public $event_name;
    public $date;
    public $venue;
    public $image;
    public $host_name;
    public $host_phone;
    public $host_email;

    public function rules()
    {
        return [
            [['event_name', 'date', 'venue', 'host_name', 'host_phone', 'host_email'], 'required'],
            [['date'], 'date', 'format' => 'yyyy-MM-dd'],
            [['host_email'], 'email'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->image) {

                var_dump($this->image);

                $fileName = 'uploads/' . $this->image->baseName . '.' . $this->image->extension;
                $this->image->saveAs($fileName);
                return $fileName;
            }
            return null;
        }
        return null;
    }
}
