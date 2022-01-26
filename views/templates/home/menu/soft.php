<?php

use App\Config;
use App\Table\MenuTable;

$pdo = Config::getPDO();
$table = new MenuTable($pdo);



?>





<hr class="hr-section">
<div class="softPin pin">
    <!--<div class="canvasContainer">
        <canvas class="softCanvas canvas" id="softCanvas"></canvas>
    </div> -->
    <div class="contentContainer">
        <h2 class="soft_header">SOFT<br>DRINKS</h2>
        <?= $table->getMenu("soft", "soft") ?>
        <?= $table->getMenu("soft", "juices") ?>
        <?= $table->getMenu("soft", "hot_drinks") ?>
    </div>
</div>





<script type="text/javascript">

//animateCanvas("softCanvas", 1200, 2952, 73, "media/softFrame/cans03", ".softPin", "top", "bottom", true, false);

menuGlide("#soft_glide");
menuGlide("#juices_glide");
menuGlide("#hot_drinks_glide");





</script>
