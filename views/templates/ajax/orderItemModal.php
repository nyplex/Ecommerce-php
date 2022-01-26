<?php 

use App\Config;
use App\Table\MenuTable;

$pdo = Config::getPDO();
$menuTable = new MenuTable($pdo);
$item = $menuTable->find((int)$_POST['id']);

$html = "<div class='modal-content'>
            <span onclick='closeOrderItemModel()' id='closeOrderItemModal' class='close'><i class='fas fa-times-circle'></i></span>
            <div class='orderImgModal'>
                <img src='".$item->getImage()."' alt=''>
            </div>
            <h1>".$item->getTitle()."</h1>
            <h2>£".$item->getPrice()."</h2>
            <div class='orderQtyModal'>
                <i class='fas fa-minus-circle minusIcon'></i>
                <input disabled type='text' id='itemModal_".$item->getId()."' value='1'>
                <i class='fas fa-plus-circle plusIcon'></i>
            </div>
            <button class='signupButton button button_submit'>ADD TO BASKET</button>
        </div>";
echo json_encode($html);
exit();