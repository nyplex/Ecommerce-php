<?php

use App\Form;

$form = new Form();

?>

<!-- Booking Confirmation Modal -->
<div id="bookingModal" class="modal">
  <div class="modal-content">
    <span id="closeBookingModal" class="close"><i class="fas fa-times-circle"></i></span>
    <h1>We've got your Booking!</h1>
    <p style="margin-top:45px">
        We have sent all the details on your email!
    </p>
  </div>
</div>


<hr class="hr-section">
<div class="bookingPin pin">
    <div class="contentContainer" id="bookingContentContainer">
        <h1 class="booking_header">MAKE A<br>RESERVATION</h1>
        <form action="" id="booking_form" method="post" class="form">
            <input class="input booking_input" type="text" name="booking_Fname" id="booking_Fname" placeholder="First Name">
                <label class="label_form login_label label_booking" for="booking_Fname"></label>
            <input class="input booking_input" type="text" name="booking_Lname" id="booking_Lname" placeholder="Last Name">
                <label class="label_form login_label label_booking" for="booking_Lname"></label>
            <input class="input booking_input" type="email" name="booking_email" id="booking_email" placeholder="Email">
                <label class="label_form login_label label_booking" for="booking_email"></label>            
            <input class="input booking_input" type="tel" name="booking_tel" id="booking_tel" placeholder="Mobile">
                <label class="label_form login_label label_booking" for="booking_tel"></label>
            <div class="booking-select-container">
                <select required name="bookingTime" id="bookingTime" class="select input bookingTime">
                    <option selected value="">Time</option>
                    <option value="12:00">12:00</option>
                    <option value="12:15">12:15</option>
                    <option value="12:30">12:30</option>
                    <option value="12:45">12:45</option>
                    <option value="13:00">13:00</option>
                </select>
                <select required name="bookingSize" id="bookingSize" class="select input bookingSize">
                    <option selected value="">Size</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <input type="date" name="booking_date" id="booking_date" class="input">
                <label class="label_form login_label label_booking" for="booking_date"></label>
            <button class="button button_submit" type="submit">SUBMIT</button>
        </form>
    </div>
    <div class="canvasContainer">
        <!--<canvas class="bookingCanvas canvas" id="bookingCanvas"></canvas>-->
        <img style="width:100%" src="media/cocktail1.jpg" alt="">
    </div>
</div>


<script type="text/javascript">
//set min amd max date in the date input in the booking form
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if(dd<10){
    dd='0'+dd
    } 
    if(mm<10){
    mm='0'+mm
    }
    today = yyyy+'-'+mm+'-'+dd;
    let nextYear = (yyyy + 1 ) + '-' + mm + '-' + dd;
    document.getElementById("booking_date").setAttribute("min", today);
    document.getElementById("booking_date").setAttribute("max", nextYear);
//

//ajax booking form 
  $('#booking_form').on('submit', function(e){
    e.preventDefault();
    $.ajax({
      type:'POST',
      url: '/ajaxBooking',
      data: $(this).serialize(),
      success: function(response) {
        let data = JSON.parse(response);

        if(data.booking_Fname) {
          $("label[for='booking_Fname']").text(data.booking_Fname[0]);
          $('#booking_Fname').css('border-color', '#ff404f');
        }else {
          $("label[for='booking_Fname']").text("");
          $('#booking_Fname').css('border-color', '#fff');
        }
        if(data.booking_Lname) {
          $("label[for='booking_Lname']").text(data.booking_Lname[0]);
          $('#booking_Lname').css('border-color', '#ff404f');
        }else{
          $("label[for='booking_Lname']").text("");
          $('#booking_Lname').css('border-color', '#fff');
        }
        if(data.booking_email) {
          $("label[for='booking_email']").text(data.booking_email[0]);
          $('#booking_email').css('border-color', '#ff404f');
        }else{
          $("label[for='booking_email']").text("");
          $('#booking_email').css('border-color', '#fff');
        }
        if(data.booking_tel) {
          $("label[for='booking_tel']").text(data.booking_tel[0]);
          $('#booking_tel').css('border-color', '#ff404f');
        }else{
          $("label[for='booking_tel']").text("");
          $('#booking_tel').css('border-color', '#fff');
        }
        if(data.bookingTime) {
          $('#bookingTime').css('border-color', '#ff404f');
        }else{
          $('#bookingTime').css('border-color', '#fff');
        }
        if(data.bookingSize) {
          $('#bookingSize').css('border-color', '#ff404f');
        }else{
          $('#bookingSize').css('border-color', '#fff');
        }
        if(data.booking_date) {
          $("label[for='booking_date']").text(data.booking_date[0]);
          $('#booking_date').css('border-color', '#ff404f');
        }else{
          $("label[for='booking_date']").text("");
          $('#booking_date').css('border-color', '#fff');
        }
        if(data.success === true)
        {
            let bookingConfirmation = document.getElementById("bookingModal");
            bookingConfirmation.style.display = "block";
        }
      }
    })
  })
//


//close the booking confirmation modal
let bookingConfirmation = document.getElementById("bookingModal");
let closeBookingConfirmation = document.getElementById("closeBookingModal");

closeBookingConfirmation.onclick = function(){
    bookingConfirmation.style.display = "none";
    document.getElementById('booking_form').reset();
}
//

//animateCanvas("bookingCanvas", 1000, 1200, 100, "media/mojitoFrame/", ".bookingPin", "top", "bottom", true, false);


</script>
