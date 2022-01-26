<?php

use App\Auth;
use App\Config;
use App\Table\MenuTable;
use App\Table\UserTable;

$pdo = Config::getPDO();
$menuOrder = new MenuTable($pdo);
$loggedIn = Auth::check();
$u = new UserTable($pdo);

if($loggedIn === true) {
    $userID = (int)$_SESSION['auth'];
    $user = $u->find($userID);
    $userName = $user->getF_name();
}elseif($loggedIn === false){
    $userName = "Guest";
}

?>

<!-- Menu Item Modal -->
<div id="orderItemModal" class="modal">
  
</div>

<div class="orderMainContainer">
    <div class="orderHeader">
        <div class="orderHeaderTitle">
            <h1 style="text-align:left">ORDER<br>ONLINE</h1>
        </div>
        <div class="orderHeaderImg">
            <img src="media/cocktailFire.jpg" alt="cocktial on fire img">
            <img src="media/cocktailFire.jpg" alt="cocktial on fire img">
            <img src="media/cocktailFire.jpg" alt="cocktial on fire img">
        </div>
        <div class="orderHeaderTitle">
            <h1 style="text-align:right">EASY &<br>FAST</h1>
        </div>
    </div>
    <div class="orderBanner">
        <p>Sorry, online ordering is currently closed. We’re not taking orders right now.</p>
    </div>
    <div class="orderMainContent">
        <div class="orderSection">
            <div class="orderGuestAvatar">
                <i class="far fa-user-circle"></i>
                <h6>Hi, <?= $userName ?></h6>
            </div>
            <div class="orderCategories">
                <?= $menuOrder->getOrderSection();?>
            </div>
        </div>
        <div id="orderMenuLoader" class="menuLoader">
                <img src="media/loading.gif" alt="">
        </div>
        <div class="orderMenu">
        </div>
        <div class="orderBasket"></div>
    </div>
</div>

<script>

$(document).ready(function(){
    $('.orderSubCategories').first().css('display', 'block');
    $('.orderSubCategory').first().addClass('sectionSelected');
    let subCatId = $('.orderSubCategory').first().attr('id');
    console.log(subCatId);
    $.ajax({
        type: 'POST',
        url: '/loadOrderMenu',
        data: {
            'sub_category': subCatId
        },
        success: function(response) {
            let data = JSON.parse(response);
            $('.orderMenu').empty();
            $('.orderMenu').append(data);
        }
    })
})

function openSection(section){
    let nextSection = $(section).next();
    $(section).next().slideToggle('slow')
    $('.orderSubCategories').not(nextSection).each(function(index){
        $(this).slideUp('slow');
    })
}

function subCategoriesSelected(subCategory){
    $('.orderSubCategory').not(subCategory).removeClass('sectionSelected');
    $(subCategory).addClass('sectionSelected');
}

function loadOrderMenu(subCategory, category){
    $('.orderMenu').empty();
    $('#orderMenuLoader').css('display', 'block');
    $.ajax({
        type: 'POST',
        url: '/loadOrderMenu',
        data: {
            'category': category,
            'sub_category': subCategory
        },
        success: function(response) {
            setTimeout(function(){
                let data = JSON.parse(response);
                $('.orderMenu').append(data);
                $('#orderMenuLoader').css('display', 'none');
            }, 300)
            
        }
    })
}

function closeOrderItemModel(){
    $('#orderItemModal').css('display', 'none');
    $('#orderItemModal').empty();
}

function openOrderItemModal(itemId){
    var id = itemId.substring(itemId.indexOf("_") + 1);
    let orderItemModal = $('#orderItemModal');

    $.ajax({
        type: 'POST',
        url: 'orderItemModal',
        data: {
            'id': id
        },
        success: function(response){
            var json = JSON.parse(response);
            orderItemModal.append(json);
            orderItemModal.css('display', 'block');
        }
    })
    
    
}








</script>