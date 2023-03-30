<table class="table table-striped">
    <thead>
    <tr>
        <th class="text-center"> tela</th>
        <th class="text-center"> color</th>
        <th class="text-center"> talla</th>
        <th class="text-center"> en existencia</th>
    </tr>
    </thead>
    <tbody>
    <?php
    include '../resources/db/PlayeraDB.php';
    $playeraDB = new PlayeraDB();
    $playeras = $playeraDB->getPlayeras();
    foreach ($playeras as $playera):?>
        <tr>
            <td class="text-center"><?= $playera['tela'] ?></td>
            <td class="text-center"><?= $playera['color'] ?></td>
            <td class="text-center"><?= $playera['talla'] ?></td>
            <td class="text-center"><?= $playera['existencia'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
