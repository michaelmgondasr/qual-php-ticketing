<?php

namespace app\controllers;

use yii\web\Controller;
use yii\db\Connection;

class EventController extends Controller
{
    public function actionFetchUsers()
    {
        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
            'username' => 'root',
            'password' => '',
        ]);

        $events = $db->createCommand('SELECT * FROM events')->queryAll();
        return $this->render('fetch-events', ['events' => $events]);
    }
}
