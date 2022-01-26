<?php

use App\Config;
use App\Table\MenuTable;

$pdo = Config::getPDO();
$table = new MenuTable($pdo);



?>



<?= $table->getMenu() ?>





<script type="text/javascript">


menuGlide("#classic_glide");
menuGlide("#old_fashion_glide");
menuGlide("#fancy_glide");
menuGlide("#wines_glide");
menuGlide("#beers_glide");
menuGlide("#ciders_glide");
menuGlide("#soft_glide");
menuGlide("#juices_glide");
menuGlide("#hot_drinks_glide");



</script>