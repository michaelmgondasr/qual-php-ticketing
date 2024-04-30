<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\db\Connection;

class EventController extends Controller
{
    public function actionFetchUsers()
    {
        $db = Yii::$app->db;


        $events = $db->createCommand('SELECT * FROM events')->queryAll();
        return $this->render('fetch-events', ['events' => $events]);
    }
}
