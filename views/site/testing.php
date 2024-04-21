<?php
// use yii\bootstrap5\Html;
use yii\helpers\Url;


echo"testing";

// foreach($events as $event):
//     echo $event['event_name'];
// endforeach;
?>

<head>
    <link rel="stylesheet" href="css/cards.css">
</head>

<div class="card-deck">
  <div class="card shadow-lg mb-3">
  <img class="card-img-top border-bottom" src="<?= Url::to('@web/images/her2.jpeg') ?>" alt="Card image cap" style="width: 550px; height: 300px;" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card shadow-lg mb-3">
  <img class="card-img-top border-bottom" src="<?= Url::to('@web/images/her2.jpeg') ?>" alt="Card image cap" style="width: 550px; height: 300px;" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card shadow-lg mb-3">
  <img class="card-img-top border-bottom" src="<?= Url::to('@web/images/her2.jpeg') ?>" alt="Card image cap" style="width: 550px; height: 300px;" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card shadow-lg mb-3">
  <img class="card-img-top border-bottom" src="<?= Url::to('@web/images/her2.jpeg') ?>" alt="Card image cap" style="width: 550px; height: 300px;" />
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>