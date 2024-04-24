// UserController.php

<?php 
use yii\web\Controller;
use app\models\User;
use yii\web\IdentityInterface;

class UserController extends Controller
{
    public function actionRegister()
    {
        $model = new User();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['login']);
        }
        
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new app\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
