<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'QUal Events';
?>
<div class="container px-lg-5">
    <div id="hero" class="p-4 p-lg-5 bg-light rounded-3 text-center">
        <div class="m-4 m-lg-5">
            <h1 class="display-5 fw-bold">Welcome to Your Ultimate Event Experience!</h1>
            <p class="fs-4">Step into a world of limitless possibilities. Discover and book the hottest events in town with ease. Your unforgettable experience begins here</p>
            <a class="btn btn-primary btn-lg" href="<?php echo Url::to(['events']) ?>">Call to action</a>
        </div>
    </div>

    <section class="pt-5">
        <div class="container">
            <p class="container-title">Here are the features<br>we’re proud of</p>


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

        </div>




</div>
</section>