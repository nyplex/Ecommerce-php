<div class="navbar-mobile">
    <div class="navbar-logo-mobile">
        <a href=""><img src="media/logo/logo.png" alt=""></a>
    </div>
    <div class="navbar-icon">
        <i class="fas fa-bars" id="mobile-menu-icon"></i>
    </div>
</div>
<div class="side-menu-mobile" id="side-menu">
    <div class="menu-mobile">
        <ul>
            <li class="menuButton"><a href="<?= $router->url('menu') ?>">MENU</a></li>
                <hr class="hr-menu-mobile">
            <li><a href="<?= $router->url('order') ?>">ORDER</a></li>
                <hr class="hr-menu-mobile">
            <li class="bookingButton"><a href="<?= $router->url('booking') ?>">BOOKING</a></li>
                <hr class="hr-menu-mobile">
            <li class="makeYoursButton"><a href="<?= $router->url('makeyours') ?>">MAKE YOURS</a></li>
                <hr class="hr-menu-mobile">
            <li class="aboutButton"><a href="<?= $router->url('about') ?>">ABOUT</a></li>
        </ul>
    </div>
    <div class="navbar-mobile-login">
        <button>LOGIN</button>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#mobile-menu-icon').click(function(){
            let side_menu = $('#side-menu');
            if(side_menu.hasClass("side-menu-opened")) {
                $('#side-menu').animate({right: '-250px'}, 400, 'swing');
                setTimeout(function(){
                    side_menu.removeClass("side-menu-opened");
                },410);

            }else{
                side_menu.addClass("side-menu-opened")
                $('#side-menu').animate({right: '0px'}, 400, 'swing');
            }
        })
    });
</script>