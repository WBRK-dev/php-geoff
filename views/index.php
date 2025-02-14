<?php

use App\Models\Beer;

$biers = Beer::query()->get();

?>
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Likes</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($biers as $bier) : ?>
            <tr>
                <td><?= $bier->id ?></td>
                <td><?= $bier->name ?></td>
                <td><?= $bier->brewer ?></td>
                <td>0</td>
                <td>
                    <button>Like</button>
                    <button>Dislike</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>