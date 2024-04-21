<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Qual Events';
?>
<div class="row justify-content-start mt-3">

    <h1>Events List</h1>
</div>

<ul>
    <?php foreach ($events as $event) : ?>
        <li>
            <div class="container">
                <div class="row justify-content-start mt-3">
                    <div class="col-lg-6 d-flex">
                        <div class="card shadow-lg mb-3">
                            <img class="card-img-top border-bottom" src="<?= Url::to('@web/images/her2.jpeg') ?>" alt="Card image cap" style="width: 550px; height: 300px;" />
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><?= $event['event_name'] ?></h5>
                                    <a href="<?= Url::to(['site/ticket', 'cardName' => $event['event_name']]) ?>" class="btn btn-primary">
                                        Book now
                                    </a>
                                </div>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <?= $event['date'] ?>
                                </h6>
                                <p class="card-text"><?= $event['venue'] ?></p>
                            </div>
                        </div>
                    </div>
        </li>

    <?php endforeach; ?>
</ul>

<!-- https://place-hold.it/500x200 -->