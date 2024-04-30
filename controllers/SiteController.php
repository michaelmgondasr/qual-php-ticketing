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
use app\models\User;
use app\models\UserRegistrationForm;
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
       $db = Yii::$app->db;

        $events = $db->createCommand('SELECT * FROM events')
            ->queryAll();

        return $this->render('index', ['events' => $events]);
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
     * Register action
     * **/

    public function actionRegister()
    {

        $model = new UserRegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Registration successful. please login with your new account');
            return $this->redirect(['site/login']);
        }

        return $this->render('register', [
            'model' => $model,
        ]);
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
            $db = Yii::$app->db;


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
            return $this->redirect(['site/ticket-object', 'name' => $model->name, 'email' => $model->email, 'cardName' => $cardName]);
        }

       $db = Yii::$app->db;

        // Insert into the tickets table
        // Check if the user is logged in and Yii::$app->user->identity is not null
        if (!Yii::$app->user->isGuest && Yii::$app->user->identity !== null) {
            // User is logged in, retrieve the user's information
            $bookerName = Yii::$app->user->identity->user_name;
            $bookerEmail = Yii::$app->user->identity->user_email;

            // Insert into the tickets table
            $db->createCommand()->insert('tickets', [
                'booker_name' => $bookerName,
                'booker_email' => $bookerEmail,
                'booked_event' => $cardName,
            ])->execute();
        } else {
            // User is not logged in, handle the situation accordingly (e.g., redirect to login page)
            Yii::$app->session->setFlash('error', 'You need to be logged in to book a ticket.');
            return $this->redirect(['site/login']);
        }

        // Fetch description for the provided $cardName
        $description = $db->createCommand('SELECT *  FROM events WHERE event_name = :cardName')
            ->bindValue(':cardName', $cardName)
            ->queryOne();

        return $this->render('ticket', [
            'model' => $model,
            'layout' => 'tickets_layout',
            'cardName' => $cardName,
            'description' => $description,
        ]);
    }


    public function actionEvents()
    {
        $db = Yii::$app->db;


        $events = $db->createCommand('SELECT * FROM events')->queryAll();
        return $this->render('events', ['events' => $events]);

        // return $this->render('testing');
    }

    public function actionTicketObject($name = null, $email = null, $cardName = null)
    {

       $db = Yii::$app->db;

        $events = $db->createCommand('SELECT * FROM events')
            ->queryAll();


        return $this->render('ticketObject', [
            'name' => $name,
            'email' => $email,
            'events' => $events,
            'cardName' => $cardName,
        ]);
    }

    public function actionTesting()
    {

       $db = Yii::$app->db;

        $events = $db->createCommand('SELECT * FROM events')->queryAll();

        return $this->render('testing', ['events' => $events]);
    }

    public function actionShowing()
    {

       $db = Yii::$app->db;

        $tickets = $db->createCommand('SELECT * FROM tickets')->queryAll();

        return $this->render('showing', ['tickets' => $tickets]);
    }
}
