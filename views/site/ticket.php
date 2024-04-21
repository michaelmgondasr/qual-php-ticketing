<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
?>
<div class="text-start"></div>

<?php 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact text-center">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('ticketFormSubmitted')) : ?>

        <div class="alert alert-success">
            Thank you for booking with us, your ticket will be shown down below 
        </div>

        <?php echo $this->renderFile('@app/views/site/ticketObject.php') ?>

    <?php else : ?>

        <?php if ($cardName !== null) : ?>
            <h2><?= $cardName ?></h2>
        <?php endif; ?>

        <p>
            Fill out the following form to book for your ticket.
            Thank you.
        </p>

        <div class="row justify-content-center text-start">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone') ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>
</div>
