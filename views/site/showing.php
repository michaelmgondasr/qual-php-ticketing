<?php

// Begin your PHP code here if needed
use yii\widgets\DetailView;
use yii\bootstrap5\Tabs;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" href="css/showing.css">
</head>

<div>

<div class="container ">
      <h1>Tickets sold</h1>
    <table>
        
        <thead>
            <tr>
                <th>Ticket id</th>
                <th>Booker name</th>
                <th>Booked Event</th>
                <th>Booker email</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($tickets as $ticket) : ?>

            <tr>
                <td><?= $ticket['id'] ?></td>
                <td><?= $ticket['booker_name'] ?></td>
                <td><?= $ticket['booked_event'] ?></td>
                <td><?= $ticket['booker_email'] ?></td>
            </tr>
       <?php endforeach ?>
        </tbody>     
        
    </table>
    </div>

</div>

<?php

// End your PHP code here if needed

echo "showing tickets";

?>
