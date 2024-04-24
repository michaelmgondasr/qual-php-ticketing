<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>
<div class="text-start"></div>

<?php
$this->title = 'event details';
$this->params['breadcrumbs'][] = $this->title;
?>

<head>

    <link rel="stylesheet" href="css/ticket_text.css">
</head>

<div class="site-contact ">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (Yii::$app->session->hasFlash('ticketFormSubmitted')) : ?>

        <div class="alert alert-success">
            Thank you for booking with us, your ticket will be shown down below
        </div>

        <?php echo $this->renderFile('@app/views/site/ticketObject.php') ?>

    <?php else : ?>

        <?php if ($cardName !== null) : ?>
            <!-- card starts here -->
            <?php $form = ActiveForm::begin(['id' => 'ticket-form']); ?>

            <?php $imageUrl = Url::to('@web/images/' . $description['image']); ?>


            <div class="projcard-container">


                <div class="projcard projcard-green">
                    <div class="projcard-innerbox">
                        <img class="projcard-img" src="<?= $imageUrl ?>" />
                        <div class="projcard-textbox">
                            <div class="projcard-title"><?= $cardName ?></div>
                            <div class="projcard-subtitle">You know what this is by now</div>
                            <div class="projcard-bar"></div>
                            <div class="projcard-description"><?= $description['event_description'] ?></div>
                            <div class="projcard-tagbox">
                                <span class="projcard-tag"><?= $description['date'] ?></span>
                                <span class="projcard-tag"><?= $description['venue'] ?></span>
                                <?php
                                // Check if the user is logged in
                                if (!Yii::$app->user->isGuest) {
                                    // User is logged in, display the book button
                                    echo Html::submitButton('Book', ['class' => 'btn-ticket btn-primary', 'name' => 'ticket-form']);
                                } else {
                                    // User is not logged in, redirect to the login page
                                    $loginUrl = Url::to(['site/login']);
                                    echo Html::a('Login to Book', $loginUrl, ['class' => 'btn btn-primary']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <?php ActiveForm::end(); ?>
            <!-- card ends here -->

        <?php endif; ?>


        <div class="row justify-content-center text-start">
            <div class="col-lg-5">

                <div class="form-group">
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>
