<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Qual Events';
?>
<div class="container px-lg-5">
    <div id="hero" class="p-4 p-lg-5 bg-light rounded-3 text-center">
        <div class="m-4 m-lg-5">
            <h1 class="display-5 fw-bold">Welcome to Your Ultimate Event Experience!</h1>
            <p class="fs-4">Step into a world of limitless possibilities. Discover and book the hottest events in town with ease. Your unforgettable experience begins here</p>
            <a class="btn btn-primary btn-lg" href="<?php echo Url::to(['events']) ?>">Book now</a>
        </div>
    </div>

    <section class="pt-5">
<div class="row justify-content-start mt-3">
    <p class="container-title"> Here are some of our Favourite Events</p>
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
                    <i class="bi bi-calendar-date px-2"></i>
                        <?= $event['date'] ?>
                    </h6>
                    <div class='d-flex justify-content-between '>
                        <p class="card-text d-flex ">
                        <i class="bi bi-geo-alt px-2"></i>
                            <?= $event['venue'] ?>
                        </p>
                        <a href="<?= Url::to(['site/ticket', 'cardName' => $event['event_name']]) ?>" class="btn btn-primary mr-5">
                                Details
                            </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>





</div>
</section>