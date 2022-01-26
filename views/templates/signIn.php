

<!-- Login Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span id="closeLoginModal" class="close"><i class="fas fa-times-circle"></i></span>
    <h1>LOGIN</h1>
    <form action="<?= $router->url('login') ?>" method="post" id="loginForm">
        <div class="formLogginInput">
          <input type="email" class="input inputLogin" id="loginEmail" placeholder="Email" name="loginEmail" autocomplete="email">
            <label class="label_form login_label" for="loginEmail"></label>
          <input type="password" class="input inputLogin" id="loginPassword" placeholder="Password" name="loginPassword" autocomplete="current-password">
            <label class="label_form login_label" for="loginPassword"></label>
        </div>
        <button type="submit" class="buttonLoggin update_button">LOG-IN</button>
    </form>
    <p style="margin-top:45px">Don't have an account yet? Sign-up to creatye an account!</p>
    <button id="signupButton" class="signupButton button button_submit">SIGN-UP</button>
  </div>
</div>

<!-- Signup Modal -->
<div id="SignupModal" class="modal">
  <div class="modal-content">
    <span id="closeSignupModal" class="close"><i class="fas fa-times-circle"></i></span>
    <h1>SIGNUP</h1>
    <form action="<?= $router->url('signup') ?>" method="post" class="signupForm" id="signUpForm">
        <div class="formSignupInput">
          <input type="text" name="f_name" class="input inputSignup" placeholder="First Name" id="signup_fname" autocomplete="given-name">
            <label class="label_form signup_label" for="signup_fname"></label>
          <input type="text" name="l_name" class="input inputSignup" placeholder="Last Name" id="signup_lname" autocomplete="family-name">
            <label class="label_form signup_label" for="signup_lname"></label>
          <input type="email" name="email" class="input inputSignup" placeholder="Email" id="signup_email" autocomplete="email">
            <label class="label_form signup_label" for="signup_email"></label>
          <input type="email" name="confirm_email" class="input inputSignup" placeholder="Confirm Email" id="signup_confirm_email" autocomplete="off">
            <label class="label_form signup_label" for="signup_confirm_email"></label>
          <input type="tel" name="tel" class="input inputSignup" placeholder="Mobile" id="signup_tel" autocomplete="tel">
            <label class="label_form signup_label" for="signup_tel"></label>
          <input type="password" name="password" class="input inputSignup" placeholder="Password" id="signup_password" autocomplete="new-password">
            <label class="label_form signup_label" for="signup_password"></label>
          <input type="password" name="confirm_password" class="input inputSignup" placeholder="Confirm Password" id="signup_confirm_password" autocomplete="off">
            <label class="label_form signup_label" for="signup_confirm_password"></label><br>
        </div>
        <button type="submit" class="buttonLoggin update_button">SIGN-UP</button>
    </form>
    <p>Already have an account? Just Log-in here!</p>
    <button id="logginButton" class=" signupButton button_submit">LOGIN</button>
  </div>
</div>

<script>
  //ajax signUp form
  $('#signUpForm').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:'POST',
      url: '/signup',
      data: $(this).serialize(),
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);
        if(data.f_name) {
          $("label[for='signup_fname']").text(data.f_name[0]);
          $('#signup_fname').css('border-color', '#ff404f');
        }else{
          $("label[for='signup_fname']").text("");
          $('#signup_fname').css('border-color', '#fff');
        }
        if(data.l_name) {
          $("label[for='signup_lname']").text(data.l_name[0]);
          $('#signup_lname').css('border-color', '#ff404f');
        }else {
          $("label[for='signup_lname']").text("");
          $('#signup_lname').css('border-color', '#fff');
        }
        if(data.email) {
          $("label[for='signup_email']").text(data.email[0]);
          $('#signup_email').css('border-color', '#ff404f');
        }else {
          $("label[for='signup_email']").text("");
          $('#signup_email').css('border-color', '#fff');
        }
        if(data.confirm_email) {
          $("label[for='signup_confirm_email']").text(data.confirm_email[0]);
          $('#signup_confirm_email').css('border-color', '#ff404f');
        }else{
          $("label[for='signup_confirm_email']").text("");
          $('#signup_confirm_email').css('border-color', '#fff');
        }
        if(data.tel) {
          $("label[for='signup_tel']").text(data.tel[0]);
          $('#signup_tel').css('border-color', '#ff404f');
        }else{
          $("label[for='signup_tel']").text("");
          $('#signup_tel').css('border-color', '#fff');
        }
        if(data.password) {
          $("label[for='signup_password']").text(data.password[0]);
          $('#signup_password').css('border-color', '#ff404f');
          $('#signup_password').val('');
        }else{
          $("label[for='signup_password']").text("");
          $('#signup_password').css('border-color', '#fff');
          $('#signup_password').val('');
        }
        if(data.confirm_password) {
          $("label[for='signup_confirm_password']").text(data.confirm_password[0]);
          $('#signup_confirm_password').css('border-color', '#ff404f');
          $('#signup_confirm_password').val('');
        }else{
          $("label[for='signup_confirm_password']").text("");
          $('#signup_confirm_password').css('border-color', '#fff');
          $('#signup_confirm_password').val('');
        }
        if(data.id && data.slug){
          window.location.href = '/account-' + data.slug + '-' + data.id;
        }
      }
    })
  })

  //ajax login form 
  $('#loginForm').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:'POST',
      url: '/login',
      data: $(this).serialize(),
      success: function(response) {
        let data = JSON.parse(response);
        console.log(data);

        if(data.loginEmail) {
          $("label[for='loginEmail']").text(data.loginEmail[0]);
          $('#loginEmail').css('border-color', '#ff404f');
        }else {
          $("label[for='loginEmail']").text("");
          $('#loginEmail').css('border-color', '#fff');
        }
        if(data.loginPassword) {
          $("label[for='loginPassword']").text(data.loginPassword[0]);
          $('#loginPassword').css('border-color', '#ff404f');
        }else{
          $("label[for='loginPassword']").text("");
          $('#loginPassword').css('border-color', '#fff');
        }
        if(data === true)
        {
          location.reload();
        }
      }
    })
  })



  // Open and close the Login/signup modal
  let modal = document.getElementById("myModal");
  let btn = document.getElementById("loginButton");
  let span = document.getElementById("closeLoginModal");
  let closeSignup = document.getElementById("closeSignupModal");
  let signup = document.getElementById("signupButton");
  let signupModal = document.getElementById("SignupModal");
  let login = document.getElementById('logginButton');
  let signUpForm = document.getElementById('signUpForm');
  if(btn != null) {
    btn.onclick = function() {
      modal.style.display = "block";
    }
  }
  

  span.onclick = function(){
      modal.style.display = "none";
      signUpForm.reset();
  }

  closeSignup.onclick = function(){
      signupModal.style.display = "none";
      signUpForm.reset();
  }

  signup.onclick = function(){
      $('#myModal').fadeOut('slow').end();
      $(signupModal).fadeIn('slow');
      signUpForm.reset();
  }

  login.onclick = function(){
      $(signupModal).fadeOut('slow').end();
      $("#myModal").fadeIn('slow');
  }


</script>