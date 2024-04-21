<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Qual Events';
?>
<div class="row justify-content-start mt-3">
    <div class="col">
        <h1>Events List</h1>
    </div>
</div>

<div class="row">
    <?php foreach ($events as $event) : ?>

        <?php
                // Assuming $event['image'] contains the image URL stored in the database
                $imageUrl = Url::to('@web/images/' . $event['image']);
                ?>

        <div class="col-lg-6 mb-3">
            <div class="card shadow-lg">
            <img class="card-img-top border-bottom" src="<?= $imageUrl ?>" alt="Card image cap" style="width: auto; height: auto;" />
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title"><?= $event['event_name'] ?></h5>
                        
                    </div>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <?= $event['date'] ?>
                    </h6>
                    <p class="card-text d-flex justify-content-between ">
                        <?= $event['venue'] ?>
                        <a href="<?= Url::to(['site/ticket', 'cardName' => $event['event_name']]) ?>" class="btn btn-primary">
                            Book now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- https://place-hold.it/500x200 -->