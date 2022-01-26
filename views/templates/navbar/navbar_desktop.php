<div class="main-navbar">
    <div class="navbar-desktop">
        <div class="navbar-logo">
            <a href=""><img src="media/logo/logo.png" alt=""></a>
        </div>
        <div class="navbar-menu">
            <ul>
                <li class="menuButton"><a href="<?= $router->url('menu') ?>">MENU</a></li>
                <li><a href="<?= $router->url('order') ?>">ORDER</a></li>
                <li class="bookingButton"><a href="<?= $router->url('booking') ?>">BOOKING</a></li>
                <li class="makeYoursButton"><a href="<?= $router->url('makeyours') ?>">MAKE YOURS</a></li>
                <li class="aboutButton"><a href="<?= $router->url('about') ?>">ABOUT</a></li>
            </ul>
        </div>
        <div class="navbar-login">
            <?= $btn ?>
        </div>
    </div>
</div>
<div class="navbar-bottom-border"></div>
<div class="navbar-hr">
    <hr>
</div>



