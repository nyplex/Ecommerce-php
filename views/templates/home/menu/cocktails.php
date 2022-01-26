<?php

use App\Config;
use App\Table\MenuTable;

$pdo = Config::getPDO();
$table = new MenuTable($pdo);



?>



<?= $table->getMenu() ?>





<script type="text/javascript">

//animateCanvas("cocktailCanvas", 1000, 1200, 100, "media/mojitoFrame/", ".cocktailsPin", "top", "bottom", true, false);

menuGlide("#classic_glide");
menuGlide("#old_fashion_glide");
menuGlide("#fancy_glide");




</script>