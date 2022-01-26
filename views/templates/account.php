<?php 

use App\Auth;
use App\Config;
use App\Model\Users;
use App\Table\UserTable;

Auth::Auth();

$pdo = Config::getPDO();
$u = new UserTable($pdo);
$user = $u->find($_SESSION['auth']);
$title = "My Account";

if($_SESSION['auth'] != $params['id']) {
    header('Location: ' . $router->url('account', ['slug' => $user->getSlug(), 'id' => $user->getId()]));
}

//get the color of the account navbar 
if($title == "My Account") {
    $addClass = "selected";
}else{
    $addClass = "";
}


?>

<!-- Updated User's Details Confirmation Modal -->
<div id="usersDetailsModal" class="modal">
  <div class="modal-content">
    <span id="closeUserDetailsModal" class="close"><i class="fas fa-times-circle"></i></span>
    <h1>UPDATED</h1>
    <p style="margin-top:45px">Your details have been successfully updated, you can close this Pop-Up window.</p>
  </div>
</div>


<div class="account_container">
    <div class="account_header">
        <h1>YOUR<br>PROFILE</h1>
        <img src="media/wiskey_glass.jpg" alt="account_image">
        <img src="media/wiskey_glass.jpg" alt="account_image">
        <img src="media/wiskey_glass.jpg" alt="account_image">

    </div>
    <div class="account_navBar">
        <ul>
            <li><a href="">My Orders</a></li>
            <li><i class="fas fa-grip-lines-vertical"></i></li>
            <li><a href="">My Cocktails</a></li>
            <li><i class="fas fa-grip-lines-vertical"></i></li>
            <li><a class="<?= $addClass ?>" href="<?= $router->url('account', ['slug' => $user->getSlug(), 'id' => $user->getId()]) ?>">My Account</a></li>
        </ul>
    </div>
    <div class="account_subTitle">
        <h3>My details</h3>
        <p>Check and change your personal information with the forms below</p>
        <hr>
    </div>
    <div class="account_subTitle account_subtitle2">
        <h5>Login Email</h5>
        <p class="span_email"><?= $user->getEmail() ?></p>
        <p class="alert_error">Your login email can not be changed!</p>
        <hr>
    </div>
    <div class="account_form">
        <form action="" method="post" id="personnal_details_form">
            <div>
                <input type="text" name="account_f_name" id="account_fname" class="input inputSignup" placeholder="First Name" value="<?= $user->getF_name() ?>" autocomplete="off">
                    <label class="label_form signup_label" for="account_fname"></label>
                <input type="email" name="account_email" id="account_email" class="input inputSignup" placeholder="Email*" autocomplete="off">
                    <label class="label_form signup_label" for="account_email"></label>
                <p>
                    *You will not b able to login with this email. 
                    Only use for password recovery, 
                    order's confirmation and marketing purposes.
                </p>
            </div>
            <div>
                <input type="text" name="account_l_name" id="account_lname" class="input inputSignup" placeholder="Last Name" value="<?= $user->getL_name() ?>" autocomplete="off">
                    <label class="label_form signup_label" for="account_lname"></label>
                <input type="tel" name="account_tel" id="account_tel" class="input inputSignup" placeholder="Mobile" value="<?= $user->getTel() ?>" autocomplete="off"> 
                    <label class="label_form signup_label" for="account_tel"></label>
                <button class="update_button" type="submit">UPDATE</button>
            </div>
        </form>
        <hr>
    </div>
    <div class="account_form" style="margin-bottom:160px">
        <h5>Change your Password</h5>
        <form action="" method="post" id="password_update_form">
        <div>
            <input type="password" name="account_new_password" id="account_new_password" class="input inputSignup" placeholder="New Password" autocomplete="off">
                <label class="label_form signup_label" for="account_new_password"></label>
            <input type="password" name="account_old_password" id="account_old_password" class="input inputSignup" placeholder="Old Password" autocomplete="off">
                <label class="label_form signup_label" for="account_old_password"></label>
        </div>
            <div>
                <input type="password" name="account_confirm_new_password" id="account_confirm_new_password" class="input inputSignup" placeholder="Confirm New Password" autocomplete="off">
                    <label class="label_form signup_label" for="account_confirm_new_password"></label>
                <button class="update_button" type="submit">UPDATE</button>
            </div>
        </form>
    </div>
</div>

<script>

 //ajax update password form 
 $('#password_update_form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:'POST',
      url: '/updatePassword',
      data: $(this).serialize(),
      success: function(response) {
        let data = JSON.parse(response);

        if(data.account_new_password) {
          $("label[for='account_new_password']").text(data.account_new_password[0]);
          $('#account_new_password').css('border-color', '#ff404f');
        }else{
          $("label[for='account_new_password']").text("");
          $('#account_new_password').css('border-color', '#fff');
        }
        if(data.account_confirm_new_password) {
          $("label[for='account_confirm_new_password']").text(data.account_confirm_new_password[0]);
          $('#account_confirm_new_password').css('border-color', '#ff404f');
        }else {
          $("label[for='account_confirm_new_password']").text("");
          $('#account_confirm_new_password').css('border-color', '#fff');
        }
        if(data.account_old_password) {
          $("label[for='account_old_password']").text(data.account_old_password[0]);
          $('#account_old_password').css('border-color', '#ff404f');
        }else {
          $("label[for='account_old_password']").text("");
          $('#account_old_password').css('border-color', '#fff');
        }
        if(data == true) {
            let userDetailsModal = document.getElementById("usersDetailsModal");
            userDetailsModal.style.display = "block";
        }
      }
    })
});


 //ajax update personnal information form 
$('#personnal_details_form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:'POST',
      url: '/updateDetails',
      data: $(this).serialize(),
      success: function(response) {
        let data = JSON.parse(response);

        if(data.account_f_name) {
          $("label[for='account_fname']").text(data.account_f_name[0]);
          $('#account_fname').css('border-color', '#ff404f');
        }else{
          $("label[for='account_fname']").text("");
          $('#account_fname').css('border-color', '#fff');
        }
        if(data.account_l_name) {
          $("label[for='account_lname']").text(data.account_l_name[0]);
          $('#account_lname').css('border-color', '#ff404f');
        }else {
          $("label[for='account_lname']").text("");
          $('#account_lname').css('border-color', '#fff');
        }
        if(data.account_email) {
          $("label[for='account_email']").text(data.account_email[0]);
          $('#account_email').css('border-color', '#ff404f');
        }else {
          $("label[for='account_email']").text("");
          $('#account_email').css('border-color', '#fff');
        }
        if(data.account_tel) {
          $("label[for='account_tel']").text(data.account_tel[0]);
          $('#account_tel').css('border-color', '#ff404f');
        }else{
          $("label[for='account_tel']").text("");
          $('#account_tel').css('border-color', '#fff');
        }
        if(data == true) {
            let userDetailsModal = document.getElementById("usersDetailsModal");
            userDetailsModal.style.display = "block";
        }
      }
    })
});

//close the updated account modal
let userDetailsModal = document.getElementById("usersDetailsModal");
let closeUserDetailsModal = document.getElementById("closeUserDetailsModal");

closeUserDetailsModal.onclick = function(){
    userDetailsModal.style.display = "none";
    location.reload();
}




</script>