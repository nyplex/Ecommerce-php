<?php




use App\Auth;
use App\Config;
use App\Helpers;
use App\Model\Booking;
use App\Table\BookingTable;



$pdo = Config::getPDO();
$v = new Valitron\Validator($_POST);
$booking = new Booking();
$bookingTable = new BookingTable($pdo);



$v->rule('required', ['booking_Fname', 'booking_Lname', 'booking_email', 'booking_tel', 'bookingTime', 'bookingSize', 'booking_date'])->message("This field is required");
$v->rule('email', 'loginEmail')->message("This is not a valid Email");
$v->rule('lengthBetween', 'booking_Fname, booking_Lname', 2, 25)->message("Must be between 2 and 25 characters");
$v->rule('length', 'booking_tel', 11)->message("Must be 11 characters");
$v->rule('lengthBetween', 'booking_email', 5, 100)->message("Must be between 5 and 100 characters");
$v->rule('email', 'booking_email')->message("This is not a valid Email");
$v->rule('regex', 'booking_tel', '/^((\\(?0\\d{4}\\)?\\s?\\d{3}\\s?\\d{3})|(\\(?0\\d{3}\\)?\\s?\\d{3}\\s?\\d{4})|(\\(?0\\d{2}\\)?\\s?\\d{4}\\s?\\d{4}))(\\s?\\#(\\d{4}|\\d{3}))?$/')->message("Invalide UK phone number");

if($v->validate()){
    $data = [
        'f_name' => $_POST['booking_Fname'],
        'l_name' => $_POST['booking_Lname'],
        'email' => $_POST['booking_email'],
        'tel' => $_POST['booking_tel'],
        'time' => $_POST['bookingTime'],
        'size' => $_POST['bookingSize'],
        'date' => $_POST['booking_date']
    ];
    Helpers::hydrate($booking, $data, ['f_name', 'l_name', 'email', 'tel', 'time', 'size', 'date']);
    $bookingTable->createNewBooking($booking);
    $response = [
        'success' => true,
        'size' => $booking->getSize(),
        'id' => $booking->getId(),
        'time' => $booking->getTime(),
        'date' => $booking->getDate(),
        'f_name' => $booking->getF_name()
    ];
    echo json_encode($response);
    exit();
}else{
    echo json_encode($v->errors());
    exit();
}