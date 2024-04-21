<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;



$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

?>

<div class="row">
<div class="col-lg-5">

    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'event_name')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <?= $form->field($model, 'venue') ?>


   <div class='py-2'>  <?= $form->field($model, 'image')->fileInput() ?> </div>

    <?= $form->field($model, 'host_name') ?>
    <?= $form->field($model, 'host_phone') ?>

    <?= $form->field($model, 'host_email') ?>

    <div class="form-group py-2">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>

<!-- ActiveForm::end(); -->

<!-- // echo $form->field($model, 'event_name'); -->
<!-- // echo $form->field($model, 'date')->input('date'); -->
<!-- // echo $form->field($model, 'venue'); -->
<!-- // echo $form->field($model, 'image')->fileInput(); -->
<!-- // echo $form->field($model, 'host_name'); -->
<!-- // echo $form->field($model, 'host_phone'); -->
<!-- // echo $form->field($model, 'host_email'); -->

<!-- // echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); -->
