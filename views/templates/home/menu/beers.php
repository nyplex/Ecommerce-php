<?php

use App\Config;
use App\Table\MenuTable;

$pdo = Config::getPDO();
$table = new MenuTable($pdo);

?>


<hr class="hr-section">
<div class="beersPin pin">
    <!--<div class="canvasContainer">
        <canvas class="beersCanvas canvas" id="beersCanvas"></canvas>
    </div> -->
    <div class="contentContainer">
        <h2 class="beers_header">WINES,<br>BEERS & CIDERS</h2>
        <?= $table->getMenu("beers", "wines") ?>
        <?= $table->getMenu("beers", "beers") ?>
        <?= $table->getMenu("beers", "ciders") ?>
    </div>
</div>


<script type="text/javascript">

    //animateCanvas("beersCanvas", 1200, 2952, 90, "media/wineFrame/01.png", ".beersPin", "top", "bottom", true, false);

    menuGlide("#wines_glide");
    menuGlide("#beers_glide");
    menuGlide("#ciders_glide");

</script>
