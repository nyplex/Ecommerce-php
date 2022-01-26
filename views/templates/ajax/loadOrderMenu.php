<?php

use App\Config;
use App\Model\Menu;

$pdo = Config::getPDO();

$sub_category = $_POST['sub_category'];

$query = $pdo->prepare("SELECT * FROM menu WHERE sub_category = '{$sub_category}' ORDER BY title");
$query->execute();
$query->setFetchMode(PDO::FETCH_CLASS, Menu::class);
$items = $query->fetchAll();
$cat = str_replace("_", " ", $items[0]->getSub_category());
$cat = strtoupper($cat);
$return = "<div class='orderMenuHeader'>
            <h1>".$cat."</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam sit amet auctor odio.</p>
        </div>
        <div class='orderMenuItemsContainer'>";
foreach($items as $item) {
    $return .= "<div onclick='openOrderItemModal(this.id)' class='item' id='orderItemMenu_".$item->getId()."'>
                    <div class='itemImgContainer'>
                        <img src='".$item->getImage()."' alt=''>
                    </div>
                    <div class='itemDetails'>
                        <h4>".$item->getTitle()."</h4>
                        <h6>£".$item->getPrice()."</h6>
                    </div>
                </div>";
}

$return .= "</div>";
echo json_encode($return);
exit();
