<?php

use App\Router;

require '../vendor/autoload.php';


define('PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views');

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();



$router = new Router(PATH);
$router
    ->get('/', 'templates/home/home', 'home')
    ->get('/home', 'templates/home/home')
    ->get('/about', 'templates/about', 'about')
    ->get('/booking', 'templates/home/bookings', 'booking')
    ->get('/menu', 'templates/home/menu/menu', 'menu')
    ->get('/MIY', 'templates/home/makeyours', 'makeyours')
    ->get('/order', 'templates/order/order', 'order')

    ->get('/account-[*:slug]-[i:id]', 'templates/account', 'account')

    ->get('/item/[*:slug]-[i:id]', 'templates/singleItem', 'single-item')

    ->post('/signup', 'templates/ajax/signup', 'signup')
    ->post('/login', 'templates/ajax/login', 'login')
    ->post('/updateDetails', 'templates/ajax/updateDetails', 'updateDetails')
    ->post('/updatePassword', 'templates/ajax/updatePassword', 'updatePassword')
    ->post('/ajaxBooking', 'templates/ajax/ajaxBooking', 'ajaxBooking')
    ->post('/loadOrderMenu', 'templates/ajax/loadOrderMenu', 'loadOrderMenu')
    ->post('/orderItemModal', 'templates/ajax/orderItemModal', 'orderItemModal')
    //change logout route to POST
    ->post('/logout', 'templates/ajax/logout', 'logout')

    
    ->get('/database', 'commands/fillUp', 'data')
    ->run();
?>