<?php

use App\Models\Beer;

$beers = Beer::query()->get();

?>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Brewer</th>
            <th>Likes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($beers as $beer) : ?>
            <tr>
                <td><?= $beer->id ?></td>
                <td><?= $beer->name ?></td>
                <td><?= $beer->brewer ?></td>
                <td>0</td>
                <td>
                    <button>Like</button>
                    <button>Dislike</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>