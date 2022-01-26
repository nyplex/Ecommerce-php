<?php

use App\Config;
use App\Table\MenuTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Config::getPDO();
$item = (new MenuTable($pdo))->find($id); 

if($item === false) {
    $url = $router->url('home');
    header('Location: ' . $url);
    exit();
}

if($item->getSlug() !== $slug) {
    $url = $router->url('single-item', ['slug' => $item->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: ' . $url);
}

?>

<div class="contentContainer itemContainer">
    <img src="<?= $item->getImage() ?>" alt="">
    <div class="itemMainContent">
    <i id="goBackIcon" class="fas fa-arrow-circle-left"></i>
        <div class="itemContent">
            <div class="itemTitle">
                <h1><?= $item->getTitle() ?></h1>
            </div>
            <div class="itemPrice">
                <h1>£<?= $item->getPrice() ?></h1>
                <button class="button orderButton">ORDER</button>
            </div>
        </div>
        <div class="itemDescription">
            <p><?= $item->getDescription() ?></p>
        </div>
    </div>
</div>


<script>
    $('#goBackIcon').click(function(){
        window.history.back();
    })
</script>