<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TicketForm;
use app\models\EventForm;
use yii\web\UploadedFile;

use yii\db\Connection;


class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
            'username' => 'root',
            'password' => '',
        ]);
        
        $events = $db->createCommand('SELECT * FROM events')
        ->queryAll();

        return $this->render('index',['events'=>$events]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPosting()
    {
        $model = new EventForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $imagePath = $model->upload();

            // Insert data into the database
            // Adjust this code based on your database schema
            $db = new Connection([
                'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
                'username' => 'root',
                'password' => '',
    
            ]);

            $db->createCommand()->insert('events', [
                'event_name' => $model->event_name,
                'date' => $model->date,
                'venue' => $model->venue,
                'image' => $imagePath,
                'host_name' => $model->host_name,
                'host_phone' => $model->host_phone,
                'host_email' => $model->host_email,
            ])->execute();

            // Redirect or do something else after successful submission
            return $this->refresh();
        }

        return $this->render('postingevents', ['model' => $model]);
    }

    public function actionTicket($cardName = null)
    {
        $model = new TicketForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('ticketFormSubmitted');
            return $this->actionTicketObject($model->name, $model->email, $cardName);
        }
        return $this->render('ticket', [
            'model' => $model,
            'layout' => 'tickets_layout',
            'cardName' => $cardName,
            
            
        ]);
    }

    public function actionEvents()
    {
        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
            'username' => 'root',
            'password' => '',

        ]);

        $events = $db->createCommand('SELECT * FROM events')->queryAll();
        return $this->render('events', ['events' => $events]);

        // return $this->render('testing');
    }

    public function actionTicketObject($name=null, $email=null, $cardName=null)
    {
        
        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
            'username' => 'root',
            'password' => '',
        ]);
        
        $events = $db->createCommand('SELECT * FROM events')
        ->queryAll();
                        

        return $this->render('ticketObject',[
            'name'=> $name,
            'email'=> $email,
            'events' => $events,
            'cardName' => $cardName,
        ]);
    }

    public function actionTesting(){

        $db = new Connection([
            'dsn' => 'mysql:host=localhost;dbname=php-ticketing',
            'username' => 'root',
            'password' => '',
        ]);

        $events = $db->createCommand('SELECT * FROM events')->queryAll();

        return $this->render('testing', ['events' => $events]);
    }

    
}
